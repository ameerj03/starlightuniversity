<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login | Starlight University</title>
  <link rel="stylesheet" href="css/login-admin.css">
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
  <br>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-10">
        <h1 class="big-text text-center">
          Starlight University <br>
          Admin Login
        </h1>
        <br>
        <br>
        <form action="login-admin-php.php" class="login-form mx-auto" method="post">
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
          <a href="dashboard.php" style="text-decoration: none;">
            <button type="submit" class="buttons">Log in</button>
          </a>
          <div class="mx-auto text-center mt-3">
            <a href="login.php" class="small-text-admin">
              Student Login
            </a>
          </div>
        </form>
        <div class="down-div d-flex p-3 w-100 mx-auto">
          <a href="register.php" class="small-text-admin">Sign up</a>
          <a href="reset-password.html" class="small-text-admin ms-auto">Forgot Password?</a>
        </div>
      </div>
      <div class="col-lg-6 d-none d-lg-block">
        <div class="bgg"></div>
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
  <script>

    function checkForErrors() {
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('error')) {
        const toastLiveExample = document.getElementById('liveToast');
        const toast = new bootstrap.Toast(toastLiveExample);
        toast.show();
      }
    }


    window.onload = checkForErrors;
  </script>
  <script src="js/transition.js"></script>
  <script src="js/visibility.js"></script>
</body>

</html>