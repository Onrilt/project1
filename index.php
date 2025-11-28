<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
// Автозагрузка классов
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Загружаем маршруты
$routes = require 'routes.php';

// Создаем и запускаем приложение
$router = new App\Router($routes);
$app = new App\Application($router);
$app->run();