<?php
namespace Core;


class Router
{
//
//    /**
//     * Associative array of routes (the routing table)
//     * @var array
//     */
//    protected $routes = [];
//
//    /**
//     * Parameters from the matched route
//     * @var array
//     */
//    protected $params = [];
//
//    protected $coverTypes = [
//        'd' => 'int',
//        's' => 'string'
//    ];
//
//    /**
//     * Add a route to the routing table
//     *
//     * @param string $route The route URL
//     * @param array $params Parameters (controller, action, ect.)
//     *
//     * @return void
//     */
//    public function output($param)
//    {
//        echo "<pre>";
//        print_r($param);
//        echo '</pre>';
//    }
//
//    public function add ($route, $params = [])
//    {
//        //Convert the route to a regular expression: escape forward slashes
//        $route = preg_replace('/\//', '\\/', $route);
//        //Convert variables e.g. {controller}
//        $route = preg_replace('/\{([a-z]+)\}/', '(?P,\1>[a-z-]+)', $route);
//
//        //Convert variables with custom regular expressions e.g. {id:\d+}
//        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
//        // Add start and end delimiters and case insensitive flag
//        $route = '/' . $route . '/i';
//
//        $this->routes[$route] = $params;
//
//    }
//
//    /**
//     * Get all the routes from the routing table
//     *
//     * @return array
//     */
//
//    public function getRoutes()
//    {
//        return $this->routes;
//    }
//
//    /**
//     * Match the route to the routes in the routing table, setting the $params
//     * property if a route is found.
//     *
//     * @param string $url The route URL
//     *
//     * @return boolean true if a match found, false otherwise
//     */
//
//    public function match($url)
//    {
//        foreach ($this->routes as $route => $params) {
//            if(preg_match($route, $url, $matches)) {
//                $this->output($params);
//                     //проверяет регулярку с add,в урл, и записывает его в $matches
//                preg_match_all('|\(\?P<[\w]+>\\\\(\w[\+])\)|', $route, $types);
//
//                $step = 0;
//                foreach ($matches as $key => $match) {
//                    if (is_string($key)) {
//                        $types[1] = str_replace('+', '', $types[1]);
//                        settype($match, $this->coverTypes[$types[1][$step]]);
//                        $params[$key] = $match;
//
//                        $step++;
//
//                    }
//                }
//
//                $this->params = $params;
//
//                return true;
//            }
//        }
//
//        return false;
//    }
//
//    /**
//     * Get the currently matched parameters
//     *
//     * @return array
//     */
//
//    public function getParams()
//    {
//        return $this->params;
//    }
//
//    /**
//     * Dispatch the route, creating the controller abject and running the
//     * action method
//     *
//     * @param string $url The route URL
//     *
//     * @return array
//     * @throws \Exception
//     */
//
//    public function dispatch($url)
//    {
//        $url = trim($url, '/');
//        $url = $this->removeQueryStringVariables($url);
//
//        if ($this->match($url)) {
//            $controller = $this->params['controller'];
//
//            unset($this->params['controller']);
//            $controller = $this->convertToStudlyCaps($controller);
//
//            $controller = $this->getNamespace() . $controller;
//            $this->output(class_exists($controller));
//            if (class_exists($controller)) {
//                $action = $this->params['action'];
//                unset($this->params['action']);
//                $action = $this->convertToCameCase($action);
//                $controller = new $controller;
//
//                call_user_func_array(
//                    array(
//                        $controller,
//                        $action
//                    ),
//                    $this->params
//                );
//            } else {
//                throw new \Exception("Controller class $controller not found");
//            }
//        } else {
//            throw new \Exception('No route matched.', 404);
//        }
//    }
//
//    /**
//     * Convert the string with hyphens to StudlyCaps,
//     * e.g. post-authors => PostAuthors
//     *
//     * @param string $string The string to convert
//     *
//     * @return string
//     */
//    protected function convertToStudlyCaps($string)
//    {
//        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
//    }
//    /**
//     * Convert the string with hyphens to camelCase,
//     * e.g. add-new => addNew
//     *
//     * @param string $string The string to convert
//     *
//     * @return string
//     */
//    protected function convertToCameCase($string)
//    {
//        return lcfirst($this->convertToStudlyCaps($string));
//    }
//    /**
//     * Remove the query string variables from the URL (if any). As the full
//     * query string is used for the route, any variable at the end will need
//     * to be removed before the route is matched to the routing table. For
//     * example:
//     * URL                              $_SERVER['QUERY_STRING']  Route
//     * _________________________________________________________________
//     * Localhost                        ''                      ''
//     * localhost/?                      ''                      ''
//     * localhost/?page=1                page=1                  ''
//     * localhost/posts?page=1           posts&page=1            posts
//     * localhost/posts/index            posts/index             posts/index
//     * localhost/posts/index?page=1     posts/index&page=1      posts/index
//     *
//     * A URL of the format localhost/?page (one variable name, no value) won't
//     * work however. (NB. The .htaccess file converts the first ? to a & when
//     * it's passed through to the $_SERVER variable).
//     *
//     * @param string $url The full URL
//     * @return string The URL with the query string variables removed
//     */
//    protected function removeQueryStringVariables($url)
//    {
//        if ($url != '') {
//            $parts = explode('&', $url, 2);
//            if (strpos($parts[0], '=') === false) {
//                $url = $parts[0];
//            } else {
//                $url = '';
//            }
//        }
//        return $url;
//    }
//
//    /**
//     * Get the namespace for the controller class. The namespace defined in the
//     * route parameters is added if present.
//     *
//     * @return string The request URL
//     */
//    protected function getNamespace()
//    {
//        $namespace = 'App\Controller\\';
//
//        if (array_key_exists('namespace', $this->params)) {
//            $namespace .= $this->params['namespace'] . '\\';
//        }
//
//        return $namespace;
//    }

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
                        $this->params['params'][$key] = $value;
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
            $controller = "App\Controllers";
            $this->output($controller);
            $this->output($this->params);
        }
        else {
            LogError::Error404($_SERVER['REQUEST_URI']);
        }




    }


//        $this->output($this->routes);
}