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

    public function changePassword()
    {
        $this->before();
        View::render('Parts/header.php', ['title' => 'Update password']);
        View::render('Auth/changePassword.php');
        View::render('Parts/footer.php');

    }

    public function updatePassword()
    {
        $this->before();
        foreach ($_POST as $key => $value)
        {
            $fields[$key] = trim($value);
            if($fields[$key] == null){
                $_SESSION['error'] = "Fill in all the fields";
                View::render('Parts/header.php', ['title' => 'Update password']);
                View::render('Auth/changePassword.php');
                View::render('Parts/footer.php');
                die();
            }
        }
        $oldPassword = $_POST['old_password'] ?? null;
        $UserValidator = new UserValidator();
        if($UserValidator->ValidatorPassword($oldPassword))
        {
            View::render('Parts/header.php', ['title' => 'Update password']);
            View::render('Auth/changePassword.php');
            View::render('Parts/footer.php');
            die();
        }

        if($_POST['new_password_1'] !== $_POST['new_password_2'])
        {
            $_SESSION['error'] = "Password mismatch";
            View::render('Parts/header.php', ['title' => 'Update password']);
            View::render('Auth/changePassword.php');
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

    public function changeName()
    {
        $data = $_SESSION['user_data'] ?? null;
        $this->before();
        View::render('Parts/header.php', ['title' => 'Update name']);
        View::render('Auth/changeName.php', ['data' => $data]);
        View::render('Parts/footer.php');
    }
    public function updateName()
    {
        $this->before();
        foreach ($_POST as $key => $value)
        {
            $fields[$key] = trim($value);
        }
        $userValidation = new UserValidator();
        $user = new User();
        $userParams = $user->checkAll();
        $fields = $fields ?? null;

        if($userValidation->ValidatorPassword($fields['password']))
        {
            $data = $fields ?? null;
            $error['password'] = 'Invalid password!';

            View::render('Parts/header.php', ['title' => 'Update name']);
            View::render('Auth/changeName.php', ['data' => $data, 'error' => $error]);
            View::render('Parts/footer.php');
            die();
        }

        $fields['password'] = $_SESSION['user_data']['password'];

        if ($userValidation->storeValidation($fields) && $userValidation->validatorEmail($userParams, $fields['email']))
        {
            $id = $_SESSION['user_data']['id'];
            $user->updateUser($fields, $id);

            /**
             * way - function header('Location: ...')
             * path - Config/function
             */
            $_SESSION['user_data']['first_name'] = $fields['first_name'];
            $_SESSION['user_data']['last_name']  = $fields['last_name'];
            $_SESSION['user_data']['email']      = $fields['email'];
            $_SESSION['user_data']['birthday']   = $fields['birthday'];
            way(' ');
        }
        else {

            $error = $userValidation->getErrors();
            $data = $_SESSION['user_data'] ?? null;

            View::render('Parts/header.php', ['title' => 'Update name']);
            View::render('Auth/changeName.php', ['data' => $data, 'error' => $error]);
            View::render('Parts/footer.php');

            die();
        };
    }
}