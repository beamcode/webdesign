<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        $content = 'home';
        require_once './views/layout.php';
        break;
    case '/profile':
        $content = 'profile';
        require_once './views/layout.php';
        break;
    case '/score':
        $content = 'score';
        require_once './views/layout.php';
        break;
    case '/shop':
        $content = 'shop';
        require_once './views/layout.php';
        break;
    case '/game':
        $content = 'game';
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
