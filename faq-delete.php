<?php
include "action.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    
    $stmt = $conn->prepare("DELETE FROM faq WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: faqs-db.php');
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID not set.";
}

$conn->close();
?>