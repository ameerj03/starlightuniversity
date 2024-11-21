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
    <title>Starlight University Online Registration Portal</title>
    <link rel="stylesheet" href="css/home.css">
  <?php
  include "frontend/layout/header.php";
  ?>
</head>

<body style="background-color:#D4F1F4;">
    <nav>
        <div class="navbar-logo d-flex">
            <a href="index.php">
                <img src="img/logo-no-background.png" alt="logo" class="logo-img img-fluid">
            </a>
            <a href="index.php" class="uni-name">
                <h4 class="uni-name" id="name-before">Starlight University</h4>
            </a>
        </div>
    </nav>
    <br>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <br>
                <br>
                <div class="left-div">
                    <h1 class="text-center">WELCOME TO <br> STARLIGHT UNIVERSITY'S <br> ONLINE APPLICATION PORTAL</h1>
                    <br>
                    <h4 class="small-text text-center">GET STARTED BY LOGGING IN:</h4>
                    <br>
                    <div class="text-center">
                        <a href="login.php" style="text-decoration: none;">
                            <button type="button" class="buttons">Log in</button>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="login-admin.php" class="small-text-admin">
                            <h5 class="small-text-admin">Admin Log in</h5>
                        </a>
                    </div>
                    <div class="hrdivider text-center">
                        <hr />
                        <span>OR</span>
                    </div>
                    <div class="text-center">
                        <a href="register.php" style="text-decoration: none;">
                            <button type="button" class="buttons">Sign Up</button>
                        </a>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="bgg"></div>
            </div>
        </div>
    </div>
    <br>
    <script src="js/transition.js"></script>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-analytics.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries
      
        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
          apiKey: "AIzaSyBfcoEjzyXn4NvidI4mBsnHKmZnDVwrTUs",
          authDomain: "starlight-university-7970a.firebaseapp.com",
          projectId: "starlight-university-7970a",
          storageBucket: "starlight-university-7970a.appspot.com",
          messagingSenderId: "551827313303",
          appId: "1:551827313303:web:5cffcc9ec0643e963f4fd2",
          measurementId: "G-QWXQGSWMKQ"
        };
      
        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);
      </script>
      <script>
            
      </script>
</body>

</html>
