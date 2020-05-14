<?php
namespace Core;

class View
{
    public static $way = "/App/Views/";

    /**
     * @param $view - path is view
     * @param array $params - variables is for view
     * @return  - require view
     * @throws \Exception - if view don't find
     */
    public static function render ($view, $params = [])
    {
        extract($params);

        $file = dirname(__DIR__) . View::$way . $view;

        if (is_readable($file))
        {
            require $file;
        }
        else
        {
            echo "$file не найден!";
        }
    }
}