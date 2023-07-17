<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        $content = 'home';
        break;
    case '/profile':
        $content = 'profile';
        break;
    case '/score':
        $content = 'score';
        break;
    case '/shop':
        $content = 'shop';
        break;
    case '/game':
        $content = 'game';
        break;
    default:
        header('HTTP/1.1 404 Not Found');
        echo 'Page not found!';
        echo $uri;
        exit();
}

require_once './views/layout.php';
?>
