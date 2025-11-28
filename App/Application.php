<?php

namespace App;

use Exception;

class Application
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        try {
            // Получаем метод и URI
            $method = $_SERVER['REQUEST_METHOD'];
            $uri = $_SERVER['REQUEST_URI'];

            // Обрабатываем PUT/DELETE запросы
            if ($method === 'POST' && isset($_POST['_method'])) {
                $method = strtoupper($_POST['_method']);
            }

            // Маршрутизация
            $route = $this->router->route($method, $uri);

            // Выполняем обработчик
            $response = $this->executeHandler($route);

            // Отправляем ответ
            echo $response;

        } catch (Exception $e) {
            http_response_code(500);
            echo "Ошибка: " . $e->getMessage();
        }
    }

    private function executeHandler(array $route)
    {
        if (isset($route['callback'])) {
            return call_user_func_array($route['callback'], $route['params']);
        }

        // Подключаем класс контроллера
        $controllerClass = 'App\Controllers\\' . $route['controller'];


        if (!class_exists($controllerClass)) {
            throw new Exception("Controller class not found: $controllerClass");
        }

        $controller = new $controllerClass();
        $method = $route['method'];

        if (!method_exists($controller, $method)) {
            throw new Exception("Method not found: $controllerClass@$method");
        }

        // Вызываем метод с параметрами
        return call_user_func_array([$controller, $method], $route['params']);
    }
}