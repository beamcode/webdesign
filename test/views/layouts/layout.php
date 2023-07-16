<!DOCTYPE html>
<html>
<head>
    <title>My Game Site</title>
    <link rel="stylesheet" type="text/css" href="public/css/theme.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/game.css">
</head>
<body>

    <div class="view">
        <?php require_once 'views/layouts/menu.php'; ?>

        <main class="scaffold-layout">
            <?php require_once 'views/layouts/header.php'; ?>
            <!-- <?php echo $view; ?> -->
            <?php require_once $view; ?>
        </main>
        <?php require_once 'views/layouts/chatbox.php'; ?>
    </div>

    <!-- <?php require_once 'views/layouts/footer.php'; ?> -->

    <script src="public/js/script.js"></script>
    <script type="module" src="public/js/game/script.js"></script>
    <!-- <script type="module" src="public/js/game/Display.js"></script>
    <script type="module" src="public/js/game/Entities.js"></script>
    <script type="module" src="public/js/game/Game.js"></script>
    <script type="module" src="public/js/game/Level.js"></script>
    <script type="module" src="public/js/game/ScreenManager.js"></script>
    <script type="module" src="public/js/game/Vector.js"></script> -->
</body>
</html>
