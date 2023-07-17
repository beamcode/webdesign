<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="form-container">
        <form class="form" method="post">
            <img src="images/mushroom.png" alt="Website Logo" srcset="">
            <p class="title">Create your account</p>
            <p class="message">Signup now and get full access to our app. </p>
            <label>
                <input name="username" required placeholder="" type="text" class="input username">
                <span class="placeholder">Username</span>
            </label>
            <span id="username-error" class="error-message"></span>
            <label class="password-field">
                <input name="password" required placeholder="" type="password" class="input password">
                <span class="placeholder">Password</span>
                <i class="toggle-password fa fa-eye"></i>
            </label>
            <span id="password-error" class="error-message"></span>
            <label class="password-field">
                <input name="confirm_password" required placeholder="" type="password" class="input confirm-password">
                <span class="placeholder">Confirm password</span>
                <i class="toggle-password fa fa-eye"></i>
            </label>
            <span id="confirm-password-error" class="error-message"></span>
            <button class="submit">Create</button>
            <p class="signin">Already have an acount ? <a href="./login">Log in</a> </p>
        </form>
    </div>
    <script src="../controllers/togglePassword.js"></script>
    <script src="../controllers/signupFormValidator.js"></script>
    <script src="../controllers/signup.js"></script>
</body>

</html>