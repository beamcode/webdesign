<?php
include_once 'models/refreshUserData.php';
refreshUserData($_SESSION['user_id']);
?>
<div class="profile">
    <div class="profile-header">
        <div class="profile-avatar">
            <div class="profile-picture-wrapper">
                <img id="profile-picture" src="views/assets/images/default_profile.png" alt="User Profile">
                <input id="profile-upload" class="inputfile" type="file" accept="image/*" onchange="previewImage(event, 'profile-picture')">
                <label id="profile-upload-label" class="edit-label" for="profile-upload" style="visibility: hidden;"></label>
            </div>

            <div class="profile-name text-game">
                <?php echo $_SESSION['user_info']['username']; ?>
            </div>
        </div>
        <div class="banner-img-wrapper">
            <img id="profile-banner" src="views/assets/images/default_banner.png" alt="User Banner">
            <input id="banner-upload" class="inputfile" type="file" accept="image/*" onchange="previewImage(event, 'profile-banner')" />
            <label id="banner-upload-label" class="edit-label" for="banner-upload" style="visibility: hidden;"></label>
        </div>
        <div class="profile-menu">
            <a class="profile-menu-link">Achievements</a>
            <a class="profile-menu-link">Friends</a>
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
                    <?php echo trim($_SESSION['user_info']['description']); ?>
                </p>

                <textarea placeholder="Add a description!" id="profile-description-edit" class="" style="color: black; width: 100%; height: 60px; resize: none; display: none;"><?php echo trim($_SESSION['user_info']['description']) ?></textarea>
                <h1 class="info-box-title">
                    Score
                </h1>
                <ul>
                    <li>
                        <img src="" alt="" srcset="">
                        <p>Score: <?php echo $_SESSION['user_info']['highscore']; ?></p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="profile-feed-right">
            <div class="info-box">
                coucou
            </div>
        </div>
    </div>
</div>
<script src="controllers/profileEdit.js"></script>