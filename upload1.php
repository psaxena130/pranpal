<?php
session_start();
$id=$_SESSION['id'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload1"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$conn=new mysqli("localhost","root","","pranpal");

$sql="SELECT * FROM media";
$r=$conn->query($sql);
while($r1=$r->fetch_assoc())
{
    $pid=$r1['med'];
}
$pid++;

$sql="DELETE FROM media";
$conn->query($sql);

$sql="INSERT INTO media VALUES($pid)";
$conn->query($sql);



// Check if image file is a actual image or fake image
/*if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}*/
// Check if file already exists
/*if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}*/
// Check file size
if ($_FILES["fileToUpload1"]["size"] > 100000000) {// 100000=100KB
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
$conn=new mysqli("localhost","root","","$id");
$sql="INSERT INTO media VALUES($pid,\"$imageFileType\")";
$conn->query($sql);
$target_file=$target_dir.$pid.".".$imageFileType;
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file)) {
        echo("<br><img src=".$target_file."><br>");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>