<?php
$output_dir = "uploads/";
$fileCount  = count($_FILES["img"]["name"]);

for($i = 0; $i<$fileCount; $i++){
    $randomNum = time();
    $imageName = str_replace('', '-', strtolower($_FILES["img"]["name"][$i]));

    $imageType = $_FILES["img"]["name"][$i];
    $imageExt = substr($imageName, strrpos($imageName, '.'));
    $imageExt = str_replace('.', '', $imageExt);

        $imageName = preg_replace("/\.[^\s]{3,4}$/" , "", $imageName);

        $newImageName = $imageName .'-'. $randomNum . '.' . $imageExt;

        $result["$newImageName"] = $output_dir . $newImageName;

        if(!file_exists($output_dir . $last_id)){
            @mkdir($output_dir . $last_id, 0777 , TRUE);
        }
        move_uploaded_file($_FILES["img"]["tmp_name"][$i], $output_dir . $last_id . "/" . $newImageName );
}
echo "done";
?>