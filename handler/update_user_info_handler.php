<?php

require_once "../utils.php";
confirmUserHasLogin();
confirmUserIsAdmin();

if (! isset($_POST["id"])) {
    header("location: /index.php");
}

$id = $_POST["id"];
$active = $_POST["active"];
$role = $_POST["role"];

require_once "../db.php";
require_once "../logger.php";

$conn = mysqli_connect_database();
$query = "update user set active=$active, role=$role where id=$id";
Logger::GetLogger()->write($query);

$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

$conn->close();

echo "OK";

?>