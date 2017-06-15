<?php

require_once "../utils.php";
confirmUserHasLogin();

if (! isset($_GET["id"])) {
    header("location: /index.html");
}

require_once "../db.php";
require_once "../logger.php";

$id = $_GET["id"];
$conn = mysqli_connect_database();
$query = "select * from user where id='$id'";
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

