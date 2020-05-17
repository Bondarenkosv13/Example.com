<?php
$route->add('', ['controller' => 'HomeController', 'action' => 'index']);
$route->add('home', ['controller' => 'HomeController', 'action' => 'index']);
$route->add('create', ['controller' => 'HomeController', 'action' => 'create']);

// Auth
$route->add('login', ['controller' => 'AuthController', 'action' => 'login']);
$route->add('registration', ['controller' => 'AuthController', 'action' => 'register']);
$route->add('auth', ['controller' => 'AuthController', 'action' => 'verify']);
$route->add('logout', ['controller' => 'AuthController', 'action' => 'logout']);


//User
$route->add('user/store', ['controller' => 'UserController', 'action' => 'store']);
$route->add('user/password', ['controller' => 'UserController', 'action' => 'password']);
$route->add('user/update', ['controller' => 'UserController', 'action' => 'update']);

//Post
$route->add('posts', ['controller' => 'PostsController', 'action' => 'index']);
$route->add('posts/create', ['controller' => 'PostsController', 'action' => 'create']);
$route->add('posts/store', ['controller' => 'PostsController', 'action' => 'store']);
$route->add('posts/{id:\d+}/update', ['controller' => 'PostsController', 'action' => 'update']);
$route->add('posts/{id:\d+}/edit', ['controller' => 'PostsController', 'action' => 'edit']);
$route->add('posts/{id:\d+}/delete', ['controller' => 'PostsController', 'action' => 'delete']);

$route->add('posts/{id:\d+}', ['controller' => 'PostsController', 'action' => 'show']);