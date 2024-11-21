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
    <link rel="stylesheet" href="css/application.css">
    <title>Announcements | Starlight University</title>
</head>

<body style="background-color: #D4F1F4;">

    <!-- Navbar -->
    <?php include "frontend/layout/navbar.php"; ?>

    <!-- Main content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 p-3 announcements-container" style="height: 750px ">
                <div class="card shadow-sm" style="border-radius: 10px;">
                    <div class="card-header text-center text-light" style="background-color: #05445E;">
                        <h5 class="m-0">Announcements</h5>
                    </div>
                    <ul class="nav flex-column list-group list-group-flush">
                        <?php
                        $announcements = "SELECT * FROM announcement";
                        $announcements_query = $conn->query($announcements);
                        if ($announcements_query->num_rows > 0) {
                            while ($announcements_row = $announcements_query->fetch_assoc()) {
                                echo '<li class="nav-item">
                                <a class="nav-link text-dark list-group-item list-group-item-action py-3" href="announcements-details.php?id=' . $announcements_row['id'] . '">' . $announcements_row['title'] . '</a>
                            </li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 p-3">
                <?php
                $announcementss = "SELECT * FROM announcement";
                $announcementss_queryy = $conn->query($announcementss);
                $first_row = $announcementss_queryy->fetch_assoc();
                if ($first_row) {
                    echo '<div class="card">';
                    echo '<div class="card-body">';
                    echo '<div class="d-flex py-3">';
                    echo '<h3>' . $first_row['title'] . '</h3>';
                    echo '<p class="pt-2 ms-auto" style="vertical-align:baseline;">' . $first_row['date'] . '</p>';
                    echo '</div>';
                    echo '<div style="overflow: visible; max-width:1000px;">';
                    echo '<p>' . $first_row['text'] . '</p>';
                    echo '</div>';
                    if (!empty($first_row['image'])) {
                        echo '<img src="' . $first_row['image'] . '" alt="announcement-img" class="img-fluid" style="max-width: 100%; height: auto; margin-left: auto; margin-right: auto;">';
                    } else {
                        echo '<img src="img/logo-text.png" alt="announcement-img" class="img-fluid" style="max-width: 100%; height: auto; margin-left: auto; margin-right: auto;">';
                    }
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php include 'frontend/api/firebase.php'; ?>

    <!-- Footer -->
    <footer>
        <?php include "frontend/layout/footer.php"; ?>
    </footer>
</body>

</html>