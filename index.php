<?php
// C:\xampp\htdocs\CRUD2 - Copie\index.php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the URL path
$request = $_SERVER['REQUEST_URI'];
$request = strtok($request, '?'); // Remove query string

// Remove base path if in subdirectory
$basePath = '/CRUD2 - Copie';
if (strpos($request, $basePath) === 0) {
    $request = substr($request, strlen($basePath));
}

// Load controller
require_once __DIR__ . '/User/Controllers/UserController.php';
$controller = new UserController();

// Route to appropriate method
if ($request === '/' || $request === '/user' || $request === '') {
    $controller->index();
    
} elseif ($request === '/user/create') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->create();
    }
    
} elseif ($request === '/user/store') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->store();
    } else {
        header('Location: /user/create');
        exit;
    }
    
} elseif (preg_match('#^/user/edit/(\d+)$#', $request, $matches)) {
    $controller->edit($matches[1]);
    
} elseif (preg_match('#^/user/update/(\d+)$#', $request, $matches)) {
    $controller->update($matches[1]);
    
} elseif (preg_match('#^/user/delete/(\d+)$#', $request, $matches)) {
    $controller->delete($matches[1]);
    
} else {
    http_response_code(404);
    echo "<h1>404 - Page Not Found</h1>";
    echo "<p>URL demandée: " . htmlspecialchars($request) . "</p>";
    echo '<a href="/user">Retour à la liste</a>';
}