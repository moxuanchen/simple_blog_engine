<?php

require_once "../utils.php";
confirmUserHasLogin();

require_once "../db.php";

$conn = mysqli_connect_database();

$user_id = $_SESSION["user_id"];
$query = "select * from user where id='$user_id'";

if ($_SESSION["role"] == 1) {
    $query = "select * from user";
}

require_once "../logger.php";
Logger::GetLogger()->write($query);

$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

$info = [];
$num_rows = $result->num_rows;
for ($i = $j = 0; $i < $num_rows; $i ++) {
    $result->data_seek($i);
    $data = $result->fetch_array(MYSQL_ASSOC);
    $user = [
        "id" => $data["id"],
        "name" => $data["username"],
        "role" => $data["role"],
        "active" => $data["active"],
        "create_at" => $data["create_at"],
    ];
    array_push($info, $user);
}

$result->close();
$conn->close();

echo json_encode($info);

?>