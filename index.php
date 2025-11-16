<?php
// C:\xampp\htdocs\projects\projetWeb\index.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the URL path
$request = $_SERVER['REQUEST_URI'];
$request = strtok($request, '?'); // Remove query string

// Remove base path if in subdirectory
$basePath = '/projects/projetWeb';
if (strpos($request, $basePath) === 0) {
    $request = substr($request, strlen($basePath));
}

// Ensure request starts with /
if (empty($request) || $request[0] !== '/') {
    $request = '/' . $request;
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
        header('Location: /projects/projetWeb/user/create');
        exit;
    }
    
} elseif (preg_match('#^/user/edit/(\d+)$#', $request, $matches)) {
    $controller->edit($matches[1]);
    
} elseif (preg_match('#^/user/update/(\d+)$#', $request, $matches)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->update($matches[1]);
    }
    
} elseif (preg_match('#^/user/delete/(\d+)$#', $request, $matches)) {
    $controller->delete($matches[1]);
    
} else {
    http_response_code(404);
    echo "<h1>404 - Page Not Found</h1>";
    echo "<p>URL demandée: " . htmlspecialchars($request) . "</p>";
    echo '<a href="/projects/projetWeb/user">Retour à la liste</a>';
}