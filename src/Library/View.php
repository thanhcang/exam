<?php

namespace Src\Library;

class View
{
    public static function render(string $file, array $data = [])
    {
        extract($data);
        include(__DIR__ . '/../Http/View/Common/Header.php');
        include(__DIR__ . '/../Http/View/' . $file);
        include(__DIR__ . '/../Http/View/Common/Footer.php');
        $content = ob_get_contents();
        return $content;
    }
}