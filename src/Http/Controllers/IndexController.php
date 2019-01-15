<?php

namespace Src\Http\Controller;


use Src\Services\MessageService;

class IndexController extends Controller
{
    public function index()
    {
        $this->assign('title', 'Guest Book');
        $messageService = new MessageService();
        $this->assign('guestBooks', array_chunk($messageService->all(), 2));
        return $this->render('HomePage/index.php');
    }
}