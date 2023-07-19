<?php
session_start();
require_once 'models/database.php';
require_once 'models/ExceptionWithField.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$tokens = explode('/', $uri);
$uri = $tokens[sizeof($tokens) - 1];
$workingdir = '/finalteam3/';

switch ($uri) {
    case '':
        header('Location: ' . $workingdir . 'signin.php');
        exit();
        break;
    case 'index.php':
        header('Location: ' . $workingdir . 'signin.php');
        exit();
        break;
    case 'home.php':
        $view = 'home';
        require_once './views/layout.php';
        break;
    case 'profile.php':
        $view = 'profile';
        require_once './views/layout.php';
        break;
    case 'score.php':
        $view = 'score';
        require_once './views/layout.php';
        break;
    case 'shop.php':
        $view = 'shop';
        require_once './views/layout.php';
        break;
    case 'game.php':
        $view = 'game';
        require_once './views/layout.php';
        break;
    case 'signin.php':
        require_once './views/signin.php';
        break;
    case 'signup.php':
        require_once './views/signup.php';
        break;
    case 'signout.php':
        require_once './views/signout.php';
        break;
    default:
        header('HTTP/1.1 404 Not Found');
        echo 'Page not found!';
        echo $uri;
        exit();
}
