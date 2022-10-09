<?php

$name = $_POST['name'];
$price = $_POST['price'];
$place = $_POST['place'];

$img_name = "img/Preview-icon.png";

if($_FILES['img_upload']['name'] != "" ){
    $img_name = "img/".time()." ".$_FILES['img_upload']['name'];
	$tmp_img_name=$_FILES['img_upload']['tmp_name'];
	move_uploaded_file($tmp_img_name,$img_name);
}
$host = "localhost";
$dbname = "test";
$username = "root";
$password = "";
        
$conn = mysqli_connect(hostname: $host,
                       username: $username,
                       password: $password,
                       database: $dbname);

if(mysqli_connect_errno()){
    die("Error connecting to database: " . mysqli_connect_errno());
}

     
$sql = "INSERT INTO `warehouse` (`name`, `price`, `place`, `img` ) VALUES (?, ?, ?,?)";

$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)) {
 
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "siss",
                       $name,
                       $price,
                       $place,
                       $img_name);
mysqli_stmt_execute($stmt);

header("Location: http://localhost/warehouse/index.html");
exit();
