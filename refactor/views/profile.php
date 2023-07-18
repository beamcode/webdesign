<!-- <div class="main">
<div class="main-container"> -->
<div class="profile">
    <div class="profile-header">
        <div class="profile-avatar">
            <div class="profile-picture-wrapper">
                <img
                    id="profile-picture"
                    src="views/assets/uploads/profile/default_profile.png"
                    alt="User Profile"
                >
                <input
                    id="profile-upload"
                    class="inputfile"
                    type="file"
                    accept="image/*"
                    onchange="previewImage(event, 'profile-picture')">
                <label
                    id="profile-upload-label"
                    class="edit-label"
                    for="profile-upload"
                    style="visibility: hidden;"
                ></label>
            </div>
            
            <div class="profile-name text-game">Username</div>
        </div>
        <div class="banner-img-wrapper">
            <img
            id="profile-banner"
            src="views/assets/uploads/banner/default_banner.png"
            alt="User Banner"
            >
            <input
            id="banner-upload"
            class="inputfile"
            type="file"
            accept="image/*"
            onchange="previewImage(event, 'profile-banner')"
            />
            <label
            id="banner-upload-label"
            class="edit-label"
            for="banner-upload"
            style="visibility: hidden;"
            ></label>
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
                    Introduction
                </h1>
                <p id="profile-description" class="info-box-description" contenteditable="false">
                    Michel 34 ans
                </p>
            </div>
            <div class="info-box">
                <h1 class="info-box-title">
                    Player information
                </h1>
                <p class="info-box-description">
                    Michel 34 ans
                </p>
                <ul>
                    <li>
                        <img src="" alt="" srcset="">
                        <p>score</p>
                    </li>
                </ul>
                
            </div>
        </div>
        <div class="profile-feed-right">
            <div class="info-box">
            coucou
            </div>
            <div class="info-box">
            coucou
            </div>
        </div>
    </div>
</div>
<!-- </div>
</div> -->
