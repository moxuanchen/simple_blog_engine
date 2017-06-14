<?php

require_once "../utils.php";
confirmUserHasLogin();

if (! isset($_GET["id"])) {
    header("location: /index.php");
}

$id = $_GET["id"];

require_once "../db.php";
require_once "../logger.php";

$conn = mysqli_connect_database();
$query = "select * from post where id='$id'";
Logger::GetLogger()->write($query);
$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

$data = $result->fetch_array(MYSQL_ASSOC);

$data = [
    "title" => $data["title"],
    "content" => $data["content"],
    "id" => $id
];

$result->close();
$conn->close();

echo json_encode($data);

?>