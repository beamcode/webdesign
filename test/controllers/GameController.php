<?php
// GameController.php

require_once 'models/GameModel.php';
require_once 'views/GameView.php';

class GameController {
    private $model;
    private $view;

    public function __construct() {
        require_once 'models/GameModel.php';
        $this->model = new GameModel();

        require_once 'views/GameView.php';
        $this->view = new GameView();
    }

    public function index() {
        $this->view->render();
    }
}
?>
