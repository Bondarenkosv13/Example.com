<?php
namespace App\Controllers;

use App\Helpers\FileHelper;
use App\Helpers\SessionHelper;
use App\Validation\Post\CreatePostValidator;
use Core\View;

include_once dirname(__DIR__) . '/../Config/function.php';
class PostsController
{
    public function index()
    {
        echo "PostsController method index";
    }
    public function create()
    {
        $this->before();

        View::render('Parts/header.php', ['title' => 'Create post']);
        View::render('Post/create.php');
        View::render('Parts/footer.php');

    }
    public function store()
    {
        $this->before();
        $post = new CreatePostValidator();

        $fields = $_POST;

        /**
         * Valid the title and the content in post create
         */
        if(!$post->storeValidation($fields))
        {
            $error = $post->getErrors();

            View::render('Parts/header.php', ['title' => 'Create post']);
            View::render('Post/create.php', [
                'error'   =>$error,
                'title'   =>$fields['title'],
                'content' =>$fields['content']
            ]);
            View::render('Parts/footer.php');
            die();
        }
        /**
         * Valid image in post create (image must be added)
         */
        if($post->imageValidation($_FILES))
        {
            View::render('Parts/header.php', ['title' => 'Create post']);
            View::render('Post/create.php', ['title'=> $fields['title'], 'content'=>$fields['content']]);
            View::render('Parts/footer.php');
            die();
        }

        $file = new FileHelper();
        $pathImage = $file->upload($_FILES['image']);

        $file->remove($pathImage);


    }
    public function update($id)
    {
        echo "PostsController method update and params $id";
    }
    public function edit($id)
    {
        echo "PostsController method edit and params $id";
    }
    public function delete($id)
    {
        echo "PostsController method delete and params $id";
    }
    public function show($id)
    {
        echo "PostsController method show and params $id";
    }

    /**
     * lick at home if user doesn't login
     */
    public function before()
    {
        if(SessionHelper::isUserLoggedIn())
        {
            $_SESSION['notification'] = 'To view this page you need to log in!';
            way('');
        }

    }
}