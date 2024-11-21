<?php

include "action.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Program details
    $name = $_POST['name'];
    $years = $_POST['years'];
    $degree = $_POST['degree'];
    $quota = $_POST['quota'];
    $language = $_POST['language'];
    $description = $_POST['description'];
    $fees = $_POST['fees'];

    
    $add_program = "INSERT INTO program (name, years, degree, quota, remaining_quota, language, description, fees) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($add_program);
    $stmt->bind_param("ssssssss", $name, $years, $degree, $quota, $quota, $language, $description, $fees);

    

    if ($stmt->execute()) {
        
        $entityId = $conn->insert_id;

        
        $target_dir = "uploads/";

        

        foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
            $target_file = $target_dir . basename($_FILES["image"]["name"][$key]);
            $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($tmp_name);

            if ($check !== false) {
                if (move_uploaded_file($tmp_name, $target_file)) {
                    
                    $imageName = basename($_FILES["image"]["name"][$key]);
                    $sql = "INSERT INTO Images (entity_id, image_name, image_path) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("iss", $entityId, $imageName, $target_file);
                    $stmt->execute();
                } else {
                    echo "Error uploading image: " . $_FILES["image"]["name"][$key];
                }
            } else {
                echo "File is not an image: " . $_FILES["image"]["name"][$key];
            }
        }

       
        header("Location: programs-db.php");
    } else {
        echo "Error creating program.";
    }
}
?>
