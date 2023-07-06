// This script toggles the visibility of password fields in a form.
// It works by changing the input type between "text" and "password".
// To use this script, add the class "password-field" to the label of your password input field, 
// and "toggle-password" to the icon or button you want to use to toggle visibility.
// Select all password fields
const passwordFields = document.querySelectorAll('.password-field');
passwordFields.forEach((field) => {
    const passwordInput = field.querySelector('.input');
    const toggleButton = field.querySelector('.toggle-password');
    toggleButton.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
});
