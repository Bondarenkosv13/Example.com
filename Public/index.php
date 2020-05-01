<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Core\Router;
use App\Controllers\PostsController;


$route = new Router();
require_once dirname(__DIR__) . '/Routes/Web.php';
$url = 'example.com/posts/6/edit';
$route->match($url);


//if(!preg_match('/assets/i', $_SERVER['REQUEST_URI'])) {
//    $router->dispatch($_SERVER['REQUEST_URI']);
//}
