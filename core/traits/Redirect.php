<?php

trait Redirect
{
    public function redirectHome()
    {
        header('location: /');
    }

    public function redirect404()
    {
        header('HTTP/1.1 404 Not Found');
        $content = '<h1>404 Not Found</h1><p>Запрашиваемая страница отсутствует</p>';
        require_once './views/layout.php';
    }
}