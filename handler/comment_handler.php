<?php

require_once "../utils.php";
confirmUserHasLogin();

require_once "../db.php";
require_once "../logger.php";

if (! isset($_POST["id"])) {
    header("location: /index.php");
}

$id = $_POST["id"];
$comment = $_POST["comment"];

$conn = mysqli_connect_database();
$query = "insert into comment (post_id, content) values ('$id', '$comment')";
Logger::GetLogger()->write($query);
$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

$conn->close();

echo "OK";

?>