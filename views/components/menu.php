<nav class="menu">
    <?php
    Anchor(
        class: $view == 'home' ? 'active' : '',
        text: 'Home',
        icon: 'views/icons/home-icon.php',
        link: 'home.php'
    );
    Anchor(
        class: $view == 'profile' ? 'active' : '',
        text: 'Profile',
        icon: 'views/icons/profile-icon.php',
        link: 'profile.php'
    );
    Anchor(
        class: $view == 'game' ? 'active' : '',
        text: 'Game',
        icon: 'views/icons/game-icon.php',
        link: 'game.php'
    );
    Anchor(
        class: $view == 'score' ? 'active' : '',
        text: 'Score',
        icon: 'views/icons/score-icon.php',
        link: 'score.php'
    );
    ?>
</nav>
<hr>
<?php
Anchor(
    text: 'Sign&nbsp;out',
    icon: 'views/icons/logout-icon.php',
    link: 'signout.php'
);
?>