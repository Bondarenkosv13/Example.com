<?php
namespace Core;
use PDO;
use App\Config;

abstract class Model
{
    public $dbh = null;

    public function connectDB()
    {
        $dsn = "mysql:host=" . Config::host . ";dbname=" . Config::db_name . ";charset=" . Config::charset;

        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

            $this->dbh = new PDO($dsn, Config::user, Config::pass, $opt);
    }
}