<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//
//require_once dirname(__DIR__) . "/vendor/autoload.php";
//
//$router = new \Core\Router();
//include_once dirname(__DIR__) . 'Routes/Web.php';



function add ($route, $params = [])
{
    $route = preg_replace('/\//', '\\', $route);



    $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

    $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
    return $route;
    $route = '/^' . $route . '$/i';

}

https://lms.ithillel.ua/groups/5cd54448df865a4324932a54/lessons/5e6f388310b9db148a7417d5
var_dump(add('https://lms.ithillel.ua/groups/{id:\d+}', ['controller' => 'PostsController', 'action' => 'create']));