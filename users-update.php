<?php
session_start();
include "action.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select_users = "SELECT * FROM user WHERE id = $id";
    $select_query = $conn->query($select_users);

    if ($select_query->num_rows > 0) {
        $rowss = $select_query->fetch_assoc();
    } else {
        echo "no user found";
    }
}

if (count($_POST) > 0) {
    $degree = $_POST['degree'] === 'other' ? $_POST['other_degree'] : $_POST['degree'];
    $update_query = "UPDATE user SET 
        name='" . $_POST['name'] . "', 
        lastname='" . $_POST['lastname'] . "', 
        role='" . $_POST['role'] . "', 
        degree='" . $degree . "', 
        email='" . $_POST['email'] . "', 
        gender='" . $_POST['gender'] . "' 
        WHERE id = '" . $id . "'";
    mysqli_query($conn, $update_query);
    header("Location: users-db.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

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
                                echo '<form action="users-update.php" method="get" style="display:inline-block;">';
                                echo '<button type="submit" class="btn edit-btn mx-2" name="id" value="' . $row['id'] . '">Edit</button>';
                                echo '</form>';
                                echo '</div>';
                                echo '</td>';
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr>";
                            echo "<td class='nav-link-text ps-5' colspan='5' style='text-align: center;'>THERE ARE NO USERS</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <button type="button" class="btn edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add user
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form action="" method="post">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="md-4 form-group">
                                        <label for="exampleFormControlInput1">First Name</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
                                    </div>
                                    <div class="md-4 form-group">
                                        <label for="exampleFormControlInput2">Last Name</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput2" name="lastname">
                                    </div>
                                    <div class="md-4 form-group">
                                        <label for="exampleFormControlInput3">Email</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput3" name="email">
                                    </div>
                                    <div class="md-4 form-group">
                                        <label for="exampleFormControlSelect1">Gender</label>
                                        <select class="form-select form-select-md md-4 mb-3" id="exampleFormControlSelect1" name="gender">
                                            <option selected disabled>Select...</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="md-4 form-group">
                                        <label for="exampleFormControlSelect2">Role</label>
                                        <select class="form-select form-select-md md-4 mb-3" id="exampleFormControlSelect2" name="role">
                                            <option selected disabled>Select...</option>
                                            <option value="student">Student</option>
                                            <option value="teacher">Teacher</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="md-4 form-group">
                                        <label for="degree-select">Degree</label>
                                        <select class="form-select form-select-md md-4 mb-3" id="degree-select" name="degree">
                                            <option selected disabled>Select...</option>
                                            <option value="undergraduate">Undergraduate</option>
                                            <option value="graduate">Graduate</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <input type="hidden" name="degree" id="degree-hidden">
                                    </div>
                                    <div class="md-4 form-group" id="other-degree-group" style="display:none;">
                                        <label for="other-degree">Other</label>
                                        <input type="text" class="form-control" id="other-degree" name="other_degree">
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

        <div class="modal fade" id="mymodal1" tabindex="-1" aria-labelledby="example" aria-hidden="true">
            <form action="" method="post">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example"> Update User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="md-4 form-group">
                                <label for="exampleFormControlInput1">First Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="<?php echo $rowss['name'] ?>">
                            </div>
                            <div class="md-4 form-group">
                                <label for="exampleFormControlInput2">Last Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput2" name="lastname" value="<?php echo $rowss['lastname'] ?>">
                            </div>
                            <div class="md-4 form-group">
                                <label for="exampleFormControlInput3">Email</label>
                                <input type="email" class="form-control" id="exampleFormControlInput3" name="email" value="<?php echo $rowss['email'] ?>">
                            </div>
                            <div class="md-4 form-group">
                                <label for="exampleFormControlSelect1">Gender</label>
                                <select class="form-select form-select-md md-4 mb-3" id="exampleFormControlSelect1" name="gender">
                                    <option selected disabled>Select...</option>
                                    <option value="male" <?php echo $rowss['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
                                    <option value="female" <?php echo $rowss['gender'] == 'female' ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                            <div class="md-4 form-group">
                                <label for="exampleFormControlSelect2">Role</label>
                                <select class="form-select form-select-md md-4 mb-3" id="exampleFormControlSelect2" name="role">
                                    <option selected disabled>Select...</option>
                                    <option value="student" <?php echo $rowss['role'] == 'student' ? 'selected' : '' ?>>Student</option>
                                    <option value="teacher" <?php echo $rowss['role'] == 'teacher' ? 'selected' : '' ?>>Teacher</option>
                                    <option value="other" <?php echo $rowss['role'] == 'other' ? 'selected' : '' ?>>Other</option>
                                </select>
                            </div>
                            <div class="md-4 form-group">
                                <label for="degree-select-edit">Degree</label>
                                <select class="form-select form-select-md md-4 mb-3" id="degree-select-edit" name="degree">
                                    <option value="undergraduate" <?php echo $rowss['degree'] == 'undergraduate' ? 'selected' : '' ?>>Undergraduate</option>
                                    <option value="graduate" <?php echo $rowss['degree'] == 'graduate' ? 'selected' : '' ?>>Graduate</option>
                                    <option value="other" <?php echo $rowss['degree'] != 'undergraduate' && $rowss['degree'] != 'graduate' ? 'selected' : '' ?>>Other</option>
                                </select>
                                <input type="hidden" name="degree" id="degree-hidden-edit">
                            </div>
                            <div class="md-4 form-group" id="other-degree-group-edit" style="display:none;">
                                <label for="other-degree-edit">Other</label>
                                <input type="text" class="form-control" id="other-degree-edit" name="other_degree" value="<?php echo $rowss['degree'] != 'undergraduate' && $rowss['degree'] != 'graduate' ? $rowss['degree'] : '' ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="edit-btn btn">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#mymodal1').modal('show');

            function updateHiddenDegreeInput(selectId, hiddenInputId, otherInputId, otherGroupId) {
                var selectElement = $(selectId);
                var hiddenInput = $(hiddenInputId);
                var otherInput = $(otherInputId);
                var otherGroup = $(otherGroupId);

                function updateDegreeValue() {
                    if (selectElement.val() === 'other') {
                        hiddenInput.val(otherInput.val());
                        otherGroup.show();
                        otherInput.prop('required', true);
                    } else {
                        hiddenInput.val(selectElement.val());
                        otherGroup.hide();
                        otherInput.prop('required', false);
                    }
                }

                selectElement.on('change', updateDegreeValue);
                otherInput.on('input', function() {
                    if (selectElement.val() === 'other') {
                        hiddenInput.val(otherInput.val());
                    }
                });

                updateDegreeValue();
            }

            updateHiddenDegreeInput('#degree-select', '#degree-hidden', '#other-degree', '#other-degree-group');
            updateHiddenDegreeInput('#degree-select-edit', '#degree-hidden-edit', '#other-degree-edit', '#other-degree-group-edit');

            var degreeSelect = $('#degree-select-edit');
            if (degreeSelect.val() === 'other') {
                $('#other-degree-group-edit').show();
                $('#other-degree-edit').prop('required', true);
                degreeSelect.prop('required', false);
            } else {
                $('#other-degree-group-edit').hide();
                $('#other-degree-edit').prop('required', false);
                degreeSelect.prop('required', true);
            }
        });
    </script>
</body>

</html>