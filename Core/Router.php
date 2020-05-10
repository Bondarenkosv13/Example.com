<?php
namespace Core;

class Router
{
    private $routes = [];

    private $params = [];

    protected function output($param)
    {
        echo "<pre>";
        print_r($param);
        echo "</pre>";
    }

    /**
     * Creat the regular generation for find controller in the method match.
     *
     * @param string $route - onto files Routes/Web/php
     * @param array $params - onto files Routes/Web/php
     */
    public function add(string $route, array $params =[])
    {
        $route = preg_replace('/\//', '\/', $route);
        $route = preg_replace('/\{([a-z]+):([\a-z]+)\}/', '(?P<\1>\2)', $route);
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $params;
    }

    /**
     * Fill in the $params = []
     *
     * @param  $url
     * @return bool
     */

    public function match($url)
    {
        foreach ($this->routes as $route => $params) {

            if (preg_match($route, $url, $matches)) {
                $this->params = $params;

                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $this->params[$key] = $value;
                    }
                }
                return true;
            }
        }
        return false;
    }

    public function dispatch(string $url)
    {
        $url = trim($url, '/');
        if($this->match($url))
        {
            $controller = $this->params['controller'];
            unset($this->params['controller']);
            $controller = "App\Controllers\\" . $controller;

                if(class_exists($controller)) {
                    $action = $this->params['action'];
                    unset($this->params['action']);
                    $controller = new $controller;


                    call_user_func_array(
                    array (
                        $controller,
                        $action
                    ),

                    $this->params
                    );
                } else {
                    LogError::error422($controller);
                }
        } else {
            LogError::error404($_SERVER['REQUEST_URI']);
        }
    }
}