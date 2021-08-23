<?php

namespace MVC;

use MVC\Request;
use MVC\Router;

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        $this->request = new Request();

        Router::parse($this->request->url, $this->request);

        $controller = $this->loadController();

        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {
        // $name = $this->request->controller . "Controller";
        // $file = ROOT . 'Controllers/' . $name . '.php';
        $name = ucfirst($this->request->controller);
        $controlName = $name . "Controller";
        $file = 'MVC\\Controllers\\' . $controlName ;

        // require($file);
        // $controller = new $name();
        $controller = new $file();

        return $controller;
    }

}
?>