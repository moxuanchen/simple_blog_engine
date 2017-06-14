<?php

require_once "utils.php";
confirmUserHasLogin();

require_once "db.php";

function get_all_posts()
{
    $posts = "";
    $user_id = $_SESSION["user_id"];
    $conn = mysqli_connect_database();
    $query = "select id, title from post";
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
        $posts = $posts . "<li><a href='/detail.php?id=" . $data["id"] . "'>" . $data["title"] . "</a></li>" . "\n";
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
<div>
<ul>
$blog_posts
</ul>
</div>
</body>
</html>
_END;

echo $html_body;
?>