<?php

namespace Src\Http\Validation;

use Src\Library\Request;

class AdminEditMessage extends BaseValidation
{
    function forms(): bool
    {
        // TODO: Implement forms() method.
        $request = Request::getInstance();
        $message = $request->getParam('message');
        $check   = true;

        if (empty($message)) {
            $this->pushError('Please input message');
            $check = false;
        } elseif (strlen($message) > 1000) {
            $this->pushError('message too long, it should less than 1000 character');
            $check = false;
        } elseif (strlen($message) < 100) {
            $this->pushError('message too short, it should large than 100 character');
            $check = false;
        }

        return $check;
    }

    function db(): bool
    {
        // TODO: Implement db() method.
        return true;
    }

}