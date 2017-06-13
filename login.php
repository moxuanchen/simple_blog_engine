<?php

require_once "utils.php";
denyUserDirectAccess();

$username = $_POST["username"];
$password = $_POST["password"];

if ($username != "admin" || $password != "123456") {
    die("Username or Password not correct");
}

session_start();
$_SESSION["username"] = $username;
$_SESSION["password"] = $password;
echo "OK";

?>