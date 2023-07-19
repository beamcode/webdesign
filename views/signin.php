<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn</title>
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="form-container">
        <form class="form" method="POST">
            <img src="views/assets/images/mushroom.png" alt="Website Logo" srcset="">
            <p class="title">Welcome back</p>
            <p class="message">We're so happy to see you again!</p>
            <label>
                <input name="username" placeholder="" type="text" class="input username" required>
                <span class="placeholder">Username</span>
            </label>
            <span id="username-error" class="error-message"></span>
            <label class="password-field">
                <input name="password" placeholder="" type="password" class="input password" required>
                <span class="placeholder">Password</span>
                <i class="toggle-password fa fa-eye"></i>
            </label>
            <span id="password-error" class="error-message"></span>
            <p><a href="https://www.youtube.com/watch?v=eCKzNkW5GMI">Forgot password?</a></p>
            <button class="submit">Connection</button>
            <p class="form-link">Don't have an account ? <a href="./signup.php">Sign Up</a></p>
        </form>
    </div>
    <script src="controllers/togglePassword.js"></script>
    <script src="controllers/signin.js"></script>
</body>

</html>