var submitButton = document.querySelector('.form .submit');
submitButton.disabled = true;
// Get the elements
var usernameInput = document.querySelector('.username');
var passwordInput = document.querySelector('.password-field .password');
var confirmPasswordInput = document.querySelector('.password-field .confirm-password');
var errorMessages = document.querySelectorAll('.error-message');
// Create flags to check if user started typing
var userStartedTyping = {username: false, password: false, confirm: false};
// Event listeners for input fields
usernameInput.addEventListener('input', function() {
    userStartedTyping.username = true;
    checkInputs();
});
passwordInput.addEventListener('input', function() {
    userStartedTyping.password = true;
    checkInputs();
});
// Only exists on the signup page
if (confirmPasswordInput) {
    confirmPasswordInput.addEventListener('input', function() {
        userStartedTyping.confirm = true;
        checkInputs();
    });
}
function checkInputs() {
    var username = usernameInput.value;
    var password = passwordInput.value;
    var confirmPassword = confirmPasswordInput ? confirmPasswordInput.value : password;
    if (!confirmPasswordInput) {
        userStartedTyping.confirm = true;
    }
    
    // Check the username
    if (userStartedTyping.username && (username.length < 3 || username.length > 30)) {
        errorMessages[0].textContent = "Username must be between 3 and 30 characters";
    } else {
        errorMessages[0].textContent = "";
    }
    // Check the password
    if (userStartedTyping.password) {
        checkPassword(password, errorMessages[1]);
    }
    // Check if the two passwords match
    if (userStartedTyping.confirm && password !== confirmPassword) {
        errorMessages[2].textContent = "Passwords do not match";
    } else if (userStartedTyping.confirm) {
        errorMessages[2].textContent = "";
    }
    // Enable the submit button if all conditions are met
    if (userStartedTyping.username
        && userStartedTyping.password
        && userStartedTyping.confirm
        && errorMessages[0].textContent == ''
        && errorMessages[1].textContent == ''
        && errorMessages[2].textContent == '') {
        submitButton.disabled = false;
    } else {
        submitButton.disabled = true;
    }
}
function checkPassword(password, errorMessageElement) {
    let passwordValue = password;
    let hasEnoughLength = /.{8,}/.test(passwordValue);
    let hasLowerCase = /[a-z]/.test(passwordValue);
    let hasUpperCase = /[A-Z]/.test(passwordValue);
    let hasNumber = /\d/.test(passwordValue);
    let hasSpecialChar = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(passwordValue);
    let errors = [];
    if (!hasEnoughLength) {
        errors.push("be at least 8 characters long.");
    }
    if (!hasLowerCase) {
        errors.push("contain at least one lowercase letter.");
    }
    if (!hasUpperCase) {
        errors.push("contain at least one uppercase letter.");
    }
    if (!hasNumber) {
        errors.push("contain at least one number.");
    }
    if (!hasSpecialChar) {
        errors.push("contain at least one of the following special characters: @$!%*#?&");
    }
    if (errors.length > 0) {
        let formattedErrors = errors.map(error => `<li>${error}</li>`).join('');
        errorMessageElement.innerHTML = `Password must: <ul>${formattedErrors}</ul>`;
    } else {
        errorMessageElement.innerHTML = '';
    }
}