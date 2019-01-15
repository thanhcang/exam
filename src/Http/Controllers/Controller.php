<?php

namespace Src\Http\Controller;

use Src\Library\Response;
use Src\Library\Session;
use Src\Library\View;

class Controller
{
    protected $data = [];

    protected function render(string $file)
    {
        if (Session::has('userInfo')) {
            $this->assign('userInfo', Session::get('userInfo'));
        }

        return View::render($file, $this->data);
    }

    protected function assign(string $key, $value)
    {
        $this->data[$key] = $value;
    }

    protected function ajax()
    {
        $response = Response::getInstance();
        $response->addHeader('Accept: application/json');
        $response->addHeader('Content-Type: application/json');
        return json_encode($this->data);
    }
}