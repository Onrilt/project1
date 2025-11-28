<?php

namespace App\Controllers;

class ErrorController
{
    public function notFound()
    {
        http_response_code(404);
        return "
            <h1>404 - Страница не найдена</h1>
            <p>Запрашиваемая страница не существует</p>
            <a href='/'>На главную</a>
        ";
    }
}