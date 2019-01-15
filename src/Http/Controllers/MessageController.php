<?php

namespace Src\Http\Controller;

use Src\Http\Validation\AdminEditMessage;
use Src\Http\Validation\GuestPostMessage;
use Src\Http\Validation\UserSession;
use Src\Library\Request;
use Src\Library\Response;
use Src\Services\MessageService;

class MessageController extends Controller
{
    public function post()
    {
        $validate = new GuestPostMessage();

        if (!$validate->check()) {
            $this->assign('validate', false);
            $this->assign('errors', $validate->getErrors());

            return $this->ajax();
        }

        $messageService = new MessageService();

        $request  = Request::getInstance();
        $userName = $request->getParam('userName');
        $message  = $request->getParam('message');

        if (!$messageService->post($userName, $message)) {
            $this->assign('validate', false);
            $this->assign('errors', 'Have some thing error, please contact your administrator');
            return $this->ajax();
        }

        $this->assign('validate', true);
        return $this->ajax();
    }

    public function delete(array $param)
    {
        $validate = new UserSession();

        if (!$validate->check()) {
            $this->assign('validate', false);
            $this->assign('errors', 'You do not have permission delete this message, please contact admin');
            return $this->ajax();
        }

        $messageService = new MessageService();
        $messageService->delete($param[0]);

        $this->assign('validate', true);
        return $this->ajax();
    }

    public function edit(array $param)
    {
        $validate = new UserSession();

        if (!$validate->check()) {
            $this->assign('validate', false);
            $this->assign('errors', ['You do not have permission delete this message, please contact admin']);
            return $this->ajax();
        }

        $validateForm = new AdminEditMessage();

        if (!$validateForm->check()) {
            $this->assign('validate', false);
            $this->assign('errors', $validateForm->getErrors());
            return $this->ajax();
        }

        $request        = Request::getInstance();
        $message        = $request->getParam('message');
        $messageService = new MessageService();

        if (!$messageService->edit($param[0], $message)) {
            $this->assign('validate', false);
            $this->assign('errors', ['Have some thing error, please contact your administrator']);
            return $this->ajax();
        }

        $this->assign('validate', true);
        return $this->ajax();
    }
}