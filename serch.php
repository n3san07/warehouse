<?php


if (isset($_POST['serch'])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";
    $arr = [];
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

    $serch = $_POST['serch'];

$sql = "SELECT * FROM `warehouse` WHERE (`name` LIKE '$serch') OR (`price` LIKE '$serch')OR (`place` LIKE '$serch')";
$result = $conn->query($sql);
while ($obj = mysqli_fetch_assoc($result)) {
    $arr[] = $obj;
}
echo json_encode($arr);
$conn->close();

  }


?>