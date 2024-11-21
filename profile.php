<?php
session_start();
include "action.php";



if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['id'];
$email = $_SESSION['email'];
$user_name = $_SESSION['name'];
$user_lastname = $_SESSION['lastname'];
$gender = $_SESSION['gender'];
$degree = $_SESSION['degree'];
$lastname = $_SESSION['lastname'];
$role = $_SESSION['role'];
$phone = $_SESSION['phone'];
$id = $_SESSION['id'];
$image = $_SESSION['image'];

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
    <?php
    include "frontend/layout/header.php";
    ?>
    <link rel="stylesheet" href="css/application.css">
    <title>Profile | Starlight University</title>
</head>

<body style="background-color: #D4F1F4;">

    <!-- Navbar -->
    <?php
    include "frontend/layout/navbar.php" ?>

    <!-- Main content -->
    <div class="container my-5">
        <div class="card">
            <div class="row">
                <div class="pt-4 px-4">
                    <button class="float-end btn edit-btn" style="color: white;" data-bs-toggle="modal" data-bs-target="#editModal">Edit Profile</button>
                </div>
                <div class="col-md-3 p-3 d-flex flex-column align-items-center">
                    <div class="position-relative">
                        <?php

                        $view = "SELECT image FROM user WHERE id= $user_id";
                        $view_query = $conn->query($view);
                        if ($view_query->num_rows > 0) {
                            $row = $view_query->fetch_assoc();
                            $imagePath = $row['image'];
                            if (file_exists($imagePath)) {
                                echo '<img src="' . $imagePath . '" class="img-fluid rounded-circle mb-2" alt="user" style="width: 250px; height: 250px;">';
                            } else {
                                echo '<img src="img/blank.png" class="img-fluid rounded-circle mb-2" alt="user" style="width: 250px; height: 250px;">';
                            }
                        }


                        ?>
                        <button class="btn btn-primary position-absolute bottom-0 end-0 translate-middle rounded-circle edit-btn-fix" style="transform: translate(-50%, -50%);" title="Change Picture" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#photoModal">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                    <h2 class="d-inline"><?php
                                            echo "$user_name" . " $user_lastname" ?>
                    </h2>
                    <h6 class="d-inline"><?php
                                            echo "(" . "$degree" . ")";
                                            ?></h6>
                </div>
                <div class="col-md-9 p-3">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="profile.php">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile-application.php" style="color:#189AB4;">Application Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile-financial.php" style="color:#189AB4;">Financial</a>
                        </li>
                    </ul>
                    <div class="container mt-3">
                        <div class="row mb-3">
                            <div class="col-sm-6 d-flex align-items-center">
                                <label for="name" class="col-form-label" style="flex: 0 1 auto; white-space: nowrap; font-weight:bold;">Name:</label>
                                <input type="text" readonly class="form-control-plaintext flex-grow-1 px-2" id="name" value="<?php
                                                                                                                                echo "$user_name";
                                                                                                                                ?>">
                            </div>
                            <div class="col-sm-6 d-flex align-items-center">
                                <label for="lastname" class="col-form-label" style="flex: 0 1 auto; white-space: nowrap; font-weight:bold;">Last Name:</label>
                                <input type="text" readonly class="form-control-plaintext flex-grow-1 px-2" id="lastname" value="<?php
                                                                                                                                    echo "$user_lastname";
                                                                                                                                    ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-sm-6 d-flex align-items-center">
                                <label for="phone" class="col-form-label" style="flex: 0 1 auto; white-space: nowrap; font-weight:bold;">Phone:</label>
                                <input type="text" readonly class="form-control-plaintext flex-grow-1 px-2" id="phone" value="<?php
                                                                                                                                echo "0" . "$phone";
                                                                                                                                ?>">
                            </div>
                            <div class="col-sm-6 d-flex align-items-center">
                                <label for="email" class="col-form-label" style="flex: 0 1 auto; white-space: nowrap; font-weight:bold;">Email:</label>
                                <input type="text" readonly class="form-control-plaintext flex-grow-1 px-2" id="email" value="<?php
                                                                                                                                echo "$email";
                                                                                                                                ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-sm-6 d-flex align-items-center">
                                <label for="gender" class="col-form-label" style="flex: 0 1 auto; white-space: nowrap; font-weight:bold;">Gender:</label>
                                <input type="text" readonly class="form-control-plaintext flex-grow-1 px-2" id="gender" value="<?php
                                                                                                                                echo "$gender";
                                                                                                                                ?>">
                            </div>
                            <div class="col-sm-6 d-flex align-items-center">
                                <label for="degree" class="col-form-label" style="flex: 0 1 auto; white-space: nowrap; font-weight:bold;">Degree:</label>
                                <input type="text" readonly class="form-control-plaintext flex-grow-1 px-2" id="degree" value="<?php
                                                                                                                                echo "$degree";
                                                                                                                                ?>">
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="update-photo.php" method="post" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Profile Picture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="new-photo" class="form-label">New Picture</label>
                            <input type="file" name="image" id="new-photo" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn edit-btn">Apply</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?php echo "$id" ?>">
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="update-profile.php" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" type="text" name="name" value="<?php echo $user_name ?>">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="name">Lastname</label>
                                <input class="form-control" id="lastnname" type="text" name="lastname" value="<?php echo $user_lastname ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="phone">Phone</label>
                                <input class="form-control" id="phone" type="text" name="phone" value="<?php echo $phone ?>">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" type="text" name="email" value="<?php echo $email ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option class="form-control" value="male" <?php
                                                                                if ($gender == 'male') {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Male</option>
                                    <option class="form-control" value="female" <?php
                                                                                if ($gender == 'female') {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="degree">Degree</label>
                                <select name="degree" id="degree" class="form-select">
                                    <option value="undergraduate" <?php
                                                                    if ($degree == 'undergraduate') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>Undergraduate</option>

                                    <option value="graduate" <?php
                                                                if ($degree == 'graduate') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>Graduate</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn edit-btn">Save changes</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php
                                                    echo $user_id;
                                                    ?>">
        </form>
    </div>
    <?php
    include 'frontend/api/firebase.php';
    ?>
</body>
<!-- Footer -->
<footer>
    <?php
    include("frontend/layout/footer.php");
    ?>
</footer>


</html>