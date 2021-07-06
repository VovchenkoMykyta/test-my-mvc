<?php


namespace core;


class Router
{
    static public function start()
    {
        $requestURIComponents = self::getURIComponents();
        $controllerName = 'index';
        $actionName = 'index';

        if(isset($requestURIComponents[0])){
            $controllerName = $requestURIComponents[0];
        }
        if(isset($requestURIComponents[1])){
            $actionName = $requestURIComponents[1];
        }
        $controllerClassName = '\controllers\\'.ucfirst($controllerName).'Controller';

        if(!class_exists($controllerClassName)){
            self::error404();
        }
        $controller = new $controllerClassName;

        if(!method_exists($controller, $actionName)){
            self::error404();
        }
        $controller->$actionName();
    }

    static public function getURIComponents()
    {
        $requestURI = $_SERVER['REQUEST_URI'];
        // если регистро независимо
        $requestURI = mb_strtolower($requestURI);

        $requestURIComponents = explode('/', $requestURI);
        array_shift($requestURIComponents);
        //TODO убираем заключительный слеш, придумать как сделать до разбиения
        if (empty($requestURIComponents[count($requestURIComponents) - 1])) {
            array_pop($requestURIComponents);
        }
        if (count($requestURIComponents) > 2) {
            self::error404();
        }
        return $requestURIComponents;
    }

    static public function error404()
    {
        header($_SERVER["SERVER_PROTOCOL"] . '404 Not Found', true, 404);
        //TODO все что угодно по отображению
        echo 'Page not found';
        exit();
    }

    static public function redirect($controller = null, $action = null)
    {
        header('Location:' . self::getUrl($controller, $action));
        exit();
    }

    static public function getUrl($controller = null, $action = null)
    {
        $url = '/';
        if (!empty($controller)) {
            $url .= $controller . '/' . $action;
        }
        return $url;
    }
}