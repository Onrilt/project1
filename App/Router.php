<?php

namespace App;

use Exception;

class Router
{
    private $routes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function route(string $method, string $uri)
    {
        // Убираем конечный слеш и параметры запроса
        $uri = rtrim(parse_url($uri, PHP_URL_PATH), '/');
        $uri = $uri ?: '/';

        $requestMethod = $method;

        // Ищем точное совпадение метода и URI
        $routeKey = "$requestMethod $uri";

        if (isset($this->routes[$routeKey])) {
            return $this->resolveRoute($this->routes[$routeKey]);
        }

        // Ищем совпадение с параметрами
        foreach ($this->routes as $route => $handler) {
            list($routeMethod, $routePattern) = explode(' ', $route, 2);

            if ($routeMethod !== $requestMethod) {
                continue;
            }

            // Заменяем {параметры} на регулярные выражения
            $pattern = preg_replace('/\{([a-z]+)\}/', '([^/]+)', $routePattern);
            $pattern = "#^$pattern$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Убираем полное совпадение

                // Извлекаем имена параметров
                preg_match_all('/\{([a-z]+)\}/', $routePattern, $paramNames);
                $params = array_combine($paramNames[1], $matches);

                return $this->resolveRoute($handler, $params);
            }
        }

        // Маршрут не найден
        return $this->resolveRoute($this->routes['GET /404'] ?? null);
    }

    private function resolveRoute($handler, array $params = [])
    {
        if (!$handler) {
            throw new Exception('Route handler not found');
        }

        if (is_string($handler)) {
            list($controller, $method) = explode('@', $handler);

            return [
                'controller' => $controller,
                'method' => $method,
                'params' => $params
            ];
        }

        if (is_callable($handler)) {
            return [
                'callback' => $handler,
                'params' => $params
            ];
        }

        throw new Exception('Invalid route handler');
    }
}