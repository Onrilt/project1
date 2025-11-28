<?php

namespace App\Controllers;

class NewsController
{
    public function index()
    {
        require 'views/news/index.php';
    }

    public function show($id)
    {
        require 'views/news/show.php';
    }
}