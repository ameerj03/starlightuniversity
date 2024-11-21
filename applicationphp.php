<?php
include "action.php";


$name = $_POST['name'];
$user_id = $_POST['user_id'];
$fathername = $_POST['fathername'];
$mothername = $_POST['mothername'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$nationality = $_POST['nationality'];
$id_no = $_POST['id_no'];
$phone = $_POST['phone'];
$program = $_POST['program'];
$year_graduated = $_POST['year_graduated'];
$address = $_POST['address'];
$status = 'pending';

$detect_id = "SELECT * FROM program WHERE name = '$program'";

$result = mysqli_query($conn, $detect_id);
$row = mysqli_fetch_assoc($result);
$program_id = $row['id'];


$stmt = $conn->prepare("INSERT INTO application (name, fathername, mothername, lastname, email, birthday, nationality, id_no, phone, program, program_id, year_graduated, address, gender, status, user_id)
 VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");


$stmt->bind_param("sssssssiisiisssi", $name, $fathername, $mothername, $lastname, $email, $birthday, $nationality, $id_no, $phone, $program, $program_id, $year_graduated, $address, $gender, $status, $user_id);

// Execute the statement
if ($stmt->execute()) {
    header("Location: home.php?status=application_submitted");
} else {
    header("Location: application.php?error=application_error");
}

// Close the statement
$stmt->close();

// Close the connection
$conn->close();
?>