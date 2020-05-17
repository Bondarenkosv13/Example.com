<?php
namespace App\Models;

use App\Helpers\SessionHelper;
use Core\Model;
use PDO;

class Post extends Model
{
    private $table = 'posts';

    public function __construct()
    {
        $this->connectDB();
    }

    public function addPost($fields)
    {
        $sql = "INSERT INTO `{$this->table}`(`user_id`, `title`, `content`, `image`) 
                VALUES (:user_id, :title, :content, :image)";
        $user = $this->dbh->prepare($sql);
        $user->execute($fields);
        return $this->dbh->lastInsertId();
    }

    public function getPostById($id)
    {
        $post = $this->dbh->prepare("SELECT * FROM `{$this->table}` WHERE id=:id");;
        $post->execute([':id' => $id]);
        $dataPost = $post->fetchAll(PDO::FETCH_ASSOC);
        return $dataPost;

    }

    public function getAllPost()
    {
        $post = $this->dbh->prepare("SELECT * FROM `{$this->table}`");;
        $post->execute();
        $dataPost = $post->fetchAll(PDO::FETCH_ASSOC);
        return $dataPost;
    }

    public function getPostByUserId($user_id)
    {
        $post = $this->dbh->prepare("SELECT * FROM `{$this->table}` WHERE user_id=:user_id");;
        $post->execute([':user_id' => $user_id]);
        $dataPost = $post->fetchAll(PDO::FETCH_ASSOC);
        return $dataPost;
    }

    public function updatePost($fields)
    {
        $sql = "UPDATE `{$this->table}` SET (`title`, `content`, `image`)
                VALUES (:title, :content, :image)";
        $user = $this->dbh->prepare($sql);
        $user->execute($fields);
        return $this->dbh->lastInsertId();
    }

    public function deletePost($id)
    {
        $sql = "DELETE FROM `{$this->table}` WHERE id=:id";
        $user = $this->dbh->prepare($sql);
        $user->execute([':id' => $id]);
    }
}