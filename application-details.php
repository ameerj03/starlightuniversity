<?php
session_start();
include "action.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select_apps = "SELECT * FROM application WHERE id = $id";
    $select_query = $conn->query($select_apps);

    if ($select_query->num_rows > 0) {
        $rows = $select_query->fetch_assoc();
    } else {
        echo "No user found";
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
    </head>
</head>

<body style="background-color: rgb(240, 239, 239);">
    <div class="sidebar">
        <a href="dashboard.php"> <i class="fa-solid fa-house"></i> Home</a>
        <h6 class="pt-4 ps-2 ms-2 text-uppercase text-xs subjects font-weight-bolder opacity-6"> Components </h6>
        <a href="announcement-db.php"> <i class="fa-solid fa-bullhorn"></i> Announcements</a>
        <a href="faqs-db.php"> <i class="fa-solid fa-question pe-1"></i>FAQs</a>
        <a href="programs-db.php"> <i class="fa-solid fa-graduation-cap"></i> Programs</a>
        <h6 class="pt-4 ps-2 ms-2 text-uppercase text-xs subjects font-weight-bolder opacity-6"> Management </h6>
        <a href="users-db.php"><i class="fa-solid fa-user"></i> Users</a>
        <a href="messages-db.php"> <i class="fa-solid fa-envelope"></i> Messages</a>
        <a class="active" href="applications-db.php"> <i class="fa-solid fa-clipboard-list"></i> Applications</a>
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
                        <a href="index.php" style="text-decoration: none; color: black; padding-left: 10px;">Log
                            Out</a>
                    </a>
                </div>
            </div>
        </nav>
        <?php
        $user_id = $rows['user_id'];
        $select_user = "SELECT * FROM user WHERE id = '$user_id'";
        $select_user_query = $conn->query($select_user);

        if ($select_user_query->num_rows > 0) {
            $row_user = $select_user_query->fetch_assoc();

            if ($rows['status'] == 'pending') { 
                echo '<div class="card mx-auto my-5 pending-card" style="width: 1000px;">';
                echo '    <div class="card-header">';
                echo '        <h4 class="card-title mb-0">Application Details</h4>';
                echo '    </div>';
                echo '    <div class="card-body">';
                echo '        <div class="row">';
                echo '            <div class="col-md-6">';
                $imagePath = $row_user['image'];
                if (file_exists($imagePath)) {
                    echo '                <img src="' . $row_user['image'] . '" alt="user" style=" border-radius: 15px; width: 200px; height:200px;" class="p-2">';
                }
                else{
                    echo '<img src="img/blank.png" alt="user" style=" border-radius: 15px; width: 200px; height:200px;" class="p-2">';
                }
                echo '                <p class="card-text"><strong>Name: </strong>' . $rows['name'] . '</p>';
                echo '                <p class="card-text"><strong>Father\'s Name: </strong>' . $rows['fathername'] . '</p>';
                echo '                <p class="card-text"><strong>Mother\'s Name: </strong>' . $rows['mothername'] . '</p>';
                echo '                <p class="card-text"><strong>Last Name: </strong>' . $rows['lastname'] . '</p>';
                echo '                <p class="card-text"><strong>Email: </strong>' . $rows['email'] . '</p>';
                echo '                <p class="card-text"><strong>Birthday: </strong>' . $rows['birthday'] . '</p>';
                echo '            </div>';
                echo '            <div class="col-md-6">';
                echo '                <p class="card-text"><strong>Nationality: </strong>' . $rows['nationality'] . '</p>';
                echo '                <p class="card-text"><strong>ID No: </strong>' . $rows['id_no'] . '</p>';
                echo '                <p class="card-text"><strong>Phone: </strong>' . $rows['phone'] . '</p>';
                echo '                <p class="card-text"><strong>Program: </strong>' . $rows['program'] . '</p>';
                echo '                <p class="card-text"><strong>Year Graduated: </strong>' . $rows['year_graduated'] . '</p>';
                echo '                <p class="card-text"><strong>Address: </strong>' . $rows['address'] . '</p>';
                echo '                <p class="card-text"><strong>Gender: </strong>' . $rows['gender'] . '</p>';
                echo '                <p class="card-text"><strong>Application Status: </strong>';
                if ($rows['status'] == 'pending') {
                    echo '<span class="badge text-bg-warning">Pending</span>';
                } elseif ($rows['status'] == 'accepted') {
                    echo '<span class="badge text-bg-success">Accepted</span>';
                } elseif ($rows['status'] == 'rejected') {
                    echo '<span class="badge text-bg-danger">Rejected</span>';
                }
                echo '                </p>';
                echo '            </div>';
                echo '        </div>';
                echo '    </div>';
                echo '    <div class="card-footer text-end">';
                echo '        <div class="d-flex ms-auto">';
                echo '            <form action="approve-application.php" method="post" class="ms-auto me-2">';
                echo '                <button type="submit" class="btn btn-success">Approve</button>';
                echo '              <input type="hidden" name="id" value="' . $rows['id'] . '"> ';
                echo '              <input type="hidden" name="status" value="' . $rows['status'] . '"> ';
                echo '              <input type="hidden" name="user_id" value="' . $rows['user_id'] . '"> ';
                echo '              <input type="hidden" name="program_id" value="' . $rows['program_id'] . '"> ';
                echo '            </form>';
                echo '            <form action="reject-application.php" method="post" ms-auto>';
                echo '              <input type="hidden" name="id" value="' . $rows['id'] . '"> ';
                echo '              <input type="hidden" name="status" value="' . $rows['status'] . '"> ';
                echo '              <input type="hidden" name="user_id" value="' . $rows['user_id'] . '"> ';
                echo '              <input type="hidden" name="program_id" value="' . $rows['program_id'] . '"> ';
                echo '                <button type="submit" class="btn btn-danger">Reject</button>';
                echo '            </form>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
            }
             elseif ($rows['status'] == 'rejected') {
                echo '<div class="card mx-auto my-5 pending-card" style="width: 1000px;">';
                echo '    <div class="card-header">';
                echo '        <h4 class="card-title mb-0">Application Details</h4>';
                echo '    </div>';
                echo '    <div class="card-body">';
                echo '        <div class="row">';
                echo '            <div class="col-md-6">';
                $imagePath = $row_user['image'];
                if (file_exists($imagePath)) {
                    echo '                <img src="' . $row_user['image'] . '" alt="user" style=" border-radius: 15px; width: 200px; height:200px;" class="p-2">';
                }
                else{
                    echo '<img src="img/blank.png" alt="user" style=" border-radius: 15px; width: 200px; height:200px;" class="p-2">';
                }
                echo '                <p class="card-text"><strong>Name: </strong>' . $rows['name'] . '</p>';
                echo '                <p class="card-text"><strong>Father\'s Name: </strong>' . $rows['fathername'] . '</p>';
                echo '                <p class="card-text"><strong>Mother\'s Name: </strong>' . $rows['mothername'] . '</p>';
                echo '                <p class="card-text"><strong>Last Name: </strong>' . $rows['lastname'] . '</p>';
                echo '                <p class="card-text"><strong>Email: </strong>' . $rows['email'] . '</p>';
                echo '                <p class="card-text"><strong>Birthday: </strong>' . $rows['birthday'] . '</p>';
                echo '            </div>';
                echo '            <div class="col-md-6">';
                echo '                <p class="card-text"><strong>Nationality: </strong>' . $rows['nationality'] . '</p>';
                echo '                <p class="card-text"><strong>ID No: </strong>' . $rows['id_no'] . '</p>';
                echo '                <p class="card-text"><strong>Phone: </strong>' . $rows['phone'] . '</p>';
                echo '                <p class="card-text"><strong>Program: </strong>' . $rows['program'] . '</p>';
                echo '                <p class="card-text"><strong>Year Graduated: </strong>' . $rows['year_graduated'] . '</p>';
                echo '                <p class="card-text"><strong>Address: </strong>' . $rows['address'] . '</p>';
                echo '                <p class="card-text"><strong>Gender: </strong>' . $rows['gender'] . '</p>';
                echo '                <p class="card-text"><strong>Application Status: </strong>';
                if ($rows['status'] == 'pending') {
                    echo '<span class="badge text-bg-warning">Pending</span>';
                } elseif ($rows['status'] == 'accepted') {
                    echo '<span class="badge text-bg-success">Accepted</span>';
                } elseif ($rows['status'] == 'rejected') {
                    echo '<span class="badge text-bg-danger">Rejected</span>';
                }
                echo '                </p>';
                echo '            </div>';
                echo '        </div>';
                echo '    </div>';
                echo '    <div class="card-footer text-end">';
                echo '<form action="approve-application.php" method="POST">';
                echo '              <input type="hidden" name="id" value="' . $rows['id'] . '"> ';
                echo '              <input type="hidden" name="status" value="' . $rows['status'] . '"> ';
                echo '              <input type="hidden" name="user_id" value="' . $rows['user_id'] . '"> ';
                echo '              <input type="hidden" name="program_id" value="' . $rows['program_id'] . '"> ';
                echo '        <button type="submit" class="btn btn-success">Approve</button>';
                echo '</form>';
                echo '    </div>';
                echo '</div>';
            } elseif ($rows['status'] == 'accepted') {
                echo '<div class="card mx-auto my-5 pending-card" style="width: 1000px;">';
                echo '    <div class="card-header">';
                echo '        <h4 class="card-title mb-0">Application Details</h4>';
                echo '    </div>';
                echo '    <div class="card-body">';
                echo '        <div class="row">';
                echo '            <div class="col-md-6">';
                $imagePath = $row_user['image'];
                if (file_exists($imagePath)) {
                    echo '                <img src="' . $row_user['image'] . '" alt="user" style=" border-radius: 15px; width: 200px; height:200px;" class="p-2">';
                }
                else{
                    echo '<img src="img/blank.png" alt="user" style=" border-radius: 15px; width: 200px; height:200px;" class="p-2">';
                }
                echo '                <p class="card-text"><strong>Name: </strong>' . $rows['name'] . '</p>';
                echo '                <p class="card-text"><strong>Father\'s Name: </strong>' . $rows['fathername'] . '</p>';
                echo '                <p class="card-text"><strong>Mother\'s Name: </strong>' . $rows['mothername'] . '</p>';
                echo '                <p class="card-text"><strong>Last Name: </strong>' . $rows['lastname'] . '</p>';
                echo '                <p class="card-text"><strong>Email: </strong>' . $rows['email'] . '</p>';
                echo '                <p class="card-text"><strong>Birthday: </strong>' . $rows['birthday'] . '</p>';
                echo '            </div>';
                echo '            <div class="col-md-6">';
                echo '                <p class="card-text"><strong>Nationality: </strong>' . $rows['nationality'] . '</p>';
                echo '                <p class="card-text"><strong>ID No: </strong>' . $rows['id_no'] . '</p>';
                echo '                <p class="card-text"><strong>Phone: </strong>' . $rows['phone'] . '</p>';
                echo '                <p class="card-text"><strong>Program: </strong>' . $rows['program'] . '</p>';
                echo '                <p class="card-text"><strong>Year Graduated: </strong>' . $rows['year_graduated'] . '</p>';
                echo '                <p class="card-text"><strong>Address: </strong>' . $rows['address'] . '</p>';
                echo '                <p class="card-text"><strong>Gender: </strong>' . $rows['gender'] . '</p>';
                echo '                <p class="card-text"><strong>Application Status: </strong>';
                if ($rows['status'] == 'pending') {
                    echo '<span class="badge text-bg-warning">Pending</span>';
                } elseif ($rows['status'] == 'accepted') {
                    echo '<span class="badge text-bg-success">Accepted</span>';
                } elseif ($rows['status'] == 'rejected') {
                    echo '<span class="badge text-bg-danger">Rejected</span>';
                }
                echo '                </p>';
                echo '            </div>';
                echo '        </div>';
                echo '    </div>';
                echo '    <div class="card-footer text-end">';
                echo '<form action="reject-application-after.php" method="POST">';
                echo '              <input type="hidden" name="id" value="' . $rows['id'] . '"> ';
                echo '              <input type="hidden" name="program_id" value="' . $rows['program_id'] . '"> ';
                echo '              <input type="hidden" name="user_id" value="' . $rows['user_id'] . '"> ';
                echo '              <input type="hidden" name="status" value="' . $rows['status'] . '"> ';
                echo '        <button class="btn btn-danger">Reject</button>';
                echo '</form>';
                echo '    </div>';
                echo '</div>';
            }
        }
        ?>

    </div>
</body>

</html>