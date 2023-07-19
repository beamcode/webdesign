<?php
Button(
    icon: 'views/icons/menu-icon.php',
    onclick: "toggleSidebar('sidebarLeft')"
);

Button(
    icon: 'views/icons/chat-icon.php',
    onclick: "toggleSidebar('sidebarRight')"
);
// Get all users from the database
$sql = "SELECT Users.username, Users.profile_image, Users.highscore, Users.description FROM Users";
$result = $db->query($sql);
// Check if the query was successful
if ($result) {
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $result->close();
    $users = $data;
} else {
    // Error occurred while fetching messages
    $users = null;
}
?>
<input class="input" list="search" id="search-input" placeholder="search for your friends">
<datalist id="search">
    <?php
    foreach ($users as $user) {
        echo "<option value=\"{$user['username']}\">";
    }
    ?>
</datalist>
<button id="submit-button">Submit</button>

<script>
    const submitButton = document.getElementById('submit-button');
    const browserInput = document.getElementById('search-input');

    const handleKeyPress = (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            const browserValue = browserInput.value;
            window.location.href = `/profile.php?id=${browserValue}`;
        }
    };

    submitButton.addEventListener('click', () => {
        const browserValue = browserInput.value;
        window.location.href = `/profile.php?id=${browserValue}`;
    });

    browserInput.addEventListener('keydown', handleKeyPress);
</script>
