<?php
$request = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];
$root = dirname(__DIR__);
$middleware = $root . '/middleware/db.php';
$views = $root . '/views/';

switch($request) {
  case '':
  case '/':
    require $views . 'home.php';
    break;
  case '/register':
    if ($request_method === 'POST') {
      require $middleware;
      $username = $_POST['username'];
      $password = $_POST['password'];
      $password2 = $_POST['password2'];
      $email = $_POST['email'];

      if (createUser($username, $password, $password2, $email)) {
        echo 'New account has been created.'; 
        session_start();
        $_SESSION['username'] = $username;
        header('Location: /dashboard');
        exit;
      } else {
        echo 'Account will not be created at this time.';
      }
    } else {
      require $views . 'register.php';
    }
    break;
  case '/login':
    if ($request_method === 'POST') {
      require $middleware;
      echo $middleware;

      $username = $_POST['username'];
      $password = $_POST['password'];

      if (login($username, $password)) {
        session_start();
        $_SESSION['username'] = $username;
        header('Location: /dashboard');
        exit;
      } else {
        echo 'Invalid username or password.';
      }
    }      

    session_start();
    if (isset($_SESSION['username'])) {
      header('Location: /dashboard');
      exit;
    }
    require $views . 'login.php';
    break;
  case '/logout':
    if ($request_method === 'POST') {
      require $middleware;
      logout();
    }
    break;
  case '/dashboard':
    session_start();
    if (!isset($_SESSION['username'])){
      header('Location: /login');
    }    
    require $views . 'admin.php';
    break;
  default:
    http_response_code(404);
    require $views . '404.php';
    break;
}

