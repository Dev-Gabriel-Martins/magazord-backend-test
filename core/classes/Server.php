<?php

namespace core\classes;

class Server extends Controller
{
    private $routes = [];

    public function route($method, $uri, $action)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'action' => $action
        ];
    }

    public function dispatch()
    {

        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            $requestMethod = strtoupper($_POST['_method']);
        }

        foreach ($this->routes as $route) {
            $pattern = preg_replace('#\{[a-zA-Z_][a-zA-Z0-9_]*\}#', '([a-zA-Z0-9_-]+)', $route['uri']);
            $pattern = "#^" . $pattern . "$#";

            if ($route['method'] === $requestMethod && preg_match($pattern, $requestUri, $matches)) {
                try {

                    array_shift($matches);
                    [$controllerClass, $controllerMethod] = $route['action'];
                    $controller = new $controllerClass();

                    return call_user_func_array([$controller, $controllerMethod], $matches);
                } catch (\Exception $th) {
                    $this->renderNotFound();
                }
            }
        }

        $this->renderNotFound();
    }

}
