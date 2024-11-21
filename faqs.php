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
$view = "SELECT * FROM user WHERE id='$user_id' ";
$user_view = $conn->query($view);

if ($user_view->num_rows < 1) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "frontend/layout/header.php";
    ?>
    <title>FAQs | Starlight University</title>
    <link rel="stylesheet" href="css/faqs.css">
</head>

<body style="background-color: #D4F1F4;">

    <?php include "frontend/layout/navbar.php" ?>

    <div class="banner-photo-div">
        <h1 class="banner-text" style="padding-top: 10%;">STARLIGHT UNIVERSITY'S APPLICATION FAQs</h1>
    </div>

    <br>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <p>We are aware that the university admission process may become challenging at times and that you may
                    have some questions about our admission process. You can find the answers to the most frequently
                    asked questions by clicking on the topic of your interest.
                </p>
                <br>
                <?php
                $faq_topics = "SELECT * FROM faqs_subjects";
                $faq_topics_query = $conn->query($faq_topics);
                if ($faq_topics_query->num_rows > 0) {
                    while ($topic_row = $faq_topics_query->fetch_assoc()) {
                        echo '<h3 id="' . $topic_row['name'] . '">' . $topic_row['name'] . '</h3>';
                        echo '<div class="container mt-3">';

                        $faq = "SELECT * FROM faq WHERE subject='" . $topic_row['name'] . "'";
                        $faq_query = $conn->query($faq);
                        if ($faq_query->num_rows > 0) {
                            while ($faq_row = $faq_query->fetch_assoc()) {
                                echo '<div class="question my-5">';
                                echo '<a href="#collapse' . $faq_row['id'] . '" class="text-faqs" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse' . $faq_row['id'] . '">';
                                echo '<h3 style="padding: 15px; font-weight: 700;">' . $faq_row['title'] . '<i class="fa-solid fa-chevron-down"></i></a></h3>';
                                echo '<hr>';
                                echo '<div class="collapse mt-3" id="collapse' . $faq_row['id'] . '">';
                                echo '<div class="card card-body border-0">' . $faq_row['text'] . '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No FAQs available for this subject.</p>';
                        }

                        echo '</div>';
                    }
                }
                ?>
            </div>
            <div class="col-sm-12 col-md-6">
                <h3 style="text-align: center;">Easy Menu</h3>
                <br>
                <div class="Announcements-div" style="width: 50%; display: block; margin-left: auto; margin-right: auto;">
                    <div class="list-group">
                        <?php
                        $faq_topics = "SELECT name FROM faqs_subjects";
                        $faq_topics_query = $conn->query($faq_topics);
                        if ($faq_topics_query->num_rows > 0) {
                            while ($faq_row = $faq_topics_query->fetch_assoc()) {
                                echo ' <a href="#' . $faq_row['name'] . '" class="list-group-item list-group-item-action">' . $faq_row['name'] . '</a>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    include 'frontend/api/firebase.php';
    ?>
</body>
<footer>
    <?php include "frontend/layout/footer.php"; ?>
</footer>

</html>