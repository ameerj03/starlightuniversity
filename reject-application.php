<?php
include "action.php";

$id = $_POST['id'];
$status = $_POST['status'];
$user_id= $_POST['user_id'];



if($status!=='rejected'){
$approve = "UPDATE application SET status = 'rejected' WHERE id= $id";
$notification = "INSERT INTO notification(name, text, type, userto) VALUES ('Your application has failed to get approved.', 'Unfortunately, Your application has not been accepted, you can check the application panel for more info.','application', '$user_id')";
 if($conn->query($approve)===TRUE){
    header("Location: application-details.php?id=$id");
    mysqli_query($conn, $notification);
 }
 else{
    echo "ERROR";
 }
 



}
else{
    echo 'CANT DO THIS PROCCESS NOW, TRY AGAIN LATER';
}
?>
