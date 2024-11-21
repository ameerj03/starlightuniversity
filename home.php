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

include "action.php";
$view_check = "SELECT * FROM user WHERE id='$user_id' ";
$user_view_check = $conn->query($view_check);

if ($user_view_check->num_rows < 1) {
    header("Location: login.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page | Starlight University</title>
    <link rel="stylesheet" href="css/index.css">
    <?php
    include "frontend/layout/header.php" ?>
</head>

<body style="background-color:#F5F5F5;">

    <div id="pageContent">
    <div class="assistant">
        <button style="position: fixed; bottom: 20px; right: 20px;" class=" assistant-button rounded-circle"></button>

        </div>
        <!-- Navbar -->
        <?php
        include "frontend/layout/navbar.php" ?>

        <!-- <div class="marquee-div px-3" style="background-color: rgb(165, 12, 12); color:white"> 
            <marquee behavior="scroll"><?php
                                        $view2 = "SELECT text FROM announcement";
                                        $view_query2 = $conn->query($view2);
                                        if ($view_query2->num_rows > 0) {
                                            echo 'Latest News:  ';
                                            while ($roww = $view_query2->fetch_assoc()) {

                                                echo $roww['text'];

                                                echo '<img src="img/logo-no-background.png" alt="logo" style="width: 40px" class="px-1">';
                                            }
                                        }

                                        ?></marquee>
        </div>-->

        <div class="banner-photo-div">
            <h1 class="banner-text" style="padding-top: 10%;">STARLIGHT UNIVERSITY'S ONLINE APPLICATION PORTAL</h1>
            <h6 class="banner-text">Send your online application easily</h6>
            <a href="application.php" style="text-decoration: none;">
                <button type="button" class="apply-button">APPLY NOW <i class="fa-solid fa-arrow-right"></i></button>
            </a>
        </div>

        <br>
        <br>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h3 style="text-align: center;">About Us</h3>
                    <br>
                    <p>Starlight University aims to create a scientifically rigorous and intellectually rich environment for its students, through:
                    <ul>
                        <li style="list-style: circle;">Courses and research supervision by nationally and internationally recognized faculty members.</li>
                        <li style="list-style: circle;">Exposure to distinguished national and international scholars and speakers.</li>
                        <li style="list-style: circle;">Research opportunities in over 200 interdisciplinary research centers, forums, and laboratories.</li>
                        <li style="list-style: circle;">Exposure to research practices and academic knowledge from Top-100 ranked partner universities in the U.S., Europe, and Asia through semester exchange programs.</li>
                        <li style="list-style: circle;">A low student-faculty ratio for a “boutique learning” experience.</li>
                    </ul>
                    Learn more about academic and student life at Starlight University by following us on <span><a href="https://www.tiktok.com/" class="social-links">TikTok</a></span>, <span><a href="https://www.instagram.com/" class="social-links">Instagram</a></span>, <span><a href="https://www.facebook.com/" class="social-links">Facebook</a></span>, <span><a href="https://www.x.com/" class="social-links">X</a></span> and <span><a href="https://www.youtube.com/" class="social-links">Youtube</a></span>.

                    From recent updates about our campus, academic, and research programs to articles from faculty members and global achievements, stay connected to the Starlight University community.
                    </p>
                    <hr>

                </div>
                <div class="col-sm-12 col-md-6">
                    <h3 style="text-align: center;">Gallery</h3>
                    <br>
                    <div id="car" class="carousel slide rounded shadow-sm" data-bs-ride="carousel">
                        <div class="carousel-inner rounded shadow-sm">
                            <div class="carousel-item ">
                                <img src="img/uni-1.jpg" class="d-block w-100 rounded" alt="img" style=" height:370px; object-fit:cover;">
                            </div>
                            <div class="carousel-item">
                                <img src="img/uni-2.jpg" class="d-block w-100 rounded" alt="img" style=" height:370px; object-fit:cover;">
                            </div>
                            <div class="carousel-item">
                                <img src="img/uni-3.jpeg" class="d-block w-100 rounded" alt="img" style=" height:370px; object-fit:cover;">
                            </div>
                            <div class="carousel-item">
                                <img src="img/uni-4.jpg" class="d-block w-100 rounded" alt="img" style=" height:370px; object-fit:cover;">
                            </div>
                            <div class="carousel-item">
                                <img src="img/uni-5.jpg" class="d-block w-100 rounded" alt="img" style=" height:370px; object-fit:cover;">
                            </div>
                            <div class="carousel-item ">
                                <img src="img/uni-6.webp" class="d-block w-100 rounded" alt="img" style=" height:370px; object-fit:cover;">
                            </div>
                            <div class="carousel-item active">
                                <img src="img/uni-7.jpg" class="d-block w-100 rounded" alt="img" style=" height:370px; object-fit:cover;">
                            </div>
                            <div class="carousel-item ">
                                <img src="img/uni-8.jpg" class="d-block w-100 rounded" alt="img" style=" height:370px; object-fit:cover;">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#car" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#car" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>



                </div>
                <div class="smart my-3 p-4 border-bottom border-secondary-subtle mx-2">
                    <div class="container">
                        <div class="row align-items-center">

                            <div class="col-md-6 text-center mb-3 mb-md-0">
                                <img src="img/art.webp" class="img-fluid rounded-circle shadow-sm" alt="Smart Advisor" style="width: 400px; height: 400px;">
                            </div>

                            <div class="col-md-6">
                                <div class="p-3">
                                    <h1 class="display-5 font-weight-bold" style="color: #05445E;">Can't Decide What To Study?</h1>
                                    <h4 class="font-weight-semibold text-muted">Explore our Smart Advisor</h4>
                                    <div class="mt-4">
                                        <div class="d-flex align-items-baseline mb-2">
                                            <i class="fa-solid fa-circle-check text-success"></i>
                                            <p class="mx-2 mb-0">Easy To Use</p>
                                        </div>
                                        <div class="d-flex align-items-baseline mb-2">
                                            <i class="fa-solid fa-circle-check text-success"></i>
                                            <p class="mx-2 mb-0">100% Free</p>
                                        </div>
                                        <div class="d-flex align-items-baseline mb-2">
                                            <i class="fa-solid fa-circle-check text-success"></i>
                                            <p class="mx-2 mb-0">Powered By AI</p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="" class="btn smart-btn btn-lg shadow-sm">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div>
                        <h3 style="text-align: center;">Our Programs</h3>
                        <br>
                        <div class="programs-list">

                            <?php

                            include "action.php";

                            $view = "SELECT id, name, years, degree, quota, remaining_quota, language, description FROM program WHERE id <= 14";
                            $view_query = $conn->query($view);
                            if ($view_query->num_rows > 0) {
                                while ($row = $view_query->fetch_assoc()) {
                                    if ($row['remaining_quota'] > 0) {
                                        echo '<div class="card shadow-sm mb-3 programs " style="max-width: 540px;">';
                                        echo '<div class="row g-0">';
                                        echo '<div class="col-md-12">';
                                        echo '<div class="card-body">';
                                        echo '<div class="d-flex justify-content-between align-items-center">';
                                        echo '<h5 class="card-title mb-0">' . $row['name'] . ' (' . $row['language'] . ')' . '</h5>';
                                        echo '<p class="d-none description">' . $row['description'] . '</p>';
                                        echo '<span class="badge rounded-pill bg-success">Available<span class="visually-hidden">Available</span></span>';
                                        echo '</div>';
                                        echo '<a href="program-view.php?num=' . $row['id'] . '" class= " stretched-link"></a>';
                                        echo '<p class="card-text">' . $row['years'] . ' Years</p>';
                                        echo '<p class="card-text"><small class="text-body-secondary">' . $row['degree'] . '</small></p>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    } else {
                                        echo '<div class="card shadow-sm mb-3 programs" style="max-width: 540px;">';
                                        echo '<div class="row g-0">';
                                        echo '<div class="col-md-12">';
                                        echo '<div class="card-body">';
                                        echo '<div class="d-flex justify-content-between align-items-center">';
                                        echo '<h5 class="card-title mb-0">' . $row['name'] . ' (' . $row['language'] . ')' . '</h5>';
                                        echo '<p class="d-none description">' . $row['description'] . '</p>';
                                        echo '<span class="badge rounded-pill bg-danger">Unavailable<span class="visually-hidden">Available</span></span>';
                                        echo '</div>';
                                        echo '<a href="program-view.php?num=' . $row['id'] . '" class= " stretched-link"></a>';
                                        echo '<p class="card-text">' . $row['years'] . ' Years</p>';
                                        echo '<p class="card-text"><small class="text-body-secondary">' . $row['degree'] . '</small></p>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }
                            }
                            ?>
                            <a href="programs.php" style="text-decoration: none;">
                                <button type="button" class="apply-button my-2">View All </button>
                            </a>
                        </div>
                        <div class="d-xl-none d-lg-none d-md-none d-xl-block">
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h3 style="text-align: center;">Announcements</h3>
                    <br>

                    <div class="Announcements-div">
                        <?php
                        include "action.php";
                        $view = "SELECT id, title, text, image, date FROM announcement WHERE id<=11";
                        $view_query = $conn->query($view);
                        if ($view_query->num_rows > 0) {
                            while ($row = $view_query->fetch_assoc()) {
                                echo '<div class="card shadow-sm mb-3" style="width: 400px; display: block; margin: auto;">';
                                $imagePath = $row['image'];
                                if (file_exists($imagePath)) {
                                    echo '<img src="' . $imagePath . '" class="card-img-top" alt="Announcement Image">';
                                } else {
                                    echo '<img src="img/logo-text.png" class="card-img-top img-fluid" alt="Default Image">';
                                }
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title">' . $row['title'] . '</h5>';
                                echo '<p class="card-text truncate">'
                                    . $row['text'] .
                                    '</p>';
                                echo '<a href="announcements-details.php?id=' . $row['id'] . '" style="text-decoration: none;"><button type="button" class="apply-button">See more...</button></a>';
                                echo '<hr>';
                                echo  '<p class="card-text"><small class="text-body-secondary">Last updated: ' . $row['date'] . '</small></p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                    <a href="announcements.php" style="text-decoration: none;">
                        <button type="button " class="apply-button my-2">View All</button>
                    </a>
                </div>
            </div>




        </div>



    
    <?php
    include 'frontend/api/firebase.php';
    ?>
    <br>
    
       
        <script>
            function closeChatbot() {
                document.querySelector(".chatbot").style.display = "none";
            }
            function sendMessage() {
                var message = document.querySelector("#chatbot-input").value;
                document.querySelector("#chatbot-input").value = "";
                document.querySelector("#chatbot-response").innerHTML = getResponse(message);
            }
            function getResponse(message) {
                var responses = {
                    "hi": "Hi, how can I help you?",
                    "hello": "Hello, how can I help you?",
                    "help": "I'm happy to help you with any questions or concerns you may have about Starlight University.",
                    "admission": "Our admission process is currently open. Please visit the apply now page to submit your application.",
                    "apply": "You can apply now by visiting the apply now page.",
                    "application": "You can check your application status by visiting the application center.",
                    "status": "You can check your application status by visiting the application center.",
                    "programs": "We offer a variety of programs. Please visit the programs page to learn more.",
                    "contact": "You can contact us by visiting the contact us page.",
                    "": "I'm happy to help you with any questions or concerns you may have about Starlight University."
                };
                return responses[message.toLowerCase()] || "I'm sorry, I don't understand that.";
            }
        </script>
    
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast1" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="img/logo-no-background.png" class="rounded me-2" alt="logo" style="width: 30px; height:30px;">
                <strong class="me-auto">Starlight University</strong>

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Application submitted successfully, check the application status from applications center.
            </div>
        </div>
    </div>
    <div class="modal fade" id="programModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 style="font-weight: 600;">Software Engineering</h3>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.onreadystatechange = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('login')) {
            document.getElementById('pageContent').style.display = 'none';
            document.getElementById('loadingOverlay').style.display = 'flex';
            if (document.readyState === "complete") {
                setTimeout(function() {
                    document.getElementById('loadingOverlay').style.display = 'none';
                    document.getElementById('pageContent').style.display = 'block';
                    document.getElementById('pageContent').classList.add('loaded');
                    urlParams.delete('login');
                    const newUrl = window.location.pathname + '?' + urlParams.toString();
                    window.history.replaceState({}, '', newUrl);
                }, 2000);
            }
        } else {
            document.getElementById('loadingOverlay').style.display = 'none';
        }
    };

    function applicationSuccess() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('status') === 'application_submitted') {
            const toastLiveExample1 = document.getElementById('liveToast1');
            const toast = new bootstrap.Toast(toastLiveExample1);
            toast.show();
        }
    }

    window.onload = applicationSuccess;
</script>
<footer>
    <?php
    include "frontend/layout/footer.php";
    ?>
</footer>
</div>
<div id="loadingOverlay" style="display: none;">
    <div class="spinner-border" role="status" id="customSpinner">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

</html>