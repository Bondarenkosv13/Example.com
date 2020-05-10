<?php
namespace App\Models;

use Core\Model;
include_once dirname(__DIR__) . '/../Config/constant.php';

class CreateTable extends Model
{

    public function __construct()
    {
        $this->connectDB();
    }

    public function createTables()
    {
        $users = file_get_contents(dirname(__DIR__) . '/../Config/Sql/createUsers.txt');
        $posts = file_get_contents(dirname(__DIR__) . '/../Config/Sql/createPosts.txt');


        $new_table = $this->dbh->prepare($users);
        $new_table->execute();

        $new_table = $this->dbh->prepare($posts);
        $new_table->execute();

        $this->dbh = null;

        header("Location: " . HOME);
        exit();
    }


}