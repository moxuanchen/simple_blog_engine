<?php

require_once "utils.php";
confirmUserHasLogin();

require_once "db.php";
require_once "logger.php";

if (! isset($_GET["id"])) {
    header("location: /list.php");
}

$id = $_GET["id"];

$conn = mysqli_connect_database();
$query = "select * from post where id='$id'";
Logger::GetLogger()->write($query);
$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

$row = $result->fetch_array(MYSQL_ASSOC);

$title = $row["title"];
$content = $row["content"];
$create_at = $row["create_at"];
$result->close();

$query = "select * from comment where post_id='$id'";
Logger::GetLogger()->write($query);
$result = $conn->query($query);
if (! $result) {
    die($conn->error);
}

$all_comments = "";
$num_rows = $result->num_rows;
for ($i = 0; $i < $num_rows; $i ++) {
    $result->data_seek($i);
    $data = $result->fetch_array(MYSQL_ASSOC);
    $all_comments .= $data["content"] . "<br />";
}

$html_body = <<< _END
<!DOCTYPE html>
<html>
<head>
    <title>$title</title>
    <script type="text/javascript" src="static/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<h1 align="center">$title</h1>
<div align="center">
$content
</div>
<p align="right">$create_at</p>
<div id="comments">
<p> All comments: </p>
<hr />
$all_comments
<hr />
</div>
<p>Comment: </p>
<textarea rows="20", cols="100" id="comment"></textarea>
<p><input type="submit" onclick="checkAndSendComment()"></input></p>
<script type="application/javascript">
    function getPostId() {
        args = window.location.search;
        return args.split("=")[1];
    }

    function checkAndSendComment() {
        var comment = document.getElementById("comment").value;
        if (comment == "") {
            alert("comment empty!");
            return;
        }
        data = {
            "id": getPostId(),
            "comment": comment,
        }

        $.post("handler/comment_handler.php", data, function (resp, status) {
            if (resp == "OK" && status == "success") {
                window.location = window.location.href;
            } else {
                alert(status + ": " + resp);
            }
        });
    }
</script>

</body>
</html>
_END;

$result->close();
$conn->close();

echo $html_body;

?>