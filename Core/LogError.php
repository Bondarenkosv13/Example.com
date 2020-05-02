<?php
namespace Core;

class LogError
{

    public static function writeError($fileName, $string)
    {
        $file = fopen(dirname(__DIR__) . "/Core/Error/$fileName", "a" );
        fwrite($file, $string);
        fclose($file);
    }

    public static function ErrorRoute($str)
    {
        $str = date(DATE_RFC822) . ", " . $str . ".\n";
        LogError::writeError('ErrorRoute.txt', $str);


    }

    public static function Error422($error)
    {
        $str = date(DATE_RFC822) . ", " . $error . ".\n";
        LogError::writeError('422.txt', $str);

        LogError::Header();

    }


    public static function Error404($error)
    {
        $str = date(DATE_RFC822) . ", " . $error . ".\n";
        LogError::writeError('404.txt', $str);

        LogError::Header();

    }

    public static function Header()
    {
        header("Location: http://example.com/home");
        exit();
    }

}