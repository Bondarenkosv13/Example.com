<?php
namespace Core;
class Router
{
    protected $routes = [];

    protected $params = [];

    protected $coverTypes = [
        'd' => 'int',
        's' => 'string'
    ];

    public function add (string $route, array $params = [])
    {
        $route = preg_replace('/\//', '\\', $route);
    }

    public function dispatch (string $url)
    {

    }
}