<?php

require_once "utils.php";
denyUserDirectAccess();

require_once "db.php";
require_once "logger.php";

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