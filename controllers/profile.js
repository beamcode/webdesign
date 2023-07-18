document.addEventListener('DOMContentLoaded', function() {
    fetchUserProfile();
});
function fetchUserProfile() {
    fetch('../backend/profile.php')
        .then(response => response.json())
        .then(user => {
            document.getElementById('profile-picture').src = user.profile_image;
            document.getElementById('profile-banner').src = user.banner_image;
            document.querySelector('.profile-name').textContent = user.username;
            updateBannerImage(user.banner_image);
            const profileDescription = document.querySelector('.profile-description');
            profileDescription.textContent = user.description;
            // Store the initial value of the description
            profileDescription.dataset.initialValue = user.description;
        });
}
function toggleEditMode() {
    document.getElementById('profile-upload-label').style.visibility = 'visible';
    document.getElementById('banner-upload-label').style.visibility = 'visible';
    document.querySelector('.profile-description').contentEditable = 'true';
    document.querySelector('.edit-profile').style.display = 'none';
    document.querySelector('.save-profile').style.display = 'block';
}
function saveChanges() {
    const profileUpload = document.getElementById('profile-upload');
    const bannerUpload = document.getElementById('banner-upload');
    const profileDescription = document.querySelector('.profile-description');
    const formData = new FormData();
    if (profileUpload.files.length > 0) {
        formData.append('profile_image', profileUpload.files[0]);
    }
    if (bannerUpload.files.length > 0) {
        formData.append('banner_image', bannerUpload.files[0]);
        updateBannerImage(bannerUpload.files[0]);
    }
    // Check if the description has been modified
    if (profileDescription.textContent !== profileDescription.dataset.initialValue) {
        formData.append('description', profileDescription.textContent);
    }
    // Check if formData is not empty
    if (formData.has('profile_image') || formData.has('banner_image') || formData.has('description')) {
        fetch('../backend/profile.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchUserProfile();
                toggleViewMode();
            } else {
                console.error('Failed to update profile');
            }
        });
    } else {
        toggleViewMode();
        console.log('No data to update');
    }
}
function toggleViewMode() {
    document.getElementById('profile-upload-label').style.visibility = 'hidden';
    document.getElementById('banner-upload-label').style.visibility = 'hidden';
    document.querySelector('.profile-description').contentEditable = 'false';
    document.querySelector('.edit-profile').style.display = 'block';
    document.querySelector('.save-profile').style.display = 'none';
}
function previewImage(event, elementId) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById(elementId);
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
function updateBannerImage(imageUrl) {
    const profile = document.querySelector('.profile');
    profile.style.setProperty('--banner-image', `url("${imageUrl}")`);
}