<?php
namespace App\Validation;


use App\Helpers\SessionHelper;
use App\Models\User;
use Core\Validator;
include_once dirname(__DIR__) . '/../Config/function.php';

class UserValidator extends Validator
{
    protected $errors = [
        'first_name_error'  => 'Name must have from 2 to 55 letters and have only English or Russian letters',
        'last_name_error'   => 'Surname must have from 2 to 55 letters and have only English or Russian letters',
        'email_error'       => 'E-mail is invalid',
        'birthday_error'    => 'Date is invalid',
        'password_error'    => 'Password must have min 2 letters, min 1 big, 1 small letters and min 1 digit!'
    ];

    protected $rules = [
        'first_name'    => '/^[a-zа-я]{2,55}$/i',
        'last_name'     => '/^[a-zа-я]{2,55}$/i',
        'email'         => '/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i',
        'birthday'      => '/^[\d]{4}-[\d]{2}-[\d]{2}$/',
        'password'      => '/^\S*(?=\S{2,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/'
    ];

    public function storeValidation ($fields)
    {
        if($fields != null) {
            foreach ($fields as $key => $field) {
                if (preg_match($this->rules[$key], $field)) {
                    unset($this->errors["{$key}_error"]);
                }
            }
            return empty($this->errors);
        } else {
            way('');
        }
    }

    public function validatorEmail ($userParams, $email)
    {
            foreach ($userParams as $userParam)
            {
                if($userParam['email'] === $email)
                {
                   $this->errors['email_error'] = 'This email already exists';
                   return false;
                }
            }
        return true;
    }

    public function suchAnEmailExists($userParams, $email)
    {
        foreach ($userParams as $userParam) {
            if($userParam['email'] === $email)
            {
                return true;
            }
        }
        return false;
    }

    public function ValidatorPassword($password)
    {
        if(!password_verify($password, $_SESSION['user_data']['password']))
        {
            $_SESSION['error'] = "Wrong the old password!";
            return true;
        }
    }
}