<?php
// Database connection
include "action.php";

/*
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$nl = "$name"."$lastname";
$receiver = $_POST['receiver'];
$receiver_id = $_POST['id'];
$subject = $_POST['subject'];
$text = $_POST['text'];
*/

/*
$send = "INSERT INTO message(name, lastname, receiver, subject, text)
                     VALUES ('$name', '$lastname', '$receiver', '$subject', '$text' )";

mysqli_query($conn, $send);

$add_noti = "INSERT INTO notification(name, text, type, userfrom, userto)
                              VALUES ('Admin', '$text', 'message', '$nl', '$receiver_id')";
mysqli_query($conn, $add_noti);

*/

$receiver_id = $_POST['receiver'];
//$sender_id = $_POST['sender'];
$sender_id = '14';
$sender_name = 'Ameer Junaidi';
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$subject = $_POST['subject'];
$text = $_POST['text'];


$send_message = "INSERT INTO message(subject, text, receiver, name, lastname, sender) 
                 VALUES('$subject','$text','$receiver_id','$name','$lastname', '$sender_id')";

mysqli_query($conn, $send_message);

$send_notification = "INSERT INTO notification(name, text, type, userfrom, userfrom_name, userto) VALUES('$subject','$text', 'message' ,'$sender_id', '$sender_name' ,'$receiver_id')";

mysqli_query($conn, $send_notification);

header("Location: messages-db.php");

?>