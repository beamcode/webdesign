document.querySelector('.form').addEventListener('submit', function (e) {
    e.preventDefault();
    const usernameError = document.getElementById('username-error');
    const passwordError = document.getElementById('password-error');
    fetch('../models/signin.php', {
        method: 'POST',
        body: new FormData(this)
    })
        .then(response => response.json())
        .then(data => {
            console.log('Response from signin.php:', data);
            // Reset error messages
            usernameError.textContent = '';
            passwordError.textContent = '';
            if (data.error) {
                switch (data.field) {
                    case 'username':
                        usernameError.textContent = data.error;
                        break;
                    case 'password':
                        passwordError.textContent = data.error;
                        break;
                    default:
                        console.error(data.error);
                        break;
                }
            } else if (data.success) {
                // Redirect when login is successful
                window.location.href = './home';
            }
        })
        .catch(error => {
            console.error('An error occurred:', error);
            // Handle the error, display an error message, or perform any other necessary actions.
        });
});
