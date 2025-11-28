<?php

return [
    // Главная страница
    'GET /' => 'HomeController@index',

    // Страница cо всеми новостями
    'GET /news' => 'NewsController@index',

    // Страница c новостью
    'GET /news/{id}' => 'NewsController@show',

    // 404 - должен быть последним
    'GET /404' => 'ErrorController@notFound',
];