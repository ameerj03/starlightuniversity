<?php
// Database connection
include "action.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $sql = "UPDATE users SET role = 'admin' WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        echo "User role updated successfully";
    } else {
        echo "Error updating user role: " . $conn->error;
    }
}

$conn->close();
header("Location: admin-db.php");
exit();
?>
