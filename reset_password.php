<?php

include "action.php";



$user_id = 14;
$new_password = "ameer";
$hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

// Update the password for user with ID 14
$sql = "UPDATE user SET password = '$hashed_password' WHERE id = $user_id";

if ($conn->query($sql) === TRUE) {
    echo "Password reset successfully.";
} else {
    echo "Error updating password: " . $conn->error;
}

// Close the connection
$conn->close();
?>
