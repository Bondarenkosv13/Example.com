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


}