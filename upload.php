<?php
$target_dir = "uploads/";
$orig_name=basename($_FILES["fileToUpload"]["name"]);
$fileName=uniqid().uniqid().".".end(explode(".",basename($_FILES["fileToUpload"]["name"])));

$data=json_decode(file_get_contents("views.json"),true);
$data[$fileName]=array(
    "views"=>0,
    "name"=>$orig_name
);
file_put_contents("views.json",json_encode($data));

$target_file = $target_dir . $fileName;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
        file_put_contents($target_file,"test");
    }
}
echo "<br><a href='/'>&larr; Home</a>";