<?php
include "action.php";


$name = $_POST['name'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
$role = "student";
$degree = $_POST['degree'];

// Check for duplicate email
$check_email_query = "SELECT * FROM user WHERE email='$email'";
$result_email = $conn->query($check_email_query);

if ($result_email->num_rows == 1) {
    
    header("Location: register.php?error=email_exists");
    exit();
}


// Insert new user into database
$insert = "INSERT INTO user (name, lastname, gender, email, phone, password, role, degree) VALUES ('$name','$lastname','$gender','$email', '$phone' ,'$hashed_password','$role','$degree')";

if ($conn->query($insert) === TRUE) {
    // Registration successful
    header("Location: login.php?status=registration_successful");
    exit();
} else {
    // Registration failed
    header("Location: register.php?error=registration_failed");
    exit();
}

// Close connection
$conn->close();
?>