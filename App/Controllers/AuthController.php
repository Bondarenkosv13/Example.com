<?php
namespace App\Controllers;

use App\Helpers\SessionHelper;
use App\Models\User;
use App\Validation\UserValidator;
use Core\View;

include_once dirname(__DIR__) . '/../Config/function.php';

class AuthController
{
    public function login()
    {
        View::render('Parts/header.php', ['title' => 'Login']);
        View::render('Auth/login.php');
        View::render('Parts/footer.php');
    }
    public function register()
    {
        View::render('Parts/header.php', ['title' => 'Registration']);
        View::render('Auth/registration.php');
        View::render('Parts/footer.php');
    }
    public function verify()
    {
        unset($_SESSION['error']);
        foreach ($_POST as $key => $value)
        {
            $fields[$key] = trim($value);
            if($fields[$key] == null){
                $_SESSION['error'] = "Fill in all the fields";
                unset ($_SESSION['user_data']);
                way('login');
            }
        }
        $userValidation = new UserValidator();
        $user = new User();
        $userParams = $user->checkAll();

        if($userValidation->suchAnEmailExists($userParams, $fields['email']))
        {
            $userData = $user->checkUser($fields['email']);

            if(password_verify($fields['password'], $userData['password']))
            {
                SessionHelper::setUser($userData);
                way('home');
            }
            else {
                SessionHelper::setUser($userData);
                $_SESSION['error'] = "Invalid email or password";
                way('login');
            }
        }
        else {
            $_SESSION['error'] = "Invalid email or password";
             way('login');
        }

    }
    public function logout()
    {
        SessionHelper::destroyUserData();
        way('');
    }
}