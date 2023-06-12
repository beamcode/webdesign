document.querySelector('.form').addEventListener('submit', function(e) {
    e.preventDefault();
    const usernameError = document.getElementById('username-error');
    const passwordError = document.getElementById('password-error');
    const confirmPasswordError = document.getElementById('confirm-password-error');

    fetch('../backend/signup.php', {
        method: 'POST',
        body: new FormData(this)
    })
    .then(response => response.json()) // TODO response.ok ???
    .then(data => {
        // Reset error messages
        usernameError.textContent = '';
        passwordError.textContent = '';
        confirmPasswordError.textContent = '';

        if (data.error) {
            switch (data.field) {
                case 'username':
                    usernameError.textContent = data.error;
                    break;
                case 'password':
                    passwordError.textContent = data.error;
                    break;
                case 'confirm_password':
                    confirmPasswordError.textContent = data.error;
                    break;
                default:
                    console.error(data.error);
                    break;
            }
        } else if (data.success) {
            // Redirect when registration is successful
            window.location.href = './login.html';
        }
    });
});