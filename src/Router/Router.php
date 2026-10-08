<?php

namespace App\Router;

class Router {
    private array $routes = [];

    public function get(string $path, callable $action) {
        $this->routes['GET'][$path] = $action;
    }

    public function post(string $path, callable $action) {
        $this->routes['POST'][$path] = $action;
    }

    public function dispatch(string $method, string $path) {
        $action = $this->routes[$method][$path] ?? null;

        if (!$action) {
            http_response_code(404);
            echo 'Page not found!';
            return;
        }

        $action();
    }
}