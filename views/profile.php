<?php
include_once 'models/refreshUserData.php';
// refreshUserData($_SESSION['user_id']);
// Extract id from the URL params, if it exists. Like profile?id=toto.
$id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['user_id'];
// Get the user corresponing to that ID as username, from the DB

$sql = "SELECT Users.username, Users.profile_image, Users.highscore, Users.description
        FROM Users
        WHERE Users.username = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
// Check if the query was successful 
if ($result && $result->num_rows > 0) {
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $result->close();
    $user = $data[0];
} else {
    $user = $_SESSION['user_info'];
}
// If the user doesn't exist, redirect to the home page
if (!$user) {
    header('Location: home.php');
    exit();
}


?>
<div class="profile">
    <div class="profile-header">
        <div class="profile-avatar">
            <div class="profile-picture-wrapper">
                <img id="profile-picture" src="views/assets/images/default_profile.png" alt="User Profile">
                <input id="profile-upload" class="inputfile" type="file" accept="image/*"
                    onchange="previewImage(event, 'profile-picture')">
                <label id="profile-upload-label" class="edit-label" for="profile-upload"
                    style="visibility: hidden;"></label>
            </div>

            <div class="profile-name text-game">
                <?php echo $user['username']; ?>
            </div>
        </div>
        <div class="banner-img-wrapper">
            <img id="profile-banner" src="views/assets/images/default_banner.png" alt="User Banner">
            <input id="banner-upload" class="inputfile" type="file" accept="image/*"
                onchange="previewImage(event, 'profile-banner')" />
            <label id="banner-upload-label" class="edit-label" for="banner-upload" style="visibility: hidden;"></label>
        </div>
        <div class="profile-menu">
            <!-- <a class="profile-menu-link">Achievements</a>
            <a class="profile-menu-link">Friends</a> -->
            <a class="profile-menu-link edit-profile" onclick="toggleEditMode()">Edit Profile</a>
            <a class="profile-menu-link save-profile" onclick="saveChanges()" style="display: none;">Save Changes</a>
        </div>
    </div>
    <div class="profile-feed">
        <div class="profile-feed-left">
            <div class="info-box">
                <h1 class="info-box-title">
                    About me
                </h1>
                <p id="profile-description" class="info-box-description" style="visibility: visible;">
                    <?php echo trim(
                        $user['description']
                    ); ?>
                </p>

                <textarea placeholder="Add a description!" id="profile-description-edit" class=""
                    style="color: black; width: 100%; resize: none; display: none;"><?php echo trim(
                        $user['description']
                    ) ?></textarea>
                <h1 class="info-box-title">
                    Highest Score
                </h1>
                <ul>
                    <li>
                        <p>
                            <?php echo
                                $user['highscore'];
                            ?>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <!-- <div class="profile-feed-right">
            <div class="info-box">
                coucou
            </div>
        </div> -->
    </div>
</div>
<script src="controllers/profileEdit.js"></script>