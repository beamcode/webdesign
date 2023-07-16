<?php

require_once 'controllers/HomeController.php';
require_once 'controllers/ProfileController.php';
require_once 'controllers/ScoreController.php';
require_once 'controllers/ShopController.php';
require_once 'controllers/GameController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ('/' === $uri) {
    $controller = new HomeController();
    $controller->index();
} elseif ('/profile' === $uri) {
    $controller = new ProfileController();
    $controller->index();
} elseif ('/score' === $uri) {
    $controller = new ScoreController();
    $controller->index();
} elseif ('/shop' === $uri) {
    $controller = new ShopController();
    $controller->index();
} elseif ('/game' === $uri) {
    $controller = new GameController();
    $controller->index();
} else {
    header('HTTP/1.1 404 Not Found');
    echo 'Page not found!';
    echo $uri;
}

?>
