<?php

if (! isset($_POST["username"])) {
    header("location: /index.php");
}

$username = $_POST["username"];
$password = $_POST["password"];

require_once "../db.php";
require_once "../logger.php";

$conn = mysqli_connect_database();
$query = "select * from user where username='$username'";
Logger::GetLogger()->write($query);
$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

if ($result->num_rows != 1) {
    die("multi username or Username not exist.");
}

$user = $result->fetch_array(MYSQL_ASSOC);
if ($user["active"] != 1) {
    die("User not active");
}

if ($user["password"] != $password) {
    die("password not correct");
}

session_start();
$_SESSION["username"] = $username;
$_SESSION["password"] = $password;
$_SESSION["user_id"] = $user["id"];
$_SESSION["role"] = $user["role"];

$result->close();
$conn->close();

echo "OK";

?>