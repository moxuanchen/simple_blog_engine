<?php

function confirmUserHasLogin() {
    session_start();
    if (! isset($_SESSION["username"])) {
        header("location: /index.php");
    }
}

function userHasLogin() {
    session_start();
    return isset($_SESSION["username"]);
}

function denyUserDirectAccess() {
    header("location: /index.php");
}

?>