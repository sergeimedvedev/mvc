<?php

require_once 'traits/Redirect.php';

class Router
{
    use Redirect;

    public $Controller;
    public $action;
    public $param;
    public $uri;

    public function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $pos = mb_strpos($uri, '?');
        $uri = $pos ? mb_strcut($uri, 0, $pos) : $uri;
        $this->uri = mb_strtolower(preg_replace('/[^a-z0-9\/]+/i', '', $uri));
        $routes = explode('/', mb_substr($this->uri, 1));
        list($controller, $action, $param) = $routes;

        $controller = $controller == '' ? CFG['defaultController'] : ucfirst($controller) . 'Controller';
        $action = $action == '' ? CFG['defaultAction'] : 'action' . ucfirst($action);

        $filepath = './controllers/' . $controller . '.php';
        if (file_exists($filepath)) {
            require_once $filepath;
            if (class_exists($controller)) {
                $this->Controller = new $controller;
                if (method_exists($this->Controller, $action)) {
                    $this->action = $action;
                    $this->param = $param;
                }
            }
        }
    }

    public function render()
    {
        if ($this->Controller && $this->action) {
            call_user_func([$this->Controller, $this->action], $this->param);
        } else {
            $this->redirect404();
        }
    }

}
