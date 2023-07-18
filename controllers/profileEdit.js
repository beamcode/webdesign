function fetchUserProfile() {
    fetch('../models/profileEdit.php')
        .then(response => response.json())
        .then(user => {
            document.getElementById('profile-picture').src = user.profile_image;
            document.getElementById('profile-banner').src = user.banner_image;
            document.querySelector('.profile-name').textContent = user.username;
            updateBannerImage(user.banner_image);
            const profileDescription = document.getElementById('profile-description');
            profileDescription.textContent = user.description;
        });
}

function toggleViewMode() {
    document.getElementById('profile-upload-label').style.visibility = 'hidden';
    document.getElementById('banner-upload-label').style.visibility = 'hidden';
    document.getElementById('profile-description').style.display = 'block';
    document.getElementById('profile-description-edit').style.display = 'none';
    document.querySelector('.edit-profile').style.display = 'block';
    document.querySelector('.save-profile').style.display = 'none';
}

function toggleEditMode() {
    document.getElementById('profile-upload-label').style.visibility = 'visible';
    document.getElementById('banner-upload-label').style.visibility = 'visible';
    document.getElementById('profile-description').style.display = 'none';
    document.getElementById('profile-description-edit').style.display = 'block';
    document.querySelector('.edit-profile').style.display = 'none';
    document.querySelector('.save-profile').style.display = 'block';
}

function saveChanges() {
    const profileUpload = document.getElementById('profile-upload');
    const bannerUpload = document.getElementById('banner-upload');
    const profileDescription = document.getElementById('profile-description');
    const profileDescriptionEdit = document.getElementById('profile-description-edit');
    const formData = new FormData();

    if (profileUpload.files.length > 0) {
        formData.append('profile_image', profileUpload.files[0]);
    }
    if (bannerUpload.files.length > 0) {
        formData.append('banner_image', bannerUpload.files[0]);
        updateBannerImage(bannerUpload.files[0]);
    }
    // Check if the description has been modified
    if (profileDescriptionEdit.value !== profileDescription.textContent) {
        formData.append('description', profileDescriptionEdit.value);
    }
    // Check if formData is not empty
    if (formData.has('profile_image') || formData.has('banner_image') || formData.has('description')) {
        fetch('../models/profileEdit.php', {
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
                    console.log(data)
                }
            });
    } else {
        toggleViewMode();
        console.log('No data to update');
    }
}

function previewImage(event, elementId) {
    const reader = new FileReader();
    reader.onload = function () {
        const output = document.getElementById(elementId);
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

function updateBannerImage(imageUrl) {
    const profile = document.querySelector('.profile');
    profile.style.setProperty('--banner-image', `url("${imageUrl}")`);
}

document.addEventListener('DOMContentLoaded', function () { fetchUserProfile() });