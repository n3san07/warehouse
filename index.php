<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$arr = [];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

  $sql = "SELECT * FROM `warehouse`";


$result = $conn->query($sql);

  // output data of each row
  while ($obj = mysqli_fetch_assoc($result)) {
    $arr[] = $obj;
}
echo json_encode($arr);
$conn->close();


?>
