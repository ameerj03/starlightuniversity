<?
include "action.php";

$name = $_POST['subject_name'];

$insert= "INSERT INTO faqs_subjects(name) VALUES ('$name')";
mysqli_query($conn, $insert);
header("Location: faqs-db.php")

?>