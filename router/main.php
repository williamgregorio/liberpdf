<?php
$request = $_SERVER['REQUEST_URI'];
$root = dirname(__DIR__);
$views = $root . '/views/';

switch($request) {
  case '':
  case '/':
    require $views . 'home.php';
    break;
  case '/register':
    require $views . 'register.php';
    break;
  case '/login':
    require $views . 'login.php';
    break;
  case '/dashboard':
    require $views . 'admin.php';
    break;
  default:
    http_response_code(404);
    require $views . '404.php';
    break;
}

