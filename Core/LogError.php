<?php
namespace Core;
include_once dirname(__DIR__) . '/Config/constant.php';
class LogError
{

    public static function writeError($fileName, $string)
    {
        $file = fopen(dirname(__DIR__) . "/Core/Error/$fileName", "a" );
        fwrite($file, $string);
        fclose($file);
    }

    public static function errorRoute($str)
    {
        $str = date(DATE_RFC822) . ", " . $str . ".\n";
        LogError::writeError('ErrorRoute.txt', $str);
    }

    public static function error422($error)
    {
        $str = date(DATE_RFC822) . ", " . $error . ".\n";
        LogError::writeError('422.txt', $str);

        LogError::header();
    }


    public static function error404($error)
    {
        $str = date(DATE_RFC822) . ", " . $error . ".\n";
        LogError::writeError('404.txt', $str);

        LogError::header();
    }

    public static function header()
    {
        header("Location: " . HOME);
        exit();
    }

}