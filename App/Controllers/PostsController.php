<?php
namespace App\Controllers;

use App\Helpers\FileHelper;
use App\Helpers\SessionHelper;
use App\Models\Post;
use App\Models\User;
use App\Validation\Post\CreatePostValidator;
use Core\Controller;
use Core\View;

include_once dirname(__DIR__) . '/../Config/function.php';
include_once dirname(__DIR__) . '/../Config/constant.php';
class PostsController extends Controller
{

    private $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    public function index()
    {
        $this->before();
        $post= new Post();
        $posts = $post->getPostByUserId($_SESSION['user_data']['id']);
        View::render('Parts/header.php', ['title' => 'Posts admin']);
        View::render('Post/index.php', ['posts'=> $posts]);
        View::render('Parts/footer.php');
        die();
    }
    public function create()
    {
        $this->before();

        View::render('Parts/header.php', ['title' => 'Create post']);
        View::render('Post/create.php');
        View::render('Parts/footer.php');
        die();

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
                'content' =>$fields['content'],
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
        $this->before();
        $this->checkUser($id);
        $fields = $_POST;
        $postValidator = new CreatePostValidator();
        $post= new Post();
        $posts = $post->getPostById($id)[0];
        /**
         * Valid the title and the content in post update
         */
        if(!$postValidator->storeValidation($fields))
        {
            $error = $postValidator->getErrors();

            View::render('Parts/header.php', ['title' => 'Edit post']);
            View::render('Post/edit.php', [
                'error'   => $error,
                'title'   => $fields['title'],
                'content' => $fields['content'],
                'image'   => $posts['image'],
                'id'      => $id
            ]);
            View::render('Parts/footer.php');
            die();
        }
        /**
         * Valid image in post update (image must be added)
         */
        if($postValidator->imageValidation($_FILES))
        {
            View::render('Parts/header.php', ['title' => 'Edit post']);
            View::render('Post/edit.php', [
                'title'   => $fields['title'],
                'content' => $fields['content'],
                'image'   => $posts['image'],
                'id'      => $id
            ]);
            View::render('Parts/footer.php');
            die();
        }

        $file = new FileHelper();
        $pathImage = $file->upload($_FILES['image']);   //записывает картинку в папку
        $file->remove($posts['image']);                 //удаляет старую картинку
        $fields['image'] = $pathImage;
        $fields['id']    = $id;

        $this->post->updatePost($fields);
        way('posts/' . $id);

    }
    public function edit($id)
    {
        $this->before();
        $this->checkUser($id);

        $post= new Post();
        $posts = $post->getPostById($id)[0];

        View::render('Parts/header.php', ['title' => 'Edit post']);
        View::render('Post/edit.php', [
            'title'     => $posts['title'],
            'content'   => $posts['content'],
            'image'     => $posts['image'],
            'id'        => $posts['id']
        ]);
        View::render('Parts/footer.php');
        die();
    }
    public function delete($id)
    {
        $this->before();
        $this->checkUser($id);
        $posts= new Post();
        $post = $posts->getPostById($id)[0];
        $posts->deletePost($id);


        $file = new FileHelper();
        $file->remove($post['image']);


        way('posts');
        exit();

    }
    public function show($id)
    {
        if($this->post->getPostById($id) == null)
        {
            $_SESSION['notification'] = 'This is article is not find!';
            /**
             * way - redirect at home
             */
            way('home');
        }
        $user=new User();
        $post = $this->post->getPostById($id)[0];
        $user = $user->getUserFromId($post['user_id']);
        $post['name'] = " " . $user['first_name']  . ' ' . $user['last_name'];
        View::render('Parts/header.php', ['title' => "Article #{$id}"]);
        View::render('Post/show.php', $post);
        View::render('Parts/footer.php');
    }

    /**
     * link at home if article isn't users login
     */
    public function checkUser($id)
    {
        $post = new Post();
        $post = $post->getPostById($id)[0]['user_id'];
        if($post !== SessionHelper::getUserId())
        {
            $_SESSION['notification'] = '404 error! This page wasn\'t find!';
            way('');
        }
    }
}