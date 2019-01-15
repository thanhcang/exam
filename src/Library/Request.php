<?php

namespace Src\Library;

use Src\Library\Request\Uri;

class Request
{
    /**
     * @var self
     */
    private static $instance;

    public $get = [];
    public $post = [];
    public $cookie = [];
    public $files = [];
    public $server = [];
    public $request = [];

    public function __construct()
    {
        $this->get     = $this->clean($_GET);
        $this->post    = $this->clean($_POST);
        $this->request = $this->clean($_REQUEST);
        $this->cookie  = $this->clean($_COOKIE);
        $this->files   = $this->clean($_FILES);
        $this->server  = $this->clean($_SERVER);
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof Request) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function clean($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                unset($data[$key]);
                $data[$this->clean($key)] = $this->clean($value);
            }
        } else {
            $data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
        }

        return $data;
    }

    public function getParam(string $key): string
    {
        $params = $this->getParams();

        return isset($params[$key]) ? $params[$key] : "";
    }

    public function getParams()
    {
        switch ($this->method()) {
            case 'GET':
                return $this->get;
                break;
            case 'POST':
                return $this->post;
                break;
            default :
                return [];
                break;
        }
    }

    public function method()
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getUri()
    {
        return new Uri();
    }
}