<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
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
    case '/login':
        require_once './views/login.php';
        break;
    case '/signup':
        require_once './views/signup.php';
        break;
    default:
        header('HTTP/1.1 404 Not Found');
        echo 'Page not found!';
        echo $uri;
        exit();
}
