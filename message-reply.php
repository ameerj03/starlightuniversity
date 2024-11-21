<?php
include "action.php";


if (isset($_GET['id'])) {
    $message_id = $_GET['id'];
    $select_users = "SELECT * FROM message WHERE id = $message_id";
    $select_query = $conn->query($select_users);

    if ($select_query->num_rows > 0) {
        $rowss = $select_query->fetch_assoc();
    } else {
        echo "no user found";
    }
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
        <a href="announcement-db.php"> <i class="fa-solid fa-bullhorn"></i> Announcements</a>
        <a href="faqs-db.php"> <i class="fa-solid fa-question"></i>FAQs</a>
        <a href="programs-db.php"> <i class="fa-solid fa-graduation-cap"></i> Programs</a>
        <h6 class="pt-4 ps-2 ms-2 text-uppercase text-xs subjects font-weight-bolder opacity-6"> Management </h6>
        <a href="users-db.php"><i class="fa-solid fa-user"></i> Users</a>
        <a class="active" href="messages-db.php"> <i class="fa-solid fa-envelope"></i> Messages</a>
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
        <div class="container mt-4">
            <h2 class="db-title mb-4">Messages</h2>
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">From</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">To</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Subject</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Text</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Date</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "action.php";

                        $view = "SELECT * FROM message";
                        $view_query = $conn->query($view);

                        if ($view_query->num_rows > 0) {
                            while ($row = $view_query->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='nav-link-text ps-5'>" . $row['sender'] . "</td>";
                                echo "<td class='nav-link-text ps-5'>" . $row['receiver'] . "</td>";
                                echo "<td class='nav-link-text ps-5'>" . $row['subject'] . "</td>";
                                echo "<td class='nav-link-text ps-5'>" . $row['text'] . "</td>";
                                echo "<td class='nav-link-text ps-5'>" . $row['date'] . "</td>";
                                echo '<td class="nav-link-text ps-5">';
                                echo '<div style="display: flex">';
                                echo '<form action="message-delete.php" method="post" style="display:inline-block;">';
                                echo '<button type="submit" class="btn btn-danger mx-2" name="id" value="' . $row['id'] . '">Delete</button>';
                                echo '</form>';
                                echo '<form action="message-reply.php" method="get" style="display:inline-block;">';
                                //echo '<a class="btn edit-btn" href="message-update.php?id=' . $row['id'] . '">Reply</a>';
                                echo '<button type="submit" class="btn edit-btn mx-2" name="id" value="' . $row['id'] . '">Reply</button>';
                                echo '</form>';
                                echo '</div>';
                                echo '</td>';
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr>";
                            echo "<td class='nav-link-text ps-5' colspan='6' style='text-align: center;'>THERE ARE NO MESSAGES</td>";
                            echo "</tr>";
                        }


                        ?>
                    </tbody>
                </table>

                <button type="button" class="btn edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Send Message
                </button>
                <form action="add-message.php" method="post">
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Send New Message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="md-4 mb-3 form-group">
                                        <label for="name">From</label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control d-inblock" aria-label="name" id="name" name="name" style="width: 50%;">
                                            <input type="text" class="form-control d-inblock" aria-label="lastname" id="lastname" name="lastname" style="width: 50%;">
                                        </div>
                                    </div>
                                    <div class="md-4 mb-3 form-group">
                                        <label for="receiver">To</label>
                                        <select name="receiver" id="receiver" class="form-select form-select-md md-4 mb-3">
                                            <option selected disabled>Select...</option>
                                            <?php
                                            $select_users = "SELECT * FROM user WHERE role='student'";
                                            $select_users_query = $conn->query($select_users);
                                            if ($select_users_query->num_rows > 0) {
                                                while ($rows = $select_users_query->fetch_assoc()) {
                                                    echo '<option value="' . $rows['id'] . '">' . $rows['name'] . ' ' . $rows['lastname'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <div class="md-4 mb-3 form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control" aria-label="subject" id="subject" name="subject">
                                    </div>
                                    <div class="md-4 form-group">
                                        <label for="text">Text</label>
                                        <input type="text" class="form-control" aria-label="text" id="text" name="text">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="edit-btn btn">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($select_users_query->num_rows > 0) {
                        while ($rows = $select_users_query->fetch_assoc()) {
                            echo '<input type="hidden" name="name" value=' . $rows['name'] . '>';
                            echo '<input type="hidden" name="lastname" value=' . $rows['lastname'] . '>';
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
    
                    <div class="modal fade" id="mymodal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form action="add-message.php" method="post">
                        <input type="hidden" name="sender" value="<?php
                        echo $rowss['receiver'];
                        ?>">
                        <input type="hidden" name="receiver"value="<?php
                        echo $rowss['sender'];
                        ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="md-4 mb-3 form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control" aria-label="subject" id="subject" name="subject">
                                    </div>
                                    <div class="md-4 form-group">
                                        <label for="text">Text</label>
                                        <input type="text" class="form-control" aria-label="text" id="text" name="text">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="edit-btn btn">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="name" value="admin">
                    <input type="hidden" name="lastname" value="admin">
                </form>
</body>
<script>
$(document).ready(function () {
    $('#mymodal1').modal('show');
});
</script>
<script>
    document.getElementById('degree-select').addEventListener('change', function() {
        var otherDegreeGroup = document.getElementById('other-degree-group');
        var degreeInput = document.getElementById('degree');
        if (this.value === 'other') {
            otherDegreeGroup.style.display = 'block';
            degreeInput.required = true;
            this.removeAttribute('required');
        } else {
            otherDegreeGroup.style.display = 'none';
            degreeInput.removeAttribute('required');
            this.required = true;
        }
    });

    // Initial load
    window.addEventListener('load', function() {
        var degreeSelect = document.getElementById('degree-select');
        if (degreeSelect.value === 'other') {
            document.getElementById('other-degree-group').style.display = 'block';
            document.getElementById('degree').required = true;
            degreeSelect.removeAttribute('required');
        } else {
            document.getElementById('other-degree-group').style.display = 'none';
            document.getElementById('degree').removeAttribute('required');
            degreeSelect.required = true;
        }
    });
</script>

</html>