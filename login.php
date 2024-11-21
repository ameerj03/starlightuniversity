<?php
session_start();
include "action.php";


/*
if (isset($_SESSION['email'])) {
    header("Location: home.php");
}
    */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "frontend/layout/header.php";
    ?>
    <title>Login | Starlight University</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body style="background-color:#D4F1F4;">
    <nav>
        <div class="navbar-logo" style="display: flex;">
            <a href="index.php">
                <img src="img/logo-no-background.png" alt="logo" class="logo-img img-fluid">
            </a>
            <a href="index.php" class="uni-name">
                <h4 class="uni-name" id="name-before">Starlight University</h4>
            </a>
        </div>
    </nav>
    <br>
    <br>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <h1 class="big-text text-center">
                    Log in to submit and see the progress of your application!
                </h1>
                <br>
                <br>
                <form action="loginphp.php" class="login-form mx-auto" method="GET">
                    <div class="email-div mx-auto">
                        <label for="email" class="login-label">Email</label>
                        <div class="input-container" style="margin-left: 2px;">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" id="email" class="login-input" name="email">
                        </div>
                    </div>
                    <br>
                    <div class="password-div mx-auto">
                        <label for="password" class="login-label">Password</label>
                        <div class="input-container" style="margin-left: 2px;">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="password" class="login-input" name="password">
                            <i class="fa-solid fa-eye fa-fw" id="visibility"></i>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex "><button type="submit" class="buttons w-100 mx-2" name="id">Log in</button>
                        <button type="button" class="buttons google w-100 mx-2 d-flex bg-dark">
                            <div class=" me-auto bg-white rounded-circle border my-auto" style="width: min-content;"><img src="img/icons8-google.svg" style="width: 40px; height:40px;" alt=""></div><span class="my-auto mx-auto text-white" style="font-weight: 500;">Log in using Google</span>
                        </button>
                    </div>


                    <div class="mx-auto text-center mt-3">
                        <a href="login-admin.php" class="small-text-admin">
                            Admin Login
                        </a>
                    </div>
                </form>
                <div class="down-div d-flex p-3 w-100 mx-auto">
                    <a href="register.php" class="small-text-admin">Sign up</a>
                    <a href="reset-password.php" class="small-text-admin ms-auto">Forgot Password?</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="bgg"></div>
            </div>
        </div>
    </div>

    </div>


    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="img/logo-no-background.png" class="rounded me-2" alt="logo" style="width: 30px; height:30px;">
                <strong class="me-auto">Starlight University</strong>

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Invalid email or password, try again please.
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToastRegister" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="img/logo-no-background.png" class="rounded me-2" alt="logo" style="width: 30px; height:30px;">
                <strong class="me-auto">Starlight University</strong>

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Your account was created successfully! You can now log in.
            </div>
        </div>
    </div>
    <script>
        function checkForErrors() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('error')) {
                const toastLiveExample = document.getElementById('liveToast');
                const toast = new bootstrap.Toast(toastLiveExample);
                toast.show();
            }
        }

        function registerSucess() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('status')) {
                const toastLiveExample = document.getElementById('liveToastRegister');
                const toast = new bootstrap.Toast(toastLiveExample);
                toast.show();
            }
        }


        window.onload = checkForErrors;
        window.onload = registerSucess;
    </script>
    <script src="js/transition.js"></script>
    <script src="js/visibility.js"></script>
</body>

</html>