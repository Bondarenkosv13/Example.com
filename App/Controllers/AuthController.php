<?php
namespace App\Controllers;
use Core\View;

class AuthController
{
    public function login()
    {
        echo "AuthController method login";
    }
    public function register()
    {
        View::render('Parts/header.php', ['title' => 'Registration']);
        View::render('Auth/registration.php');
        View::render('Parts/footer.php');
    }
    public function verify()
    {
        echo "AuthController method verify";
    }
    public function logout()
    {
        echo "AuthController method logout";
    }
}