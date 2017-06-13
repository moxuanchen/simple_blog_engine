<?php

function mysqli_connect_database()
{
    $DB_HOSTNAME = "localhost";
    $DB_USERNAME = "root";
    $DB_PASSWORD = "a1b2c3@A";
    $DB_DATABASE = "blog";

    $conn = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    if ($conn->connect_error) {
        die($conn->connect_error);
    }
    return $conn;
}

?>