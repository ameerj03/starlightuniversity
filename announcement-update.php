<?php
session_start();
include "action.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select_Announcements = "SELECT * FROM announcement WHERE id = $id";
    $select_query = $conn->query($select_Announcements);

    if ($select_query->num_rows > 0) {
        $rowss = $select_query->fetch_assoc();
    } else {
        echo "no user found";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit_data'])) {
        mysqli_query($conn, "UPDATE announcement SET title='" . $_POST['title'] . "', text='" . $_POST['text'] . "' WHERE id='" . $id . "'");

    } elseif (isset($_POST['edit_photo'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize(($_FILES["image"]["tmp_name"]));

        if ($check !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                $image = $target_file;
                $title = $_POST['title'];
                $text = $_POST['text'];

                mysqli_query($conn, "UPDATE announcement SET image = '$image' WHERE id = $id");
            }
        }
        
    }


    header("Location: announcement-db.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard | Starlight University</title>
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/afe390969e.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    </head>
</head>

<body style="background-color: rgb(240, 239, 239);">

    <div class="sidebar">
        <a href="dashboard.php"> <i class="fa-solid fa-house"></i> Home</a>
        <h6 class="pt-4 ps-2 ms-2 text-uppercase text-xs subjects font-weight-bolder opacity-6"> Components </h6>
        <a class="active" href="announcement-db.php"> <i class="fa-solid fa-bullhorn"></i> Announcements</a>
        <a href="faqs-db.php"> <i class="fa-solid fa-question"></i>FAQs</a>
        <a href="programs-db.php"> <i class="fa-solid fa-graduation-cap"></i> Programs</a>
        <h6 class="pt-4 ps-2 ms-2 text-uppercase text-xs subjects font-weight-bolder opacity-6"> Management </h6>
        <a href="users-db.php"><i class="fa-solid fa-user"></i> Users</a>
        <a href="messages-db.php"> <i class="fa-solid fa-envelope"></i> Messages</a>
        <a href="applications-db.php"> <i class="fa-solid fa-clipboard-list"></i> Applications</a>
        <a href="notifications-db.php"> <i class="fa-solid fa-bell"></i> Notifications</a>
        <h6 class="pt-4 ps-2 ms-2 text-uppercase text-xs subjects font-weight-bolder opacity-6"> Stats </h6>
        <a href="reports-db.php"> <i class="fa-solid fa-chart-simple"></i> Reports</a>
    </div>

    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav sasas" style="padding-left: 15px;">
                    <a class="nav-item nav-link uni-home" href="home.php">University Homepage</a>

                </div>
                <div class="navbar-pic">
                    <a class="nav-item">
                        <img src="img/blank.png" alt="user" class="user-pic">
                        <a href="index.php" style="text-decoration: none; color: black; padding-left: 10px;">Log Out</a>
                    </a>
                </div>
            </div>
        </nav>
        <div class="Announcements-div">
            <h2 class="db-title">Posted Announcements: </h2>
            <div class="posted-Announcements-none" style="display:none;">
                <div class="card">
                    <div class="card-body">
                        No Announcements found, post a new announcement now:
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Title</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Text</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Image</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Edit Date</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "university";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $view = "SELECT id, title, text, image, date FROM announcement";
                        $view_query = $conn->query($view);

                        if ($view_query->num_rows > 0) {
                            while ($row = $view_query->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='nav-link-text ps-5'>" . $row['title'] . "</td>";
                                echo "<td class='nav-link-text ps-5'>" . $row['text'] . "</td>";
                                echo "<td class='nav-link-text ps-5'>" . $row['image'] . "</td>";
                                echo "<td class='nav-link-text ps-5'>" . $row['date'] . "</td>";
                                echo '<td class="nav-link-text ps-5">';
                                echo '<div class="d-flex">';
                                echo '<form action="announcement-delete.php" method="post" style="display:inline-block;">';
                                echo '<button type="submit" class="btn btn-danger mx-2" name="id" value="' . $row['id'] . '">Delete</button>';
                                echo '</form>';
                                //echo '<form action="announcement-ddselete.php" method="post" style="display:inline-block;">';
                                //echo '<button type="submit" class="btn edit-btn mx-2" name="id" value="' . $row['id'] . '">Edit</button>';
                                //echo '</form>';
                                echo '<a class="btn edit-btn" href="announcement-update.php?id=' . $row['id'] . '">Edit</a>';
                                echo '</div>';
                                echo '</td>';
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr>";
                            echo "<td class='nav-link-text ps-5' colspan='5' style='text-align: center;'>THERE ARE NO USERS</td>";
                            echo "</tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
                <button type="button" class="btn edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Post announcement
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">announcement form</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="post-announcement.php" method="post" enctype="multipart/form-data">
                                    <label class="dashboard-label">announcement's Title</label>
                                    <br>
                                    <input type="text" name="title" class="form-control">
                                    <br>
                                    <label class="dashboard-label">announcement's Description</label>
                                    <br>
                                    <input type="text" name="text" class="form-control">
                                    <br>
                                    <label class="dashboard-label">announcement's Picture</label>
                                    <br>
                                    <input type="file" name="image" class="form-control">

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="buttons" style="width: 30%;">Post</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="mymodal1" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="myModalLabel">announcement Update Form</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">

                            <label class="dashboard-label">announcement's Title</label>
                            <br>
                            <input type="text" name="title" class="form-control" value="<?php echo $rowss['title'] ?>">
                            <br>
                            <label class="dashboard-label">announcement's Description</label>
                            <br>
                            <input type="text" name="text" class="form-control" value="<?php echo $rowss['text'] ?>">
                            <br>
                            <button type="button" class="btn btn-outline-dark" data-bs-target="#photoModal" data-bs-toggle="modal">Change Picture</button>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn edit-btn" name="edit_data">Update</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="photoModalLabel">Update Image</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <label class="dashboard-label">Select Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#mymodal1">Back</button>
                            <button type="submit" name="edit_photo" class="btn edit-btn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#mymodal1').modal('show');
        });
    </script>
</body>

</html>