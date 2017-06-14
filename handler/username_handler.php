<?php

if (! isset($_POST["username"])) {
    header("location: /index.php");
}

$username = $_POST["username"];

require_once "../db.php";
require_once "../logger.php";

$conn = mysqli_connect_database();
$query = "select * from user where username='$username'";
Logger::GetLogger()->write($query);
$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

if ($result->num_rows != 0) {
    echo "FAILED";
}

$conn->close();
echo "OK";

?>
