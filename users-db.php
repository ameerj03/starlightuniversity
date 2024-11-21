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
        <a href="faqs-db.php"> <i class="fa-solid fa-question"></i>FAQs</a>
        <a href="programs-db.php"> <i class="fa-solid fa-graduation-cap"></i> Programs</a>
        <h6 class="pt-4 ps-2 ms-2 text-uppercase text-xs subjects font-weight-bolder opacity-6"> Management </h6>
        <a class="active" href="users-db.php"><i class="fa-solid fa-user"></i> Users</a>
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
        <div class="container mt-4">
            <h2 class="db-title mb-4">Website's Users</h2>
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Last Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Gender</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Role</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Degree</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "action.php";

                        $view = "SELECT * FROM user";
                        $view_query = $conn->query($view);

                        if ($view_query->num_rows > 0) {
                            while ($row = $view_query->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='nav-link-text ps-5'>" . $row['name'] . "</td>";
                                echo "<td class='nav-link-text ps-5'>" . $row['lastname'] . "</td>";
                                echo "<td class='nav-link-text ps-5'>" . $row['gender'] . "</td>";
                                echo "<td class='nav-link-text ps-5'>" . $row['role'] . "</td>";
                                echo "<td class='nav-link-text ps-5'>" . $row['degree'] . "</td>";
                                echo '<td class="nav-link-text ps-5">';
                                echo '<div style="display: flex">';
                                echo '<form action="user-delete.php" method="post" style="display:inline-block;">';
                                echo '<button type="submit" class="btn btn-danger mx-2" name="id" value="' . $row['id'] . '">Delete</button>';
                                echo '</form>';
                                //echo '<form action="users-update.php" method="get" style="display:inline-block;">';
                                echo '<a class="btn edit-btn" href="users-update.php?id=' . $row['id'] . '">Edit</a>';
                                //echo '<button type="submit" class="btn edit-btn mx-2" name="id" value="' . $row['id'] . '">Edit</button>';
                                //echo '</form>';
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
                    Add user
                </button>
                <form action="add-user.php" method="post">
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="md-4 mb-3 form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" aria-label="name" id="name" name="name">
                                    </div>
                                    <div class="md-4 mb-3 form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control" aria-label="lastname" id="lastname" name="lastname">
                                    </div>
                                    <div class="md-4 form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-select form-select-md md-4 mb-3" aria-label=".form-select-md example" id="gender" name="gender">
                                            <option selected disabled>Select...</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>

                                    </div>
                                    <div class="md-4 mb-3 form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" aria-label="email" id="email" name="email">
                                    </div>
                                    <div class="md-4 form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" aria-label="Password" id="password" name="password">
                                    </div>
                                    <div class="md-4 form-group">
                                        <label for="gender">Role</label>
                                        <select class="form-select form-select-md md-4 mb-3" aria-label=".form-select-md example" id="role" name="role">
                                            <option selected disabled>Select...</option>
                                            <option value="student">student</option>
                                            <option value="admin">admin</option>
                                        </select>
                                        <div class="md-4 form-group">
                                            <label for="degree-select">Degree</label>
                                            <select class="form-select form-select-md md-4 mb-3" aria-label=".form-select-md example" id="degree-select" name="degree">
                                                <option selected disabled>Select...</option>
                                                <option value="undergraduate">Undergraduate</option>
                                                <option value="graduate">Graduate</option>
                                                <option>Other</option>
                                            </select>
                                        </div>

                                        <div class="md-4 form-group" id="other-degree-group" style="display:none;">
                                            <label for="degree">Other</label>
                                            <input type="text" class="form-control" aria-label="Degree" id="degree" name="other_degree">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="edit-btn btn">Add</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
document.getElementById('degree-select').addEventListener('change', function() {
    var otherDegreeGroup = document.getElementById('other-degree-group');
    var degreeInput = document.getElementById('degree');

    if (this.value === 'other') {
        otherDegreeGroup.style.display = 'block';
        degreeInput.setAttribute('required', true);
    } else {
        otherDegreeGroup.style.display = 'none';
        degreeInput.removeAttribute('required');
    }
});

// Initial load
window.addEventListener('load', function() {
    var degreeSelect = document.getElementById('degree-select');
    var otherDegreeGroup = document.getElementById('other-degree-group');
    var degreeInput = document.getElementById('degree');

    if (degreeSelect.value === 'other') {
        otherDegreeGroup.style.display = 'block';
        degreeInput.setAttribute('required', true);
    } else {
        otherDegreeGroup.style.display = 'none';
        degreeInput.removeAttribute('required');
    }
});

</script>

</html>