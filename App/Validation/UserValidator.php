<?php
namespace App\Validation;

use Core\Model;
use \PDO;

class UserValidator extends Model
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

    public function __construct()
    {
        $this->connectDB();
    }

    public function storeValidation ($fields)
    {
        foreach ($fields as $key => $field)
        {
            if(preg_match($this->rules[$key], $field))
            {
                unset($this->errors["{$key}_error"]);
            }
        }
        return empty($this->errors);
    }

    public function checkEmail ($email)
    {

        $email_all = $this->dbh->prepare("SELECT * FROM 'users' WHERE email=:email");;
        $email_all->execute([":email"=>$email]);
        $user = $email_all->fetch(PDO::FETCH_ASSOC);

        return !empty($user) ? $user : false;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}