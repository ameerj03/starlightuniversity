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
    <link rel="stylesheet" href="css/programs.css">
    <title>Programs | Starlight University</title>
</head>

<body style="background-color: #D4F1F4;">

    <!-- Navbar -->
    <?php
    include "frontend/layout/navbar.php"
    ?>
    <!-- End Navbar -->

    <!-- Main content -->
    <div class="container my-5">
        <div>

            <h1 class="text-center">Starlight University's Programs</h1>
            <div class="search-filter d-block mx-auto  mb-5 mt-4" style="max-width: 1080px;">
                <div class="input-group mx-auto">
                    <input type="search" name="search" id="searchBar" placeholder="Search" class=" rounded-start form-control w-50 mx-auto">
                    <button class="btn rounded-end border border-start-0 bg-white" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>


                    <button class="btn edit-btn ms-4 m-0 rounded-start border border-end" id="undergraduate-button">Undergraduate</button>
                    <button class="btn edit-btn m-0  rounded-end border border-start" id="graduate-button">Graduate</button>

                    <button class="rounded-circle h-100 btn border-0 mx-4" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa-solid fa-filter"></i></button>
                    <div class="dropdown-menu" aria-labelledby="filterButton">
                        <div class="p-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexCheck">
                                <label class="form-check-label" style="font-weight: 500;" for="flexCheck">Show only available programs</label>
                            </div>
                        </div>
                        <div class="p-2 years-select">
                            <label style="font-weight: 500;" for="">Program Years</label>
                            <br>
                            <div class="checkbox-wrapper-13">
                                <input id="c1-13" type="checkbox" required class="d-inline" value="2">
                                <label for="c1-13">2 Years</label>
                            </div>
                            <div class="checkbox-wrapper-13">
                                <input id="c1-14" type="checkbox" required class="d-inline" value="3">
                                <label for="c1-14">3 Years</label>
                            </div>
                            <div class="checkbox-wrapper-13">
                                <input id="c1-15" type="checkbox" required class="d-inline" value="4">
                                <label for="c1-15">4 Years</label>
                            </div>
                            <div class="checkbox-wrapper-13">
                                <input id="c1-16" type="checkbox" required class="d-inline" value="5">
                                <label for="c1-16">5 Years</label>
                            </div>
                            <div class="checkbox-wrapper-13">
                                <input id="c1-17" type="checkbox" required class="d-inline" value="6">
                                <label for="c1-17">6 Years</label>
                            </div>
                            <div class="checkbox-wrapper-13">
                                <input id="c1-18" type="checkbox" required class="d-inline" value="8">
                                <label for="c1-18">8 Years</label>
                            </div>


                        </div>
                        <div class="p-2 language-select">
                            <label style="font-weight: 500;" for="">Program Language</label>

                            <div class="checkbox-wrapper-13">
                                <input id="c1-19" type="checkbox" required class="d-inline" value="english">
                                <label for="c1-19">English</label>
                            </div>
                            <div class="checkbox-wrapper-13">
                                <input id="c1-20" type="checkbox" required class="d-inline" value="turkish">
                                <label for="c1-20">Turkish</label>
                            </div>
                            <div class="checkbox-wrapper-13">
                                <input id="c1-21" type="checkbox" required class="d-inline" value="arabic">
                                <label for="c1-21">Arabic</label>
                            </div>
                        </div>
                        <div class="d-flex"><button type="button" id="apply-filters" class="btn edit-btn btn-sm ms-auto">Apply</button>

                        </div>
                    </div>

                </div>
            </div>


            <?php
            include "action.php";

            $view = "SELECT id, name, years, degree, remaining_quota, quota, language FROM program WHERE degree = 'undergraduate'";
            $view_query = $conn->query($view);
            if ($view_query->num_rows > 0) {
                while ($row = $view_query->fetch_assoc()) {
                    if ($row['remaining_quota'] > 0) {
                        echo '<div class="card shadow-sm mb-3 programs ' . $row['degree'] . '" style="max-width: 1080px;">';
                        echo '<div class="row g-0">';
                        echo '<div class="col-md-12">';
                        echo '<div class="card-body">';
                        echo '<div class="d-flex justify-content-between align-items-center">';
                        echo '<h5 class="card-title mb-0 programName">' . $row['name'] . ' (' . $row['language'] . ')' . '</h5>';
                        echo '<p class="d-none language">' . $row['language'] . '</p>';
                        echo '<span class="badge rounded-pill bg-success">Available</span>';
                        echo '</div>';
                        echo '<p class="card-text m-0">' . ucfirst($row['degree']) . '</p>';
                        echo '<a href="program-view.php?num=' . $row['id'] . '" class=" stretched-link"></a>';
                        echo '<p class="card-text years m-0">' . $row['years'] . ' Years</p>';
                        echo '<p class="card-text"><small class="text-body-secondary">' . $row['remaining_quota'] . '/' . $row['quota'] . ' Remaining' . '</small></p>';

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="card shadow-sm mb-3 programs ' . $row['degree'] . '" style="max-width: 1080px;">';
                        echo '<div class="row g-0">';
                        echo '<div class="col-md-12">';
                        echo '<div class="card-body">';
                        echo '<div class="d-flex justify-content-between align-items-center">';
                        echo '<h5 class="card-title mb-0 programName">' . $row['name'] . ' (' . $row['language'] . ')' . '</h5>';
                        echo '<p class="d-none language">' . $row['language'] . '</p>';
                        echo '<span class="badge rounded-pill bg-danger">Unavailable</span>';
                        echo '</div>';
                        echo '<p class="card-text m-0">' . ucfirst($row['degree']) . '</p>';
                        echo '<a href="program-view.php?num=' . $row['id'] . '" class=" stretched-link"></a>';
                        echo '<p class="card-text years m-0">' . $row['years'] . ' Years</p>';
                        echo '<p class="card-text"><small class="text-body-secondary">' . $row['remaining_quota'] . '/' . $row['quota'] . ' Remaining' . '</small></p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }
            ?>

            <?php
            $view_g = "SELECT id, name, years, degree, remaining_quota, quota, language FROM program WHERE degree = 'graduate'";
            $view_query_g = $conn->query($view_g);
            if ($view_query_g->num_rows > 0) {
                while ($row = $view_query_g->fetch_assoc()) {
                    if ($row['quota'] > 0) {
                        echo '<div class="card shadow-sm mb-3 programs ' . $row['degree'] . '" style="max-width: 1080px;">';
                        echo '<div class="row g-0">';
                        echo '<div class="col-md-12">';
                        echo '<div class="card-body">';
                        echo '<div class="d-flex justify-content-between align-items-center">';
                        echo '<h5 class="card-title mb-0 programName">' . $row['name'] . ' (' . $row['language'] . ')' . '</h5>';
                        echo '<p class="d-none language">' . $row['language'] . '</p>';
                        echo '<span class="badge rounded-pill bg-success">Available</span>';
                        echo '</div>';
                        echo '<p class="card-text m-0">' . ucfirst($row['degree']) . '</p>';
                        echo '<a href="program-view.php?num=' . $row['id'] . '" class=" stretched-link"></a>';
                        echo '<p class="card-text years m-0">' . $row['years'] . ' Years</p>';
                        echo '<p class="card-text"><small class="text-body-secondary">' . $row['remaining_quota'] . '/' . $row['quota'] . ' Remaining' . '</small></p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="card shadow-sm mb-3 programs ' . $row['degree'] . '" style="max-width: 540px;">';
                        echo '<div class="row g-0">';
                        echo '<div class="col-md-12">';
                        echo '<div class="card-body">';
                        echo '<div class="d-flex justify-content-between align-items-center">';
                        echo '<h5 class="card-title mb-0 programName">' . $row['name'] . ' (' . $row['language'] . ')' . '</h5>';
                        echo '<p class="d-none language">' . $row['language'] . '</p>';
                        echo '<span class="badge rounded-pill bg-danger">Unavailable</span>';
                        echo '</div>';
                        echo '<p class="card-text m-0">' . ucfirst($row['degree']) . '</p>';
                        echo '<a href="program-view.php?num=' . $row['id'] . '" class=" stretched-link"></a>';
                        echo '<p class="card-text years m-0">' . $row['years'] . ' Years</p>';
                        echo '<p class="card-text"><small class="text-body-secondary">' . $row['remaining_quota'] . '/' . $row['quota'] . ' Remaining' . '</small></p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }
            ?>
            <!-- No results -->
            <div id="no-results" class="card shadow-sm mb-3 programs" style="max-width: 1080px; height:130px; display:none;">
                <div class="card-body">
                    <h5 class="card-title">No results to your search</h5>
                    <p class="card-text">Please try again with different keywords.</p>
                </div>
            </div>
            <!-- End of No results -->
        </div>
    </div>
    </div>
    <!-- Modal -->
    <div class="modal" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal -->
    <?php
    include 'frontend/api/firebase.php';
    ?>
    <script>
        function filterPrograms() {
            let programNames = document.querySelectorAll(".programs .programName");
            let searchResult = document.getElementById("searchBar").value.toLowerCase();
            let noResults = document.getElementById("no-results");
            let switchCheck = document.getElementById("flexCheck");
            let checksYears = document.querySelectorAll(".years-select .checkbox-wrapper-13 input[type='checkbox']");
            let checksLanguage = document.querySelectorAll(".language-select .checkbox-wrapper-13 input[type='checkbox']");
            let undergraduateActive = document.getElementById("undergraduate-button").classList.contains("active");
            let graduateActive = document.getElementById("graduate-button").classList.contains("active");

            noResults.style.display = "none";
            let shownPrograms = 0;

            programNames.forEach(function(name) {
                let show = false;
                let program = name.closest(".programs");


                if (name.textContent.toLowerCase().includes(searchResult)) {
                    show = true;
                } else {
                    show = false;
                }


                let programYear = parseInt(program.querySelector(".years").textContent);
                let yearsChecked = Array.from(checksYears).some(checkbox => checkbox.checked);
                if (yearsChecked) {
                    let matchingYear = Array.from(checksYears).some(checkbox => checkbox.checked && parseInt(checkbox.value) === programYear);
                    if (!matchingYear) show = false;
                }


                let programLanguage = program.querySelector(".language").textContent.toLowerCase();
                let languageChecked = Array.from(checksLanguage).some(checkbox => checkbox.checked);
                if (languageChecked) {
                    let matchingLanguage = Array.from(checksLanguage).some(checkbox => checkbox.checked && checkbox.value.toLowerCase() === programLanguage);
                    if (!matchingLanguage) show = false;
                }


                let programState = program.querySelector(".badge").textContent.toLowerCase();
                if (switchCheck.checked && programState === "unavailable") {
                    show = false;
                }


                if (undergraduateActive && graduateActive) {

                    show = true;
                } else {
                    let isUndergraduate = program.classList.contains("undergraduate");
                    let isGraduate = program.classList.contains("graduate");

                    if (undergraduateActive && !isUndergraduate) show = false;
                    if (graduateActive && !isGraduate) show = false;
                }


                if (show) {
                    program.style.display = "block";
                    shownPrograms++;
                } else {
                    program.style.display = "none";
                }
            });


            noResults.style.display = (shownPrograms === 0) ? "block" : "none";
        }

        document.getElementById('apply-filters').addEventListener('click', filterPrograms);
        document.getElementById('searchBar').addEventListener('input', filterPrograms);
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("undergraduate-button").addEventListener("click", function() {
                this.classList.toggle("active");
                filterPrograms();
            });

            document.getElementById("graduate-button").addEventListener("click", function() {
                this.classList.toggle("active");
                filterPrograms();
            });
        });
    </script>



</body>
<!-- Footer -->
<footer>
    <?php
    include "frontend/layout/footer.php";
    ?>
</footer>
<!-- End Footer -->

</html>