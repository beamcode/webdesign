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
        });
}

function toggleEditMode() {
    document.getElementById('profile-upload').style.display = 'block';
    document.getElementById('banner-upload').style.display = 'block';
    document.querySelector('.edit button').style.display = 'none';
    document.querySelector('.edit button:nth-child(2)').style.display = 'block';
}

function saveChanges() {
    const profileUpload = document.getElementById('profile-upload');
    const bannerUpload = document.getElementById('banner-upload');

    const formData = new FormData();
    if (profileUpload.files.length > 0) {
        formData.append('profile_image', profileUpload.files[0]);
    }
    if (bannerUpload.files.length > 0) {
        formData.append('banner_image', bannerUpload.files[0]);
    }

    // Check if formData is not empty
    if (formData.has('profile_image') || formData.has('banner_image')) {
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
        console.log('No data to update');
    }
}

function toggleViewMode() {
    document.getElementById('profile-upload').style.display = 'none';
    document.getElementById('banner-upload').style.display = 'none';
    document.querySelector('.edit button').style.display = 'block';
    document.querySelector('.edit button:nth-child(2)').style.display = 'none';
}

function previewImage(event, elementId) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById(elementId);
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
