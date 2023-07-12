<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Home</title>
    <meta name="author" content="name" />
    <meta name="description" content="Home" />
    <meta name="keywords" content="Home" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="../styles/global.css" />
    <link rel="stylesheet" type="text/css" href="../styles/navbar.css">
    <link rel="stylesheet" type="text/css" href="../styles/main.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./api/getMessages.js"></script>
    <script src="./api/sendMessage.js"></script>
</head>

<body class="flex flex-col sm:flex-row w-full font-sans">
    <?php include './components/navbar.php'; ?>
    <?php include './components/main.php'; ?>
    <!-- <?php include './components/chatbox.php'; ?> -->
</body>

</html>