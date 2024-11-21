<?php
// Database connection
include "action.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize(($_FILES["image"]["tmp_name"]));

    if ($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

            $image = $target_file;
            $title = $_POST['title'];
            $text = $_POST['text'];





            $add_announcement = "INSERT INTO announcement(title, text, image) 
VALUES ('$title', '$text', '$image') ";

            if ($conn->query($add_announcement) === TRUE) {
                header("Location: announcement-db.php");
            } else {
                die("Connection Error or Error creating user");
            }
        }
    }
}
