<?php
namespace App\Controllers;

use App\Models\CreateTable;
use App\Validation\TableValidator;
use Core\View;
class HomeController
{
    public function index()
    {
        $tables = new TableValidator();
        $table = $tables->checkTable();
        View::render('Parts/header.php', ['title' => 'Home', 'table' => $table]);
        View::render('Home/index.php');
        View::render('Parts/footer.php');
    }

    /**
     * This action is create tables (users and posts) in DataBase if they don't be create
     */
    public function create()
    {
        $tables = new CreateTable();
        $tables->createTables();
    }
}