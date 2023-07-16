<?php
// controllers/BaseController.php

class ProfileController {

    public function index() {
        // Début du HTML
        echo '<!DOCTYPE html><html><head><title>My Site</title></head><body>';

        // Affichage du menu
        echo '<ul>';
        echo '<li><a href="/">Home</a></li>';
        echo '<li><a href="/profile">Profile</a></li>';
        echo '<li><a href="/score">Score</a></li>';
        echo '<li><a href="/shop">Shop</a></li>';
        echo '<li><a href="/game">Game</a></li>';
        echo '</ul>';

        // Affichage du contenu de la page
        echo '<div id="main">PAGE CONTENT</div>';

        // Fin du HTML
        echo '</body>profile</html>';
    }
}
?>
