<?php


class Router
{
    static function start()
    {
        $controller_name = 'Main';
        $action_name = 'index';

        $action_param = '';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if ( !empty($routes[1]) )
        {
            $controller_name = substr($routes[1], 0, (!str_contains($routes[1], '?') ? null : strpos($routes[1], '?')));
            if (!array_key_exists('ID', $_SESSION) && ($controller_name == "rating" || $controller_name == "unlocked" || $controller_name == "favourites" || $controller_name == "profile"))
            {
                $controller_name = "Auth";
            }
        }

        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
        }

        if ( !empty($routes[3]) )
        {
            $action_param = $routes[3];
        }

        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;

        $model_file = strtolower($model_name).'.php';
        $model_path = "app/models/".$model_file;
        if(file_exists($model_path))
        {
            include "app/models/".$model_file;
        }

        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "app/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "app/controllers/".$controller_file;
        }
        else
        {
            (new Router)->ErrorPage404();
        }

        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            if (!empty($action_param)) {
                $controller->$action($action_param);
            } else
                $controller->$action();
        }
        else
        {
            (new Router)->ErrorPage404();
        }
    }

    function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404.php');
    }
}