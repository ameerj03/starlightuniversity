<?php
session_start();
include "action.php";

$id = $_POST['id'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$degree = $_POST['degree'];

$update = "UPDATE user SET name = '$name', lastname = '$lastname', email = '$email', gender = '$gender', degree = '$degree' WHERE id='$id'";

$update_query = $conn->query($update);
if ($update_query === TRUE) {
    $ameer = "SELECT id, name, lastname, gender, role, degree, password, phone, image FROM user WHERE id = '$id'";
    $queried = $conn->query($ameer);

    if ($queried->num_rows > 0) {
        $row = $queried->fetch_assoc();
        $_SESSION['email'] = $email; 
        $_SESSION['name'] = $row['name'];
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['degree'] = $row['degree'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['image'] = $row['image'];
    }
    header('Location: profile.php');
} else {
    echo "error";
}
?>
