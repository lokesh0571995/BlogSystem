<?php
namespace Core;

use Controllers\PostController;

class Router {
    private $routes = [];

    public function get($path, $handler) {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler) {
        $this->addRoute('POST', $path, $handler);
    }

    public function put($path, $handler) {
        $this->addRoute('PUT', $path, $handler);
    }

    public function delete($path, $handler) {
        $this->addRoute('DELETE', $path, $handler);
    }

    private function addRoute($method, $path, $handler) {
        $this->routes[$method][$path] = $handler;
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    
        // Debugging outputs
        error_log("Request Method: $method");
        error_log("Request Path: $path");
        error_log("Registered Routes: " . print_r($this->routes, true));
    
        foreach ($this->routes[$method] as $routePath => $handler) {
            // Simple parameter matching
            $pattern = preg_replace('/\{[^\}]+\}/', '(\d+)', $routePath);
            $pattern = "#^" . $pattern . "$#";
    
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches); // Remove the full match
                // Call the handler with parameters if needed
                call_user_func_array($handler, $matches);
                return;
            }
        }
    
        Response::error('Not Found', 404);
    }
    
    
}
?>
