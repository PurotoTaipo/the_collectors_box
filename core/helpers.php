<?php
function isLocalhost(): bool
{
    $host = strtolower(preg_replace('/:\d+$/', '', $_SERVER['HTTP_HOST'] ?? ''));

    return $host === 'localhost'
        || $host === '127.0.0.1'
        || $host === '::1'
        || str_ends_with($host, '.local')
        || str_ends_with($host, '.test')
        || !str_contains($host, '.');  // no dot = custom hostname like 'marco-pc'
}

function partial(string $name): void
{
    require APP_ROOT . '/app/Views/partials/' . $name . '.php';
}

function linkTo(string $controller, string $action = 'index', array $params = []): string
{
    $segments = array_merge([$controller, $action], $params);
    $path     = '/' . implode('/', $segments);
    $base     = isLocalhost() ? BASE_URL . '/index.php' : BASE_URL;

    return $base . $path;
}
