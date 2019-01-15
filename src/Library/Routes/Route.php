<?php

namespace Src\Library\Routes;

class Route implements RouterInterFace
{
    /**
     * @var array
     */
    private $params = [];

    /**
     * @var string ( class name)
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $url;

    public function method(string $method)
    {
        // TODO: Implement method() method.
        $this->method = $method;
    }

    public function action(string $action)
    {
        // TODO: Implement action() method.
        $this->action = $action;
    }

    public function params(array $params)
    {
        // TODO: Implement params() method.
        $this->params = $params;
    }

    public function controller(string $controller)
    {
        // TODO: Implement controller() method.
        $this->controller = $controller;
    }

    public function url(string $url)
    {
        // TODO: Implement url() method.
        $this->url = $url;
    }

    public function isParam()
    {
        return $this->params === [] ? false : true;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return string
     */
    public function getController()
    {
        return new $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return strtoupper($this->method);
    }

    private function getArrayUrl()
    {
        return explode('/', ltrim($this->url, '/'));
    }

    public function compare(array $arrayUrlPath): bool
    {
        if (count($this->getArrayUrl()) !== count($arrayUrlPath)) {
            return false;
        }

        foreach ($this->getArrayUrl() as $index => $item) {
            if (preg_match('/{.+}/', $item, $matches)) {
                $this->params[] = $arrayUrlPath[$index];
                continue;
            }

            if ((string) $item !== (string) $arrayUrlPath[$index]) {
                return false;
            }
        }

        return true;
    }
}