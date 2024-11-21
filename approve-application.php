<?php
include "action.php";

$id = $_POST['id'];
$status = $_POST['status'];
$program_id = $_POST['program_id'];
$user_id= $_POST['user_id'];


if($status!=='accepted'){
$approve = "UPDATE application SET status = 'accepted' WHERE id= $id";
$notification = "INSERT INTO notification(name, text, type, userto) VALUES ('Your application is approved!', 'Your application for the year 2024/2025 was approved, you can view more details from applicaions panel','application', '$user_id')";
$quota = "UPDATE program SET remaining_quota = remaining_quota - 1 WHERE id = '$program_id' AND remaining_quota > 0;";
$quotaInc = "UPDATE program SET used_quota = quota - remaining_quota  WHERE id = '$program_id'";
 if($conn->query($approve)===TRUE){
    mysqli_query($conn, $notification);
    mysqli_query($conn, $quota);
    header("Location: application-details.php?id=$id");
 }
 else{
    echo "ERROR";
 }
 



}
else{
    echo 'CANT DO THIS PROCCESS NOW, TRY AGAIN LATER';
}
?>
