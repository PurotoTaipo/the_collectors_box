<?php
abstract class Controller
{
    protected function view(string $view, array $data = [], string $layout = 'main'): void
    {
        extract($data);
        $viewFile = APP_ROOT . '/app/Views/' . str_replace('.', '/', $view) . '.php';

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require APP_ROOT . '/app/Views/layouts/' . $layout . '.php';
    }

    protected function redirectTo(string $controller, string $action = 'index', array $params = []): void
    {
        header('Location: ' . linkTo($controller, $action, $params));
        exit;
    }

    protected function requireAuth(): void
    {
        if (!Auth::isLoggedIn()) {
            $this->redirectTo('auth', 'login');
        }
    }
}
