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

$program_id = $_GET['num'];

include "action.php";
$view_check = "SELECT * FROM user WHERE id='$user_id' ";
$user_view_check = $conn->query($view_check);

if ($user_view_check->num_rows < 1) {
    header("Location: login.php");
    exit();
}

$select = "SELECT * FROM program WHERE id = '$program_id' ";
$select_query = $conn->query($select);

if ($select_query->num_rows > 0) {
    $row = $select_query->fetch_assoc();
} else {
    header("Location: programs.php");
}
$program_name = $row['name'];
$program_description = $row['description'];
$program_years = $row['years'];
$program_fees = $row['fees'];
$program_degree = $row['degree'];
$program_language = $row['language'];
$program_quota = $row['remaining_quota'];
if ($program_quota == 0) {
    $available = false;
} else {
    $available = true;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $program_name?> | Starlight University</title>
    <link rel="stylesheet" href="css/programs.css">
    <?php
    include "frontend/layout/header.php" ?>
</head>

<body style="background-color: #D4F1F4;">
    <?php
    include "frontend/layout/navbar.php";
    ?>

    <!-- Main content -->


    <div class="row">
        <div class="col-sm-3">
            <div class="container-fluid">
                <div class="card my-3 info sticky-top shadow-lg">
                    <div>
                        <h3 class="mt-3 px-3 text-center">Program Details</h3>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <h6 class="me-auto" style="font-weight: 600;">Language:</h6>
                        <h6 class="ms-auto ms-2"><?php
                                                    echo $program_language;
                                                    ?></h6>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <h6 class="me-auto" style="font-weight: 600;">Duration:</h6>
                        <h6 class="ms-auto ms-2"><?php
                                                    echo $program_years;
                                                    ?> Years</h6>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <h6 class="me-auto" style="font-weight: 600;">Degree:</h6>
                        <h6 class="ms-auto ms-2"><?php
                                                    echo ucfirst($program_degree);
                                                    ?></h6>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <h6 class="me-auto" style="font-weight: 600;">Fees:</h6>
                        <h6 class="ms-auto ms-2"><?php
                                                    echo $program_fees;
                                                    ?>$</h6>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <h6 class="me-auto" style="font-weight: 600;">Status: </h6>
                        <h6 class="ms-auto ms-2"> <?php
                                                    if ($available) {
                                                        echo "Available";
                                                    } else {
                                                        echo "Unavailable";
                                                    }
                                                    ?></h6>
                    </div>
                </div>
                <div class="w-100">
                    <div class="<?php
                                if (!$available) {
                                    echo "locked";
                                }
                                ?>">
                        <a href="application.php" class="btn w-100 text-white border rounded p-2 mx-auto" style="background-color: #05445E;">Apply Now</a>
                    </div class="">
                    <a href="contact.php" class=" btn w-100 text-white border rounded p-2 mx-auto my-2" style="background-color: #05445E;">Contact</a>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="container-fluid">
                <div class="main my-3 card shadow-lg">
                    <div class="info-div">
                        <h3 class="my-3 px-3"><?php
                                                echo ucfirst($program_name);
                                                ?></h3>
                    </div>
                    <p class=" px-3">
                        <?php
                        echo $program_description;
                        ?>
                    </p>

                    <div class="carousel-div m-3">
                        <div id="carouselExample" class="carousel slide carousel-fade">
                            <div class="carousel-inner">
                                <?php
                                $entity_id = $program_id;
                                $select = "SELECT image_path FROM images WHERE entity_id = $entity_id";
                                $select_query = mysqli_query($conn, $select);
                                if ($select_query->num_rows > 0) {
                                    $first = true;

                                    while ($row = $select_query->fetch_assoc()) {
                                        $activeClass = $first ? 'active' : '';
                                        echo '
                                        <div class="carousel-item '.$activeClass.'" style="height: 400px;">
                                    <img src="'.$row['image_path'].'" class="d-block w-100 img-fluid">
                                </div>
                                        
                                ';
                                $first = false;
                                    }
                                } else {
                                    echo "No Images found";
                                }
                                ?>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

<footer>
    <?php
    include "frontend/layout/footer.php";
    ?>
</footer>

</html>