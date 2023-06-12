document.addEventListener("DOMContentLoaded", function () {
    console.log("GET!!!");
    // Récupérer les informations de l'utilisateur
    fetch("../backend/get_profile.php")
        .then(response => response.json())
        .then(data => {
            console.log(data);
            document.getElementById("username").innerText = data.username;
            document.getElementById("description").innerText = data.description;
            document.getElementById("profile_image").src = data.profile_image;
            document.getElementById("banner_image").src = data.banner_image;
        });

    // Gérer la soumission du formulaire de mise à jour
    // document.getElementById("update_form").addEventListener("submit", function (event) {
    //     event.preventDefault();
    //     console.log("UPDATE!!!");
    //     console.log(this);
    //     const formData = new FormData(this);
    //     console.log(formData);
    //     fetch("../backend/update_profile.php", {
    //         method: "POST",
    //         body: formData
    //     })
    //         .then(response => response.text())
    //         .then(text => {
    //             console.log(text);
    //             return JSON.parse(text);
    //         })
    //         .then(data => {
    //             if (data.success) {
    //                 alert("Profile updated successfully!");
    //                 location.reload();
    //             } else {
    //                 alert("There was an error updating the profile.");
    //             }
    //         });
    // });
});

function toggleEditMode(buttonElement) {
    const description = document.getElementById('description');
    const profileImageIcons = document.getElementById('edit_profile_image_icons');
    const bannerImageIcons = document.getElementById('edit_banner_image_icons');
    
    const currentEditMode = buttonElement.getAttribute('data-edit-mode') === 'true';

    if (!currentEditMode) {
        buttonElement.innerText = 'Save';
        description.setAttribute('contenteditable', 'true');
        profileImageIcons.style.display = 'inline';
        bannerImageIcons.style.display = 'inline';
        buttonElement.setAttribute('data-edit-mode', 'true');
    } else {
        buttonElement.innerText = 'Edit Mode';
        description.setAttribute('contenteditable', 'false');
        profileImageIcons.style.display = 'none';
        bannerImageIcons.style.display = 'none';
        buttonElement.setAttribute('data-edit-mode', 'false');
        saveChanges();
    }
}



function saveChanges() {
    const description = document.getElementById('description').innerText;
    
    const formData = new FormData();
    formData.append('description', description);

    const profileImageInput = document.getElementById('profile_image_input');
    const bannerImageInput = document.getElementById('banner_image_input');
    
    if (profileImageInput.files[0]) {
        formData.append('profile_image', profileImageInput.files[0]);
    }

    if (bannerImageInput.files[0]) {
        formData.append('banner_image', bannerImageInput.files[0]);
    }
    
    fetch("../backend/update_profile.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Profile updated successfully!");
            location.reload();
        } else {
            alert("There was an error updating the profile.");
        }
    });
}

function handleImageChange(event, imageElementId) {
    const file = event.target.files[0];
    
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById(imageElementId).src = e.target.result;
    }
    reader.readAsDataURL(file);
}

function deleteImage(inputElementId, imageElementId) {
    if (confirm("Are you sure you want to delete the image?")) {
        document.getElementById(imageElementId).src = '';
        document.getElementById(inputElementId).value = '';
    }
}
