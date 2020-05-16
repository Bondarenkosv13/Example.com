<?php
namespace App\Controllers;

use App\Helpers\FileHelper;
use App\Helpers\SessionHelper;
use App\Models\Post;
use App\Validation\Post\CreatePostValidator;
use Core\View;

include_once dirname(__DIR__) . '/../Config/function.php';
include_once dirname(__DIR__) . '/../Config/constant.php';
class PostsController
{

    private $post;

    public function __construct()
    {
        $this->post = new Post();
    }

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
        $fields = $_POST;
        $postValidator = new CreatePostValidator();
        /**
         * Valid the title and the content in post create
         */
        if(!$postValidator->storeValidation($fields))
        {
            $error = $postValidator->getErrors();

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
        if($postValidator->imageValidation($_FILES))
        {
            View::render('Parts/header.php', ['title' => 'Create post']);
            View::render('Post/create.php', ['title'=> $fields['title'], 'content'=>$fields['content']]);
            View::render('Parts/footer.php');
            die();
        }

        $file = new FileHelper();
        $pathImage = $file->upload($_FILES['image']);
        $fields['image'] = $pathImage;
        $fields['user_id']    = SessionHelper::getUserId();

        $id = $this->post->addPost($fields);
        way('posts/' . $id);
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
        $post = $this->post->getPostById($id)[0];
        View::render('Parts/header.php', ['title' => "Article #{$id}"]);
        View::render('Post/show.php', [
            'title'     => $post['title'],
            'content'   => $post['content'],
            'image'     => PATH_IMAGE . $post['image']
            ]);
        View::render('Parts/footer.php');
       print_r($this->post->getPostById($id)[0]);
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