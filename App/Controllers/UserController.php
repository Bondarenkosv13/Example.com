<?php
namespace App\Controllers;

use App\Models\User;
use App\Validation\UserValidator;
use Core\View;

include_once dirname(__DIR__) . '/../Config/function.php';

class UserController
{
    public function store()
    {

        foreach ($_POST as $key => $value)
        {
            $fields[$key] = trim($value);
        }
        $userValidation = new UserValidator();
        $user = new User();
        $userParams = $user->checkAll();

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
            $data = $fields;
            $error = $userValidation->getErrors();

            View::render('Parts/header.php', ['title' => 'Registration']);
            View::render('Auth/registration.php',['data' => $data, 'error' => $error]);
            View::render('Parts/footer.php');
        };

    }
}