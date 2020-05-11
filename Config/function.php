<?php

function way($path)
{
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/' .$path);
    exit();
}