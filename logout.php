<?php

require_once "utils.php";
confirmUserHasLogin();

session_start();
$username = $_SESSION["username"];

$html_body = <<< _END
<!DOCTYPE html>
<html>
<head>
    <title>Logout...</title>
</head>
<body>
<h1>GoodBye: $username</h1>
<a href="index.php">Login</a>
</body>
</html>
_END;

echo $html_body;
session_destroy();


?>