<nav class="menu">
    <?php
    Anchor(
        class: $view == 'home' ? 'active' : '',
        text: 'Home',
        icon: 'views/icons/home-icon.php',
        link: '/'
    );
    Anchor(
        class: $view == 'profile' ? 'active' : '',
        text: 'Profile',
        icon: 'views/icons/profile-icon.php',
        link: '/profile'
    );
    Anchor(
        class: $view == 'game' ? 'active' : '',
        text: 'Game',
        icon: 'views/icons/game-icon.php',
        link: '/game'
    );
    Anchor(
        class: $view == 'score' ? 'active' : '',
        text: 'Score',
        icon: 'views/icons/score-icon.php',
        link: '/score'
    );
    Anchor(
        class: $view == 'shop' ? 'active' : '',
        text: 'Shop',
        icon: 'views/icons/shop-icon.php',
        link: '/shop'
    );
    ?>
</nav>
<hr>
<?php
Anchor(
    text: 'Log&nbsp;out',
    icon: 'views/icons/logout-icon.php',
    link: '/logout'
);
?>