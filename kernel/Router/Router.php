<?php

namespace App\Kernel\Router;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct()
    {
        $this->initRoutes();
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (!$route) {
            $this->notFound();
        }

        if (is_array($route->getAction())) {
            [$controller, $action] = $route->getAction();
            $controller = new $controller();

            call_user_func([$controller, $action]);
        } else {
            $route->getAction()();
        }

    }

    private function initRoutes(): void
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }

        //print_r($this->routes);
    }


    /**
     * @return Route[]
     */
    private function getRoutes(): array
    {
        return require_once APP_PATH . '/config/routes.php';
    }

    private function findRoute(string $uri, string $method)
    {
        if (! isset($this->routes[$method][$uri])){
            return false;
        }

        return $this->routes[$method][$uri];
    }

    private function notFound():void
    {
        echo '404 Not Found';
        exit();
    }
}