<?php
class App
{
    public function run(): void
    {
        $url   = trim($_SERVER['PATH_INFO'] ?? $_GET['url'] ?? 'auth/login', '/');
        $parts = explode('/', $url);

        $controllerName = ucfirst($parts[0]) . 'Controller';
        $method         = $parts[1] ?? 'index';
        $param          = $parts[2] ?? null;

        $controllerFile = APP_ROOT . '/app/Controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            http_response_code(404);
            exit('404 Not Found');
        }

        require_once $controllerFile;
        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            http_response_code(404);
            exit('404 Not Found');
        }

        $param !== null ? $controller->$method($param) : $controller->$method();
    }
}
