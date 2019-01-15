<?php

namespace Src\Library;

use Exception;
use Src\Library\Routes\Route;
use Src\Library\Routes\RouterException;

class Router
{

    private static $instance;

    /**
     * @var Route[]
     */
    private $routes = [];

    public static function getInstance()
    {
        if (!self::$instance instanceof Router) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function pushRoute(Route $route): self
    {
        $this->routes[] = $route;

        return $this;
    }

    public function dispatch(Request $request, Response $response)
    {

        $route = $this->getRoute($request);

        if ($route->getMethod() !== $request->method()) {
            $response->setStatus(405);
            throw new RouterException('Method Not Allowed');
        }

        if (!is_callable([$route->getController(), $route->getAction()])) {
            $response->setStatus(500);
            throw new Exception('Controller or Function is not exists');
        }

        $html = call_user_func([$route->getController(), $route->getAction()], $route->getParams());
        $response->setBody((string) $html);

        return $response;
    }

    protected function getRoute(Request $request): Route
    {
        /**
         * @var Route $route
         */
        foreach ($this->routes as $route) {
            if ($route->compare($request->getUri()->pathComponent())) {
                return $route;
            }
        }

        throw new RouterException('Url is not exists');
    }
}