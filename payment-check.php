<?php
include 'action.php';
$user_id = $_POST['user_id'];
$application_id = $_POST['application_id'];

$set = "UPDATE application SET fin_status = 'paid' WHERE id = '$application_id'";
mysqli_query($conn, $set);
mysqli_query($conn, $set_application);
header('Location: profile-financial.php');
?>