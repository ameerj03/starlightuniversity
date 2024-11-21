<?php
require 'vendor/autoload.php';

$cachekey = "user_1_data";
$cacheTTL = 3600;

if($bit->exists($cachekey)){
    $userdata = $bit->get($cachekey);
    echo "DATA RETRIVED FROM CACHE".$userdata;
}
else{
    $conn = new mysqli("localhost", "username", "password", "database");
    $result = $conn->query("SELECT * FROM user WHERE id=?");
    $user = $result->fetch_assoc();
    $userdata = json_encode($user);
}

?>