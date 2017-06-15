<?php

require_once "../utils.php";
confirmUserHasLogin();

if (! isset($_GET["id"]) && ! isset($_GET["username"])) {
    header("location: /index.html");
}

require_once "../db.php";
require_once "../logger.php";

$conn = mysqli_connect_database();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "select * from user where id=$id";
} else if (isset($_GET["username"])) {
    $username = $_GET["username"];
    $query = "select * from user where username='$username'";
}
Logger::GetLogger()->write($query);
$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

$num_rows = $result->num_rows;
if ($num_rows != 1) {
    die("System error.");
}

$user = $result->fetch_array(MYSQL_ASSOC);
$result->close();
$conn->close();

$data = [
    "username" => $user["username"],
    "active" => $user["active"],
    "role" => $user["role"]
];

echo json_encode($data);

?>

