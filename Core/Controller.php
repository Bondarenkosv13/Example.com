<?php
namespace Core;

use App\Helpers\SessionHelper;
use App\Models\Post;

abstract class Controller
{
    /**
     * link at home if user doesn't login
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