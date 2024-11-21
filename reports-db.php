<?php
include "action.php";

session_start();
$user_id = $_SESSION['id'];
$user_name = $_SESSION['name'];
$user_lastname = $_SESSION['lastname'];
$user_role = $_SESSION['role'];

if ($user_role != 'admin') {
    header("Location: index.php");
    exit();
}

$select_users = "SELECT * FROM user";
$select_applications = "SELECT * FROM application";
$select_users_nationality = "SELECT nationality FROM application";
$select_accepted_users_nationality = "SELECT nationality FROM application WHERE fin_status = 'paid'";
$select_accepted_applications = "SELECT * FROM application WHERE status = 'accepted'";
$select_pending_applications = "SELECT * FROM application WHERE status = 'pending'";
$select_programs = "SELECT * FROM program";
$select_messages = "SELECT * FROM message WHERE receiver = $user_id";
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/afe390969e.js" crossorigin="anonymous"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
        </script>
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
        <a href="messages-db.php"> <i class="fa-solid fa-envelope"></i> Messages</a>
        <a href="applications-db.php"> <i class="fa-solid fa-clipboard-list"></i> Applications</a>
        <a href="notifications-db.php"> <i class="fa-solid fa-bell"></i> Notifications</a>
        <h6 class="pt-4 ps-2 ms-2 text-uppercase text-xs subjects font-weight-bolder opacity-6"> Stats </h6>
        <a class="active" href="reports-db.php"> <i class="fa-solid fa-chart-simple"></i> Reports</a>
    </div>

    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
        <div class="container my-3">
            <div class="row">
                <div class="col-sm-3 ">
                    <div class="card p-3 d-flex">
                        <div class="d-flex align-items-baseline">
                            <i class="fa-solid fa-table-list fa-lg"></i>
                            <h5 class="ms-2">Total Applications</h5>

                        </div>
                        <h5>15</h5>
                        <div class="strip p-0 mt-auto rounded-bottom">

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card p-3 d-flex">
                        <div class="d-flex align-items-baseline">
                            <i class="fa-solid fa-check fa-lg"></i>
                            <h5 class="ms-2">Accepted Applications</h5>

                        </div>
                        <h5>15</h5>
                        <div class="strip p-0 mt-auto rounded-bottom">

                        </div>
                    </div>
                </div>
                <div class="col-sm-3 ">
                    <div class="card p-3 d-flex">
                        <div class="d-flex align-items-baseline">
                            <i class="fa-solid fa-money-bill fa-lg"></i>
                            <h5 class="ms-2">Paid Applications</h5>

                        </div>
                        <h5>15</h5>
                        <div class="strip p-0 mt-auto rounded-bottom">

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card p-3 d-flex">
                        <div class="d-flex align-items-baseline">
                            <i class="fa-solid fa-dollar-sign fa-lg"></i>
                            <h5 class="ms-2">Total Paid Amount</h5>

                        </div>
                        <h5>15</h5>
                        <div class="strip p-0 mt-auto rounded-bottom">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-3 ">
            <div class="row d-flex justify-content-between px-3">
                <div class="col-sm-8 card p-3">
                <p class="text-center mt-2" style="font-weight: bold; font-family: sans-serif; color:dimgray">Accepted Applications By Country</p>
                    <canvas id="chartS1" class="w-100"></canvas>
                </div>
                <div class="col-sm-4 card p-3 d-flex" style="width: 32%;">
                    <p class="text-center mt-2" style="font-weight: bold; font-family: sans-serif; color:dimgray">Accepted Applications By Gender</p>
                    <hr class="mt-0">
                    <canvas id="chartS2" class="w-100 m-auto "></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
        const xValues = [];
        const countries = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burundi", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "North Korea", "South Korea", "Kosovo", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Lithuania", "Luxembourg", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", , "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Tajikistan", "Tanzania", "Thailand", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"];
        for (let i = 0; i < 26; i++) {
            xValues.push(countries[Math.floor(Math.random() * countries.length)]);
        }
        const yValues = [];
        for (let i = 0; i < 26; i++) {
            yValues.push(Math.floor(Math.random() * 100) + 1);
        }

        const barColors = [
            "#4CAF50", // Green
            "#FF9800", // Orange
            "#2196F3", // Blue
            "#FF5722", // Deep Orange
            "#9C27B0", // Purple
            "#FFC107", // Amber
            "#03A9F4", // Light Blue
            "#E91E63", // Pink
            "#8BC34A", // Light Green
            "#FFEB3B", // Yellow
            "#673AB7", // Indigo
            "#00BCD4", // Cyan
            "#CDDC39", // Lime
            "#FF4081", // Bright Pink
            "#795548", // Brown
            "#607D8B", // Blue Grey
            "#00E676", // Bright Green
            "#D500F9", // Bright Purple
            "#FFAB00", // Bright Amber
            "#304FFE" // Bright Blue
        ];

        new Chart("chartS1", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: false,
                    text: "Accepted applications by nationality"
                }
            }
        });
        ////////////////////////////////
        const xValues2 = ["A" , "B" ];

        const yValues2 = [1, 2];

        const barColors2 = [
    
    "#03A9F4", // Light Blue
    "#E91E63", // Pink

];

new Chart("chartS2", {
  type: "doughnut",
  data: {
    labels: xValues2,
    datasets: [{
      backgroundColor: barColors2,
      data: yValues2
    }]
  },
  options: {
    legend: {
         display: false   
        },
    title: {
      display: false,
      text: "Applications by Gender"
    }
  }
});
    </script>
</body>

</html>