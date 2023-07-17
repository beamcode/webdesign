<nav class="menu">
    <?php
    Anchor(
        class: 'active',
        text: 'Home',
        icon: 'views/icons/home-icon.php',
        link: '/'
    );
    Anchor(
        class: 'active',
        text: 'Profile',
        icon: 'views/icons/profile-icon.php',
        link: '/profile'
    );
    Anchor(
        class: 'active',
        text: 'Game',
        icon: 'views/icons/game-icon.php',
        link: '/game'
    );
    Anchor(
        class: 'active',
        text: 'Score',
        icon: 'views/icons/score-icon.php',
        link: '/score'
    );
    Anchor(
        class: 'active',
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