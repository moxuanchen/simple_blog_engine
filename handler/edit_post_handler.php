<?php

require_once "../utils.php";
confirmUserHasLogin();

if (! isset($_POST["title"])) {
    header("location: /index.php");
}

$id = $_POST["id"];
$title = $_POST["title"];
$content = $_POST["content"];

require_once "../db.php";
require_once "../logger.php";

$conn = mysqli_connect_database();
$curr_date = date("Y-m-d h:i:s");
$query = "update post set title='$title', content='$content', create_at='$curr_date' where id='$id'";
Logger::GetLogger()->write($query);
$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

$conn->close();

echo "OK";

?>