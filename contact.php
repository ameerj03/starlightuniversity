<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['id'];
$user_name = $_SESSION['name'];
$user_lastname = $_SESSION['lastname'];
$user_role = $_SESSION['role'];

include "action.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "frontend/layout/header.php";
    ?>
    <title>Contact | Starlight University</title>
    <link rel="stylesheet" href="css/contact.css">
</head>

<body style="background-color:#D4F1F4 ;">
    <?php
    include "frontend/layout/navbar.php" ?>
    <div class="container-fluid map-div">
        <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d46488.67249902538!2d28.827826367264144!3d40.99435506666838!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2str!4v1721670700323!5m2!1sen!2str" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="container-fluid my-3 bg-light">
        <div class="row">
            <div class="col-sm-6 px-5 py-5">
                <h4>Contact Info</h4>
                <hr>
                <form action="send-message.php" method="post" id="message-form">
                    <div class="row my-4">
                        <div class="form-group col-12 col-md-6 mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" aria-label="name" class="form-control" required>
                        </div>
                        <div class="form-group col-12 col-md-6 mb-3">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" id="lastname" aria-label="lastname" class="form-control" required>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="form-group col-12 col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" aria-label="email" class="form-control" required placeholder="name@mail.com">
                        </div>
                        <div class="form-group col-12 col-md-6 mb-3">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" maxlength="15" aria-label="phone" class="form-control" placeholder="0 501 234 56 78" required pattern="[0]{1} [0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}" oninput="formatPhone(this)">
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="form-group col-12 col-md-6 mb-3">
                            <label for="program">Subject</label>
                            <input type="text" name="subject" id="subject" aria-label="subject" class="form-control" required>
                        </div>
                        <div class="form-group col-12 col-md-6 mb-3">
                            <label for="receiver">Reciever</label>
                            <select name="receiver" id="receiver" aria-label="receiver" class="form-select" required>
                                <option selected disabled>Select...</option>
                                <?php
                                include "action.php";

                                $view = "SELECT id, name, lastname, degree FROM user WHERE role = 'admin' ";
                                $view_query = $conn->query($view);

                                if ($view_query->num_rows > 0) {
                                    while ($row = $view_query->fetch_assoc()) {
                                        echo '<option value="' . $row['id'] . '">' . $row['name'] . " " . $row['lastname'] . " - " . $row['degree'] . '</option>';
                                    }
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="form-group col-12 mb-3">
                            <label for="text">Your Message</label>
                            <textarea type="text" name="text" id="text" aria-label="text" class="form-control" style="height: 120px;" placeholder="Write your message here" required></textarea>
                        </div>
                    </div>

                    <div class="checkbox-wrapper-13">
                        <input id="c1-13" type="checkbox" required>
                        <label for="c1-13">I agree to the <a href="terms.html" target="_blank" style="color:#05445E ;">terms and conditions</a></label>
                    </div>
                    <div class="submit-button d-flex">
                        <button type="submit" class="btn edit-btn mt-3 mx-0 text-light" id="submit-button">Submit</button>
                    </div>
                    <input type="hidden" name="sender_id" value="<?php echo $user_id; ?>">
                </form>
            </div>

            <div class="col-sm-6 py-5 pe-5">
                <div class="row" style="text-align: center;">
                    <h4>Follow Us</h4>
                    <div class="d-flex">
                        <div class="mx-auto">
                            <a href="https://www.facebook.com/"><i class="facebook social fa-brands fa-facebook"></i></a>
                            <a href="https://www.instagram.com/"><i class="instagram social fa-brands fa-instagram"></i></a>
                            <a href="https://www.x.com/"><i class=" x social fa-brands fa-x-twitter"></i></a>
                            <a href="https://www.linkedin.com/"><i class="linkedin social fa-brands fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container overflow-hidden text-center">
                    <div class="row gy-5">
                        <div class="col-12 border rounded bg-body p-3">
                            <div class=" contact-items"><i class="fa-solid fa-location-dot"></i>
                                <h6 class="text-start ms-2">Fevzi Çakmak Mh. Osmancık Sokağı No:14 34788 Bahçelievler / İstanbul / Türkiye</h6>
                            </div>
                        </div>
                        <div class="col-6 border rounded bg-body p-3 contact me-auto">
                            <div class="contact-items"><i class="fa-solid fa-phone"></i>
                                <h6 class="ms-2">+90 531 229 43 89</h6>
                            </div>
                        </div>
                        <div class="col-6 border rounded bg-body p-3 contact ms-auto">
                            <div class=" contact-items"><i class="fa-solid fa-envelope"></i>
                                <h6 class="ms-2">info@starlight.com</h6>
                            </div>
                        </div>
                        <div class="col-6 border rounded bg-body p-3 contact me-auto">
                            <div class=" contact-items position-relative"><i class="fa-solid fa-map"></i>
                                <h6 class="ms-2">Map</h6>
                                <a href="https://maps.app.goo.gl/9qz1iHW2JYqdV7r79" class="stretched-link"></a>
                            </div>
                        </div>
                        <div class="col-6 border rounded bg-body p-3 contact ms-auto">
                            <div class=" contact-items"><i class="fa-solid fa-clock"></i>
                                <h6 class="ms-2">8:30 - 18:30</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast1" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="img/logo-no-background.png" class="rounded me-2" alt="logo" style="width: 30px; height:30px;">
                <strong class="me-auto">Starlight University</strong>

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Message sent successfully, Admins will reply soon to your message.
            </div>
        </div>
    </div>
    <?php
    include 'frontend/api/firebase.php';
    ?>
    <script>
        function messageSuccess() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('status') === 'message_sent') {
                const toastLiveExample1 = document.getElementById('liveToast1');
                const toast = new bootstrap.Toast(toastLiveExample1);
                toast.show();
            }
        }
        window.onload = messageSuccess;

        function formatPhone(input) {
            let cleaned = input.value.replace(/\D/g, '').slice(0, 11);

            let formatted = '';
            if (cleaned.length > 0) formatted += cleaned.slice(0, 1);
            if (cleaned.length > 1) formatted += ' ' + cleaned.slice(1, 4);
            if (cleaned.length > 4) formatted += ' ' + cleaned.slice(4, 7);
            if (cleaned.length > 7) formatted += ' ' + cleaned.slice(7, 9);
            if (cleaned.length > 9) formatted += ' ' + cleaned.slice(9, 11);

            input.value = formatted;
        }
    </script>
</body>
<footer>
    <?php
    include "frontend/layout/footer.php";
    ?>
</footer>

</html>