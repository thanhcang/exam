<?php

namespace Src;

use Exception;
use Src\Exception\MysqlException;
use Src\Library\Mysql;
use Src\Library\ProjectConfiguration;
use Src\Library\Request;
use Src\Library\Response;
use Src\Library\Router;
use Src\Library\Routes\Route;
use Src\Library\Routes\RouterException;
use Src\Library\Session;

class Loader
{
    public function run()
    {
        $response = Response::getInstance();
        $request  = Request::getInstance();

        try {
            Mysql::getInstance();
            Session::start();
            ob_start();
            $response = Router::getInstance()->dispatch($request, $response);
        } catch (RouterException $e) {
            $this->debug($e->getMessage());
        } catch (MysqlException $e) {
            $this->debug($e->getMessage());
        } catch (Exception $e) {
            $this->debug($e->getMessage());
        } finally {
            ob_get_clean();
        }

        $this->respond($response);

        return $response;
    }

    protected function respond(Response $response)
    {
        if (!headers_sent()) {
            // Headers
            foreach ($response->getHeaders() as $name => $values) {
                foreach ($values as $value) {
                    header(sprintf('%s: %s', $name, $value), false);
                }
            }

            // Status
            header(sprintf(
                'HTTP/%s %s %s',
                '1.1',
                $response->getStatus(),
                $response->getReasonPhrase()
            ));
        }

        echo $response->getBody();
    }

    public function map(
        string $method,
        string $url,
        string $controller,
        string $action,
        array $params = []
    ): void {
        $route = new Route();
        $route->url($url);
        $route->params($params);
        $route->action($action);
        $route->controller($controller);
        $route->method($method);

        Router::getInstance()->pushRoute($route);
    }

    protected function debug(string $message)
    {
        if (ProjectConfiguration::getInstance()->get('DEBUG')) {
            echo $message;
            die();
        }
    }
}