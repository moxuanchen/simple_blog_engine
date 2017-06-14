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

function get_user_by_id($user_id) {
    $conn = mysqli_connect_database();
    $query = "select * from user where id='$user_id'";
    Logger::GetLogger()->write($query);
    $result = $conn->query($query);
    if (! $result) {
        die($conn->error);
    }

    if ($result->num_rows == 0) {
        return "anonymous";
    }

    $user = $result->fetch_array(MYSQL_ASSOC);
    $result->close();
    $conn->close();

    return $user["username"];

}

?>