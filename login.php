<?php
if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo '<script type="text/javascript">alert("Please login to access the page");</script>';
}
if (isset($_GET['error']) && $_GET['error'] == 2) {
    echo '<script type="text/javascript">alert("Invalid Credentials");</script>';
}
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    echo '<script type="text/javascript">alert("Logged out successfully");</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }

        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 360px;
            width: 100%;
        }

        .login-container h2 {
            color: #e41b17;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .input-container {
            position: relative;
            margin-bottom: 15px;
        }

        .input-container .form-control {
            padding-left: 40px;
        }

        .input-container .icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #777;
        }

        .input-container .password-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #777;
        }

        .login-btn {
            background-color: #333;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            width: 100%;
            padding: 10px;
            border: none;
        }

        .login-btn:hover {
            background-color: #555;
        }

        .forgot-password {
            margin-bottom: 20px;
            text-align: end;
        }

        .forgot-password a {
            text-decoration: none;
            font-size: 14px;
            color: #007bff;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container text-center">
        <h2>tailwebs.</h2>
        <form id="login_form" method="POST" action="<?php echo TAOH_SITE_URL_ROOT.'/student_list' ?>">
            <div class="input-container">
                <i class="bi bi-person icon"></i>
                <input type="text" id="username" class="form-control" name="username" value="" required placeholder="Username">
            </div>
            <div class="input-container">
                <i class="bi bi-lock icon"></i>
                <input type="password" id="password" class="form-control" name="password" value="" required placeholder="Password">
                <i class="bi bi-eye password-icon" onclick="togglePassword()"></i>
            </div>
            <div class="forgot-password">
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn login-btn">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript for Eye Icon Functionality -->
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var passwordIcon = document.querySelector(".password-icon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordIcon.classList.remove("bi-eye");
                passwordIcon.classList.add("bi-eye-slash");
            } else {
                passwordField.type = "password";
                passwordIcon.classList.remove("bi-eye-slash");
                passwordIcon.classList.add("bi-eye");
            }
        }
    </script>
</body>
</html>