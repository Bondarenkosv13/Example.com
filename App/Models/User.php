<?php
namespace App\Models;

use App\Helpers\SessionHelper;
use Core\Model;
use PDO;

class User extends Model
{
    private $table = 'users';

    public function __construct()
    {
        $this->connectDB();
    }

    public function addUser($params)
    {
        $sql = "INSERT INTO `{$this->table}`(`first_name`, `last_name`, `email`, `password`, `birthday`) 
                VALUES (:first_name, :last_name, :email, :password, :birthday)";
        $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);
        $user = $this->dbh->prepare($sql);
        $user->execute($params);
        SessionHelper::setUser($params);
        unset($_SESSION['user_data']['password']);
    }

    public function checkAll()
    {
        $params = $this->dbh->prepare("SELECT * FROM `{$this->table}` ");;
        $params->execute();
        $userParams = $params->fetchAll(PDO::FETCH_ASSOC);
        return $userParams;
    }

    public function checkUser($email)
    {
        $params = $this->dbh->prepare("SELECT * FROM `{$this->table}` WHERE email=:email");;
        $params->execute([':email' => $email]);
        $userParams = $params->fetchAll(PDO::FETCH_ASSOC);
        return $userParams[0];
    }

    public function getUserFromId($id)
    {
        $params = $this->dbh->prepare("SELECT * FROM `{$this->table}` WHERE id=:id");;
        $params->execute([':id' => $id]);
        $userParams = $params->fetchAll(PDO::FETCH_ASSOC);
        return $userParams[0];
    }

    public function updatePassword($password, $id)
    {
        $sql = "UPDATE `{$this->table}` 
                SET `password`=:password WHERE id=:id";
        $user = $this->dbh->prepare($sql);
        $user->execute(['password' => $password, 'id' => $id]);
    }

    public function updateUser($fields, $id)
    {
        $sql = "UPDATE `{$this->table}` 
                SET `first_name`=:first_name, `last_name`=:last_name, email=:email, birthday=:birthday WHERE id=:id";
        $user = $this->dbh->prepare($sql);
        $user->execute([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'email' => $fields['email'],
            'birthday' => $fields['birthday'],
            'id' => $id
        ]);
    }
}