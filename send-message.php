<?php
// Database connection
include "action.php";

$receiver_id = $_POST['receiver'];
$sender_id = $_POST['sender_id'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$phone_cleaned = str_replace(' ', '', $phone);
$subject=$_POST['subject'];
$receiver=$_POST['receiver'];
$text = $_POST['text'];

$add_user = "INSERT INTO message(name, lastname, email, phone, subject, receiver, sender, text) 
VALUES ('$name', '$lastname', '$email', '$phone_cleaned', '$subject', '$receiver_id', $sender_id, '$text')";

if($conn->query($add_user) === TRUE){
    header("Location: contact.php?status=message_sent");
}
else{
    header("Location: contact.php?status=message_error");
}