<?php

namespace Src\Http\Validation;

use Src\Library\Session;
use Src\Models\UserModel;

class UserSession extends BaseValidation
{
    function forms(): bool
    {
        // TODO: Implement forms() method.
        return true;
    }

    function db(): bool
    {
        // TODO: Implement db() method.
        if (!Session::has('userInfo')) {
            return false;
        }

        /**
         * @var UserModel $userInfo
         */
        $userInfo = Session::get('userInfo');

        if (!$userInfo->isAdmin()) {
            return false;
        }

        return true;
    }

}