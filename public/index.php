<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use Controllers\PostController;

$router = new Router();

// Routes
$router->get('/api/posts', [new PostController(), 'getAll']);
$router->get('/api/posts/{id}', [new PostController(), 'get']);
$router->post('/api/posts', [new PostController(), 'create']);
$router->put('/api/posts/{id}', [new PostController(), 'update']);
$router->delete('/api/posts/{id}', [new PostController(), 'delete']);

// Dispatch the router
$router->dispatch();
?>
