<?php

require_once "utils.php";
confirmUserHasLogin();

require_once "db.php";
require_once "logger.php";

function get_all_posts()
{
    $posts = "";
    $user_id = $_SESSION["user_id"];
    $conn = mysqli_connect_database();
    $query = "select * from post";
    Logger::GetLogger()->write($query);
    if ($_SESSION["role"] != 1) {
        $query .= " where user_id='$user_id'";
    }
    $result = $conn->query($query);
    if (! $result) {
        die($conn->error);
    }

    $rows = $result->num_rows;

    for ($i = 0; $i < $rows; $i ++) {
        $result->data_seek($i);
        $data = $result->fetch_array(MYSQL_ASSOC);

        $id = $data["id"];
        $title = $data["title"];
        $username = $_SESSION["username"];

        if ($_SESSION["role"] == 1) {
            $username = get_user_by_id($data["user_id"]);
        }
        $item = <<< _END
<tr>
    <td><a href="/detail.php?id=$id">$title</a></td>
    <td>$username</td>
</tr>
_END;
        $posts .= $item;
    }
    $result->close();
    $conn->close();
    return $posts;
}

$blog_posts = get_all_posts();
$html_body = <<< _END
<!DOCTYPE html>
<html>
<head>
    <title>Blog post list...</title>
</head>
<body>
<h1>Blog Post List...</h1>
<div align="right">
    <a href="post.php">New Post</a>
    <a href="logout.php">Logout</a>
</div>
<table>
<tr>
    <th>Title</th>
    <th>Author</th>
</tr>
$blog_posts
</table>
</body>
</html>
_END;

echo $html_body;
?>