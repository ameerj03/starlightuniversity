<?php
// Database connection
include "action.php";

if(isset($_SESSION['id'])){
header("Location: profile.php");
}
else{
    echo 'error';
}


?>
