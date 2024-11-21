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

$user_status = "SELECT * FROM application WHERE user_id = '$user_id' AND status = 'accepted' AND fin_status = 'unpaid'";
$user_status_query = $conn->query($user_status);


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
                            <a class="nav-link" aria-current="page" style="color:#189AB4;" href="profile.php">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile-application.php" style="color:#189AB4;">Application Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="profile-financial.php">Financial</a>
                        </li>
                    </ul>
                    <div class="container mt-3">
                        <div class="row mb-3">
                            
                                <?php
                                if($user_status_query->num_rows>0){
                                    echo '
                                    <div class="col-sm-12 d-flex align-items-center">
                                    <div class=" pe-2 alert-container align-items-center">
                                    <div class="alert-circle align-items-center"></div>
                                    </div>
                                    <h6 class="mb-0" style="font-weight: bold;">You have an unpaid invoice!</h6>
                                    </div>';
                                }
                                else{
                                    echo '
                                    <div class="col-sm-12 d-flex align-items-center">
                                    <div class=" pe-2 alert-container align-items-center">
                                    <div class="success-circle align-items-center"></div>
                                    </div>
                                    <h6 class="mb-0" style="font-weight: bold;">You don\'t have any unpaid invoices.</h6>
                                    </div>';
                                }
                                ?>
                               
                            
                            
                        </div>
                        <?php
                        if($user_status_query->num_rows>0){
                            echo '<hr>
                        <div class="row mb-3">
                            <div class="col-sm-4 d-flex align-items-center">
                                <label style="font-weight:600">Program accepted:</label>
                            </div>
                            <div class="col-sm-4 d-flex align-items-center justify-content-center">
                                <label style="font-weight: 600;">Amount to pay:</label>
                            </div>
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                               <h6> </h6>
                            </div>
                        </div>
                        <hr>'
                        ;
                        $row_test = $user_status_query->fetch_assoc();
                            $program_id = $row_test['program_id'];
                            $application_id = $row_test['id'];
                            $program_details = "SELECT * FROM program WHERE id = '$program_id'";
                            $program_details_query = $conn->query($program_details);
                            $program_array = $program_details_query->fetch_assoc();
                            $program_id = $program_array['id'];
                            $program_name = $program_array['name'];
                            $program_language = $program_array['language'];
                            $program_fees = $program_array['fees'];
                            echo'
                            
                            <div class="row mb-3">
                            <div class="col-sm-4 d-flex align-items-center">
                                <h6>'.$program_name." (".$program_language.")".'</h6>
                            </div>
                            <div class="col-sm-4 d-flex align-items-center justify-content-center">
                                <h6>'.$program_fees.'$</h6>
                            </div>
                            <div class="col-sm-4 d-flex align-items-center justify-content-end">
                            <form action="payment.php" method="post">

                                 
                                      <input type="hidden" name="application_id" value="' . $application_id . '">
        <input type="hidden" name="program_id" value="' . $program_id . '">
         <input type="hidden" name="user_id" value="' . $user_id . '">
        <button type="submit" class="btn edit-btn">Pay Now</button>
                        </form>
                        </div>
                            </div>
                        </div>
                        <hr>';
                            }
                                
                        ?>
                        
                        
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