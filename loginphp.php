<?php
session_start();
include "action.php";

$email = $_GET['email'];
$pass = $_GET['password'];

$ameer = "SELECT * FROM user WHERE email = '$email'";
$queried = $conn->query($ameer);

if ($queried->num_rows > 0) {
    $row = $queried->fetch_assoc();
    if (password_verify($pass, $row['password'])) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['name'];
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['degree'] = $row['degree'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['image'] = $row['image'];


        
        if ($row['role'] === 'student') {
            header('Location: home.php?login'); 
        } else {
            header('Location: login-admin.php'); 
        }
        exit(); 
    } else {
        header("Location: login.php?error=invalid_credentials");
    exit();
    }
} else {
    header("Location: login.php?error=invalid_credentials");
    exit();
}

 
$conn->close();
?>