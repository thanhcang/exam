<?php

namespace Src\Http\Validation;

use Src\Library\Request;
use Src\Services\UserService;

class UserLogin extends BaseValidation
{
    function forms(): bool
    {
        // TODO: Implement forms() method.
        $request  = Request::getInstance();
        $check    = true;
        $email    = $request->getParam('email');
        $password = $request->getParam('password');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->pushError('Please input email');
            $check = false;
        }

        if (empty($password)) {
            $this->pushError('Please input password');
            $check = false;
        }

        return $check;
    }

    function db(): bool
    {
        // TODO: Implement db() method.
        $service  = new UserService();
        $request  = Request::getInstance();
        $email    = $request->getParam('email');
        $password = $request->getParam('password');

        if (!$service->login($email, $password)) {
            $this->pushError('Email or Password incorrect, please check again');

            return false;
        }

        return true;
    }

}