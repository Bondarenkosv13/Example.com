<?php
namespace App\Controllers;

use App\Models\User;
use App\Validation\UserValidator;
use Core\LogError;
use Core\View;

class UserController
{
    public $data = [];

    public function store()
    {

        foreach ($_POST as $key => $value)
        {
            $fields[$key] = trim($value);
        }
        $this->data = $fields;
        $userValidation = new UserValidator();

        if ($userValidation->storeValidation($fields))
        {
            $user = new User();
            $user->addUser($fields);
            LogError::header();
        }
        else {

            $data = $this->data;
            $error = $userValidation->getErrors();

            View::render('Parts/header.php', ['title' => 'Registration']);
            View::render('Auth/registration.php',['data' => $data, 'error' => $error]);
            View::render('Parts/footer.php');
        };

    }
}