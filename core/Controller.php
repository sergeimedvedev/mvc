<?php

require_once 'traits/Redirect.php';

abstract class Controller
{

    use Redirect;

    abstract function actionIndex();

    public function render()
    {
        $params = func_get_args();
        $param = $params[0];
        $class = debug_backtrace()[1]['class'];
        $pos = strpos($class, 'Controller');
        $className = strtolower(substr(debug_backtrace()[1]['class'], 0, $pos));
        $actionName = strtolower(substr(debug_backtrace()[1]['function'], 6));
        $filepath = './views/' . $className . '/' . $actionName . '.php';
        if (file_exists($filepath)) {
            require_once $filepath;
        } else {
            $this->redirect404();
        }
    }

    public function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}