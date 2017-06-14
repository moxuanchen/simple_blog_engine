<?php

require_once "../db.php";
require_once "../logger.php";

$username = $_POST["username"];
$password = $_POST["password"];

if ($username == "" || $password == "") {
    die("Username or Password empty.");
}

$conn = mysqli_connect_database();
$query = "insert into user (username, password, role) values ('$username', '$password', 2)";
Logger::GetLogger()->write($query);
$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

Logger::GetLogger()->write("Created a user: " . $username);
header("location: /index.php");

?>