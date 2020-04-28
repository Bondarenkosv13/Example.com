<?php
$router->add('', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('home', ['controller' => 'HomeController', 'action' => 'index']);

// Auth
$router->add('login', ['controller' => 'AuthController', 'action' => 'login']);
$router->add('registration', ['controller' => 'AuthController', 'action' => 'register']);
$router->add('auth', ['controller' => 'AuthController', 'action' => 'verify']);
$router->add('logout', ['controller' => 'AuthController', 'action' => 'logout']);

//User
$router->add('user/store', ['controller' => 'UserController', 'action' => 'store']);

//Post
$router->add('posts', ['controller' => 'PostsController', 'action' => 'index']);
$router->add('posts/create', ['controller' => 'PostsController', 'action' => 'create']);
$router->add('posts/store', ['controller' => 'PostsController', 'action' => 'store']);
$router->update('posts/{id:\d+}/update', ['controller' => 'PostsController', 'action' => 'update']);
$router->add('posts/{id:\d+}/edit', ['controller' => 'PostsController', 'action' => 'edit']);
$router->add('posts/{id:\d+}/delete', ['controller' => 'PostsController', 'action' => 'delete']);

$router->add('posts/{id:\d+}', ['controller' => 'PostsController', 'action' => 'show']);