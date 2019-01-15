<?php

namespace Src\Http\Controller;

use Src\Http\Validation\UserLogin;
use Src\Library\Response;
use Src\Library\Session;

class UserController extends Controller
{
    public function login()
    {
        $this->assign('title', 'user login');
        $validate = new UserLogin();

        if (!$validate->check()) {
            $this->assign('validate', false);
            $this->assign('errors', $validate->getErrors());
        } else {
            $this->assign('validate', true);
        }

        return $this->ajax();
    }

    public function logout()
    {
        Session::destroy();
        header("Location: " . getAppUrl());
        exit;
    }
}