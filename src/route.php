<?php
$loader->map('get', '/', Src\Http\Controller\IndexController::class, 'index');
$loader->map('post', 'user/login', \Src\Http\Controller\UserController::class, 'login');
$loader->map('get', 'user/logout', \Src\Http\Controller\UserController::class, 'logout');
$loader->map('post', 'guest/post-message', \Src\Http\Controller\MessageController::class, 'post');
$loader->map('post', 'admin/edit/message/{id}', \Src\Http\Controller\MessageController::class, 'edit');
$loader->map('delete', 'admin/delete/message/{id}', \Src\Http\Controller\MessageController::class, 'delete');