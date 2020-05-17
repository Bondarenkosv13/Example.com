<?php
namespace App\Controllers;

use App\Helpers\SessionHelper;
use App\Models\User;
use App\Validation\UserValidator;
use Core\Controller;
use Core\View;

include_once dirname(__DIR__) . '/../Config/function.php';

class UserController extends Controller
{
    public function store()
    {
        if(!SessionHelper::isUserLoggedIn())
        {
            $_SESSION['notification'] = 'You are login!';
            way('');
        }

        foreach ($_POST as $key => $value)
        {
            $fields[$key] = trim($value);
        }
        $userValidation = new UserValidator();
        $user = new User();
        $userParams = $user->checkAll();
        $fields = $fields ?? null;
        if ($userValidation->storeValidation($fields) && $userValidation->validatorEmail($userParams, $fields['email']))
        {
            $user->addUser($fields);
            /**
             * way - function header('Location: ...')
             * path - Config/function
             */
            way('login');
        }
        else {
            $error = $userValidation->getErrors();

            View::render('Parts/header.php', ['title' => 'Registration']);
            View::render('Auth/registration.php',['data' => $fields, 'error' => $error]);
            View::render('Parts/footer.php');
        };
    }

    public function password()
    {
        $this->before();
        View::render('Parts/header.php', ['title' => 'Update password']);
        View::render('Auth/password.php');
        View::render('Parts/footer.php');

    }

    public function update()
    {
        $this->before();
        foreach ($_POST as $key => $value)
        {
            $fields[$key] = trim($value);
            if($fields[$key] == null){
                $_SESSION['error'] = "Fill in all the fields";
                View::render('Parts/header.php', ['title' => 'Update password']);
                View::render('Auth/password.php');
                View::render('Parts/footer.php');
                die();
            }
        }
        $oldPassword = $_POST['old_password'] ?? null;
        $UserValidator = new UserValidator();
        if($UserValidator->ValidatorPassword($oldPassword))
        {
            View::render('Parts/header.php', ['title' => 'Update password']);
            View::render('Auth/password.php');
            View::render('Parts/footer.php');
            die();
        }

        if($_POST['new_password_1'] !== $_POST['new_password_2'])
        {
            $_SESSION['error'] = "Password mismatch";
            View::render('Parts/header.php', ['title' => 'Update password']);
            View::render('Auth/password.php');
            View::render('Parts/footer.php');
            die();
        }

        $password  = password_hash($_POST['new_password_1'], PASSWORD_DEFAULT);
        $user = new User();
        $user->updatePassword($password, SessionHelper::getUserId());

        $_SESSION['notification'] = "Password changed successfully!";

        /**
         * way - function header('Location: ...')
         * path - Config/function
         */
        way('');


    }
}