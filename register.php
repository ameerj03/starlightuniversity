<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "frontend/layout/header.php";
    ?>
    <title>Register | Starlight University</title>
    <link rel="stylesheet" href="css/register.css">
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
                    Create your account now to start application process:
                </h1>
                <br>
                <br>
                <form action="registerphp.php" class="login-form mx-auto" method="post">

                    <div class="email-div mx-auto">
                        <label for="firstname" class="login-label">First Name</label>
                        <div class="input-container" style="margin-left: 2px;">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" id="firstname" class="login-input" name="name" required>
                        </div>
                    </div>
                    <br>
                    <div class="email-div mx-auto">
                        <label for="lastname" class="login-label">Last Name</label>
                        <div class="input-container" style="margin-left: 2px;">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" id="lastname" class="login-input" name="lastname" required>
                        </div>
                    </div>
                    <br>
                    <div class="email-div mx-auto">
                        <label for="gender" class="login-label">Gender</label>
                        <div class="input-container" style="margin-left: 2px;">
                            <i class="fa-solid fa-person-half-dress fa-xl"></i>
                            <select id="gender" class="select-input" name="gender" required>
                                <option value="" selected disabled class="select-placeholder"></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>

                    <br>
                    <div class="email-div mx-auto">
                        <label for="email" class="login-label">Email</label>
                        <div class="input-container" style="margin-left: 2px;">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" id="email" class="login-input" name="email" required>
                        </div>
                    </div>
                    <br>
                    <div class="email-div mx-auto">
                        <label for="phone" class="login-label">Phone</label>
                        <div class="input-container" style="margin-left: 2px;">
                            <i class="fa-solid fa-phone"></i>
                            <input type="tel" id="phone" class="login-input" name="phone" required>
                        </div>
                    </div>
                    <br>
                    <div class="email-div mx-auto">
                        <label for="gender" class="login-label">Degree</label>
                        <div class="input-container" style="margin-left: 2px;">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <select id="degree" class="select-input" name="degree" required>
                                <option selected disabled class="select-placeholder"></option>
                                <option value="undergraduate">Undergraduate</option>
                                <option value="graduate">Graduate</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="password-div mx-auto">
                        <label for="password" class="login-label">Password</label>
                        <div class="input-container" style="margin-left: 2px;">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="password" class="login-input" name="password" required>
                            <i class="fa-solid fa-eye fa-fw" id="visibility"></i>
                        </div>
                    </div>
                    <div class="row mt-5 ms-0">
                        <div class="checkbox-wrapper-13">
                            <input id="c1-13" type="checkbox" required>
                            <label for="c1-13">I agree to the <a href="#">terms and conditions</a></label>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="buttons">Sign Up</button>
                    <div class="mx-auto text-center mt-3">
                        <h6>Already have an account?</h6>
                        <a href="login.php" class="small-text-admin">
                            Login
                        </a>
                    </div>
                </form>

            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="bgg"></div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <img src="img/logo-no-background.png" class="rounded me-2" alt="logo" style="width: 30px; height:30px;">
            <strong class="me-auto">Starlight University</strong>
            
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Registration failed. Please try again later. 
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