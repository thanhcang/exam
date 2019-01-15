<?php

namespace Src\Services;

use Src\Library\Session;
use Src\Repositories\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function login(string $email, string $password)
    {
        if (!$this->userRepository->checkEmail($email)) {
            return false;
        }

        $userInfo = $this->userRepository->getUserInfoByEmail($email);

        if (!password_verify($password, $userInfo->getPassword())) {
            return false;
        }

        Session::set('userInfo', $userInfo);

        return true;
    }
}