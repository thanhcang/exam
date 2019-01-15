<?php

require __DIR__ . '/../vendor/autoload.php';
$loader = new \Src\Loader();

require __DIR__ . '/../src/route.php';

$loader->run();