<?php
namespace App\Validation;

use Core\Model;
use PDO;

class TableValidator extends Model
{
    public function __construct()
    {
        $this->connectDB();
    }

    public function checkTable()
    {
        $sql = "SHOW TABLES";
        $statement = $this->dbh->prepare($sql);
        $statement ->execute();
        $tables = $statement->fetchAll(PDO::FETCH_NUM);

        foreach ($tables as $table) { }

        $table = $table[0]??null;

        return $table;

    }
}