<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title??'Blog'?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="/">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
<?php       if(\App\Helpers\SessionHelper::isUserLoggedIn())
            { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/registration">Registration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white">|</a>
                </li>
<?php       } else
            { ?>
                <li class="nav-item">
                    <a class="nav-link text-white"><?php print_r($_SESSION['user_data']['first_name']); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">exit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white">|</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/posts">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/posts/create">Create post</a>
                </li>
<?php        }?>
        </ul>
        <?php $table = $table??'users';
        if ($table !== 'users') { ?>
        <ul class="nav bar-nav align-end">
            <li class="nav-item">
                <a class="btn btn-primary" href="create"><?=$table?>CREATE TABLES  <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <?php } ?>
    </div>
</nav>
<?php if(!empty($_SESSION['notification'])) { ?>
<div class="alert alert-primary " style="text-align: center">
<?php   echo $_SESSION['notification'];
        unset($_SESSION['notification']);?>
</div>
<?php }?>


