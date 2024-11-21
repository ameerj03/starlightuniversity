<?php
session_start();
include "action.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select_Announcements = "SELECT * FROM program WHERE id = $id";
    $select_query = $conn->query($select_Announcements);

    if ($select_query->num_rows > 0) {
        $rowss = $select_query->fetch_assoc();
    } else {
        echo "No user found";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['edit_data'])){
         $stmt = $conn->prepare("UPDATE program SET name=?, years=?, degree=?, quota=?, language=?, description=?, fees=? WHERE id=?");
    $stmt->bind_param("sssssssi", $_POST['name'], $_POST['years'], $_POST['degree'], $_POST['quota'], $_POST['language'], $_POST['description'], $_POST['fees'], $id);
    $stmt->execute();
    }
    elseif(isset($_POST['edit_photo'])){

       if (!empty($_FILES['image']['name'][0])) {
        $target_dir = "uploads/";

        // Delete existing images for the specified entity_id
        $deleteStmt = $conn->prepare("DELETE FROM images WHERE entity_id=?");
        $deleteStmt->bind_param("i", $id);
        $deleteStmt->execute();

        foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
            $target_file = $target_dir . basename($_FILES["image"]["name"][$key]);
            $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if the file is an actual image
            $check = getimagesize($tmp_name);
            if ($check !== false) {
                if (move_uploaded_file($tmp_name, $target_file)) {
                    $imageName = basename($_FILES["image"]["name"][$key]);

                    // Ensure that imageName is not empty
                    if (!empty($imageName)) {
                        // Insert new image record
                        $sql = "INSERT INTO images (entity_id, image_name, image_path) VALUES (?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("iss", $id, $imageName, $target_file);
                        $stmt->execute();
                    } else {
                        echo "Image name is empty for: " . $_FILES["image"]["name"][$key];
                    }
                } else {
                    echo "Error uploading image: " . $_FILES["image"]["name"][$key];
                }
            } else {
                echo "File is not an image: " . $_FILES["image"]["name"][$key];
            }
        }
    } 
    }
    

    header("Location: programs-db.php");
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
        <a class="active" href="programs-db.php"> <i class="fa-solid fa-graduation-cap"></i> Programs</a>
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
                        <a href="index.php" style="text-decoration: none; color: black; padding-left: 10px;">Log
                            Out</a>
                    </a>
                </div>
            </div>
        </nav>
        <div class="programs-div">
            <h2 class="db-title">Added programs:</h2>
            <div class="posted-Announcements" style="display:block;">
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Years</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Degree</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Quota</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Remaining Quota</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "action.php";

                            $view = "SELECT * FROM program";
                            $view_query = $conn->query($view);

                            if ($view_query->num_rows > 0) {
                                while ($row = $view_query->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td class='nav-link-text ps-5'>" . $row['name'] . "</td>";
                                    echo "<td class='nav-link-text ps-5'>" . $row['years'] . "</td>";
                                    echo "<td class='nav-link-text ps-5'>" . $row['degree'] . "</td>";
                                    echo "<td class='nav-link-text ps-5'>" . $row['quota'] . "</td>";
                                    echo "<td class='nav-link-text ps-5'>" . $row['remaining_quota'] . "</td>";
                                    echo '<td class="nav-link-text ps-5">';
                                    echo '<div class="d-flex">';
                                    echo '<form action="program-delete.php" method="post" style="display:inline-block;">';
                                    echo '<button type="submit" class="btn btn-danger mx-2" name="id" value="' . $row['id'] . '">Delete</button>';
                                    echo '</form>';
                                    //echo '<form action="program-update.php" method="get" style="display:inline-block;">';
                                    //echo '<button type="submit" class="btn edit-btn mx-2" name="id" value="' . $row['id'] . '">Edit</button>';
                                    //echo '</form>';
                                    echo '<a class="btn edit-btn" href="program-update.php?id=' . $row['id'] . '">Edit</a>';
                                    echo '</td>';
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td class='nav-link-text ps-5' colspan='5' style='text-align: center;'>THERE ARE NO PROGRAMS</td>";
                                echo "</tr>";
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add program
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Program form</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="add-program.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group mb-3">
                                        <label for="name" class="dashboard-label">Program's Name</label>
                                        <input type="text" name="name" class="form-control" id="name" aria-label="name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="description" class="dashboard-label">Description</label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group my-3">
                                        <label class="dashboard-label">Program's Years</label>
                                        <select name="years" class="form-control" aria-label="years">
                                            <option disabled selected>Select...</option>
                                            <option value="2">2 Years</option>
                                            <option value="3">3 Years</option>
                                            <option value="4">4 Years</option>
                                            <option value="5">5 Years</option>
                                            <option value="6">6 Years</option>
                                            <option value="8">8 Years</option>
                                        </select>
                                    </div>
                                    <div class="form-group my-3">
                                        <label class="dashboard-label">Program's level</label>
                                        <select name="degree" class="form-control">
                                            <option selected disabled>Select...</option>
                                            <option value="undergraduate">Undergraduate</option>
                                            <option value="graduate">Graduate</option>
                                        </select>
                                    </div>
                                    <div class="form-group my-3">
                                        <label class="dashboard-label">Language</label>
                                        <select name="language" class="form-control">
                                            <option selected disabled>Select...</option>
                                            <option value="Turkish">Turkish</option>
                                            <option value="English">English</option>
                                            <option value="Arabic">Arabic</option>
                                        </select>
                                    </div>
                                    <div class="form-group my-3">
                                        <label class="dashboard-label">Program's fees</label>
                                        <input type="text" name="fees" class="form-control" id="fees" aria-label="fees">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="quota" class="dashboard-label">Quota</label>
                                        <input type="text" name="quota" class="form-control" id="quota" aria-label="quota">
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="dashboard-label">Preview Images</label>
                                        <input type="file" name="image[]" class="form-control" id="image" multiple>
                                    </div>
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
        <div class="modal fade" id="mymodal1" tabindex="-1" aria-labelledby="example" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="mymodal1">Update Program Form</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="edit_data" value="true">
                            <div class="form-group mb-3">
                                <label for="name" class="dashboard-label">Program's Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-label="name" value="<?php
                                                                                                                        echo $rowss['name'];
                                                                                                                        ?>">
                            </div>
                            <div class="form-group my-3">
                                <label for="" class="dashboard-label">Description</label>
                                <textarea name="description" id="description" class="form-control" style="height:auto;"><?php
                                                                                                                        echo $rowss['description'];
                                                                                                                        ?></textarea>
                            </div>
                            <div class="form-group my-3">
                                <label class="dashboard-label">Program's Years</label>
                                <select name="years" class="form-control" aria-label="years">
                                    <option value="2" <?php if ($rowss['years'] == 2) echo 'selected'; ?>>2 Years</option>
                                    <option value="3" <?php if ($rowss['years'] == 3) echo 'selected'; ?>>3 Years</option>
                                    <option value="4" <?php if ($rowss['years'] == 4) echo 'selected'; ?>>4 Years</option>
                                    <option value="5" <?php if ($rowss['years'] == 5) echo 'selected'; ?>>5 Years</option>
                                    <option value="6" <?php if ($rowss['years'] == 6) echo 'selected'; ?>>6 Years</option>
                                    <option value="8" <?php if ($rowss['years'] == 8) echo 'selected'; ?>>8 Years</option>
                                </select>
                            </div>
                            <div class="form-group my-3">
                                <label class="dashboard-label">Program's level</label>
                                <select name="degree" class="form-control">
                                    <option value="undergraduate" <?php if ($rowss['degree'] == 'undergraduate') echo 'selected'; ?>>Undergraduate</option>
                                    <option value="graduate" <?php if ($rowss['degree'] == 'graduate') echo 'selected'; ?>>Graduate</option>
                                </select>
                            </div>
                            <div class="form-group my-3">
                                <label class="dashboard-label">Language</label>
                                <select name="language" class="form-control">
                                    <option value="Turkish" <?php if ($rowss['language'] == 'Turkish') echo 'selected'; ?>>Turkish</option>
                                    <option value="English" <?php if ($rowss['language'] == 'English') echo 'selected'; ?>>English</option>
                                    <option value="Arabic" <?php if ($rowss['language'] == 'Arabic') echo 'selected'; ?>>Arabic</option>
                                </select>
                            </div>
                            <div class="form-group my-3">
                                        <label class="dashboard-label">Program's fees</label>
                                        <input type="text" name="fees" class="form-control" id="fees" aria-label="fees" value="<?php echo $rowss['fees']; ?>">
                                    </div>
                            <div class="form-group mb-3">
                                <label for="quota" class="dashboard-label">Quota</label>
                                <input type="text" name="quota" class="form-control" id="quota" aria-label="quota" value="<?php
                                                                                                                            echo $rowss['quota'];
                                                                                                                            ?>">
                            </div>
                            <div class="">
                                <button type="button" id="photoModalBtn" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#photoModal">Change Pictures</button>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit_data" class="btn edit-btn">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Show Images</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" method="post">
                        <input type="hidden" name="edit_photo" value="true">

                            <label for="image" class="dashboard-label">Select Images</label>
                            <input type="file" name="image[]" id="image" class="form-control" multiple>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-target="#mymodal1" data-bs-toggle="modal">Back</button>
                        <button type="submit" class="btn edit-btn" name="edit_photo">Apply</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#mymodal1').modal('show');
            });
            $(document).ready(function() {
                // Show second modal when the photo button is clicked
                $('#photoModalBtn').on('click', function() {
                    $('#photoModal').modal('show');
                });

                // Optional: Prevent the first modal from closing when the second modal is open
                $('#photoModal').on('show.bs.modal', function() {
                    $('#mymodal1').modal('hide');
                });

                // Optional: Restore the first modal when the second modal is closed
                $('#photoModal').on('hidden.bs.modal', function() {
                    $('#mymodal1').modal('show');
                });
            });
        </script>
</body>

</html>