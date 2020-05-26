<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title??'Blog'?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
          crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

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
                <div class="dropdown">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                           role="button"
                           data-toggle="dropdown">Account admin</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/user/changeName">Change user's data</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/user/changePassword">Change password</a>
                        </div>
                    </li>
                </div>
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


