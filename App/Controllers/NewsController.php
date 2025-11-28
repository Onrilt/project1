<?php

namespace App\Controllers;

class NewsController
{
    public function index()
    {
        require 'views/news/index.php';
    }

    public function show()
    {
        require 'views/news/show.php';
    }
}