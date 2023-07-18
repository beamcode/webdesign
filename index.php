<?php
session_start();
require_once 'models/database.php';
require_once 'models/ExceptionWithField.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        header('Location: /signin');
        exit();
        break;
    case '/home':
        $view = 'home';
        require_once './views/layout.php';
        break;
    case '/profile':
        $view = 'profile';
        require_once './views/layout.php';
        break;
    case '/score':
        $view = 'score';
        require_once './views/layout.php';
        break;
    case '/shop':
        $view = 'shop';
        require_once './views/layout.php';
        break;
    case '/game':
        $view = 'game';
        require_once './views/layout.php';
        break;
    case '/signin':
        require_once './views/signin.php';
        break;
    case '/signup':
        require_once './views/signup.php';
        break;
    case '/signout':
        require_once './views/signout.php';
        break;
    default:
        header('HTTP/1.1 404 Not Found');
        echo 'Page not found!';
        echo $uri;
        exit();
}
