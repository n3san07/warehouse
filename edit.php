
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$place = $_POST['place'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "UPDATE `warehouse` SET `name`='$name',`place`='$place',`price`='$price' WHERE `id` = $id";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

?>