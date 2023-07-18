<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="theme.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="views/game/game.css">
</head>
<body>
    <?php
    require 'views/components/button.php';
    require 'views/components/anchor.php';
    require 'views/components/input.php';
    require 'views/components/sidebar.php';
    ?>

    <div class="scaffold-layout">
        <aside class="scaffold-layout-sidebar left collapsed" id="sidebarLeft">
            <?php SideBar("views/components/menu.php", "toggleSidebar('sidebarLeft')"); ?>
        </aside>

        <main class="scaffold-layout-main">
            <header class="scaffold-layout-header">
                <?php require_once 'views/components/header.php'; ?>
            </header>
            <div class="scaffold-layout-content">
                <?php require_once "views/{$view}.php"; ?>
            </div>
        </main>

        <aside class="scaffold-layout-sidebar right collapsed" id="sidebarRight">
            <?php SideBar("views/components/chatbox.php", "toggleSidebar('sidebarRight')"); ?>
        </aside>
    </div>
    <script src="../script.js"></script>
    <script type="module" src="views/game/script.js"></script>
</body>
</html>