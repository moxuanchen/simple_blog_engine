<?php

require_once "db.php";

$id = $_GET["id"];

$conn = mysqli_connect_database();
$query = "select * from post where id='$id'";
$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

$row = $result->fetch_array(MYSQL_ASSOC);

$title = $row["title"];
$content = $row["content"];
$create_at = $row["create_at"];

$html_body = <<< _END
<!DOCTYPE html>
<html>
<head>
    <title>$title</title>
</head>
<body>
<h1 align="center">$title</h1>
<div align="center">
$content
</div>
<p align="right">$create_at</p>
</body>
</html>
_END;

$result->close();
$conn->close();

echo $html_body;

?>