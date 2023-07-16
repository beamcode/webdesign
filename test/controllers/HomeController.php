<?php
// HomeController.php

require_once 'models/HomeModel.php';
require_once 'views/HomeView.php';

class HomeController {
    private $model;
    private $view;

    public function __construct() {
        require_once 'models/HomeModel.php';
        $this->model = new HomeModel();

        require_once 'views/HomeView.php';
        $this->view = new HomeView();
    }

    public function index() {
        $title = $this->model->getTitle();

        $this->view->render($title);
    }
}
?>
