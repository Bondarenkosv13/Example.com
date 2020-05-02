<?php
namespace App\Controllers;
class PostsController
{
    public function index()
    {
        echo "PostsController method index";
    }
    public function create()
    {
        echo "PostsController method create";
    }
    public function store()
    {
        echo "PostsController method store";
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
}