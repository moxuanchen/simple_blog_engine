<?php

require_once "logger.php";
require_once "db.php";

$logger = new Logger();

$title = $_POST["title"];
$content = $_POST["content"];

$conn = mysqli_connect_database();
$query = "select * from post where title='$title'";
$logger->write($query);

$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

if ($result->num_rows > 0) {
    die("!!!Already had the same title!!!");
}

$result->close();

$query = "insert into post(title, content) values('$title', '$content')";
$logger->write($query);
$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

$conn->close();

echo "OK";
?>