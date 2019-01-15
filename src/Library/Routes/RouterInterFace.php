<?php

namespace Src\Library\Routes;


interface RouterInterFace
{
    public function controller(string $controller);

    public function method(string $method);

    public function action(string $action);

    public function params(array $params);

    public function url(string $url);
}