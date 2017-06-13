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

$conn = mysqli_connect_database();
$query = "select * from post where title='$title'";
Logger::GetLogger()->write($query);

$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

if ($result->num_rows > 0) {
    die("!!!Already had the same title!!!");
}

$result->close();

$query = "insert into post(title, content) values('$title', '$content')";
Logger::GetLogger()->write($query);
$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

$conn->close();

echo "OK";
?>