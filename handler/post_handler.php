<?php

require_once "../utils.php";
confirmUserHasLogin();

require_once "../logger.php";
require_once "../db.php";

if (! isset($_POST["title"])) {
    header("location: /index.php");
}

$title = $_POST["title"];
$content = $_POST["content"];

$user_id = $_SESSION["user_id"];
$conn = mysqli_connect_database();
$query = "select * from post where title='$title' and user_id=$user_id";
Logger::GetLogger()->write($query);

$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

if ($result->num_rows > 0) {
    die("!!!Already had the same title!!!");
}

$result->close();

session_start();
$user_id = $_SESSION["user_id"];
$query = "insert into post(title, content, user_id) values('$title', '$content', '$user_id')";
Logger::GetLogger()->write($query);
$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

$conn->close();

echo "OK";
?>