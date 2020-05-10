<?php
namespace App\Models;

use Core\Model;

class User extends Model
{
    public function __construct()
    {
        $this->connectDB();
    }

    public function addUser($params)
    {
        extract($params);

        $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `birthday`) 
                VALUES (:first_name, :last_name, :email, :password, :birthday)";
        $param = [
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'email'         => $email,
            'password'      => $password,
            'birthday'      => $birthday
        ];
        $user = $this->dbh->prepare($sql);
        $user->execute($param);
    }
}