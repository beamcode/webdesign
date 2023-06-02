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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../styles/style.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include './api/db.php'; ?>
    <?php include './components/navbar.php'; ?>
 <!-- 
    <div class="flex">
        <div class="flex flex-col h-screen w-full bg-gray-600">
        </div>
    </div> -->
    
    <?php include './components/chatbox.php'; ?>
</body>

<script>
    const nav_links = document.querySelectorAll('a');
    nav_links.forEach(anchor => anchor.addEventListener('click', (event) => {
        event.preventDefault(); // dont follow the link as its a dummy
        nav_links.forEach(anchor => anchor.className = '');
        anchor.className = 'active';
    }));
</script>

</html>