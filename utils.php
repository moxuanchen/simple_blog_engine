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

function confirmUserIsAdmin() {
    session_start();
    if (! isset($_SESSION["username"])) {
        header("location: /index.php");
    }

    if ($_SESSION["role"] != 1) {
        header("location: /index.php");
    }
}
?>