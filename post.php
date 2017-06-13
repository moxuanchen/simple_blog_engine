<!DOCTYPE html>

<html>
<head>
    <title>Send Post...</title>
    <script type="text/javascript" src="static/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<?php

require_once "utils.php";
confirmUserHasLogin();

?>
<div align="right">
    <a href="list.php">Browse Post</a>
    <a href="logout.php">Logout</a>
</div>
<div>
    <div id="log" style="color: red"></div>
    <p>Title: <input type="text" id="title" placeholder="Your post title here..."></p>
    <p>Content: </p>
    <textarea id="content" placeholder="Your post here..." rows="20", cols="100"></textarea>
    <p><input type="submit" id="submit" onclick="checkAndSendPost()"></input></p>
</div>

<script type="text/javascript">
    function writeLog(message) {
        var elog = document.getElementById("log");
        elog.innerHTML = message;
        $("#log").hide(30000, function() {
            elog.innerHTML = "";
            $("#log").show();
        });
    }

    function checkAndSendPost() {
        var title = document.getElementById("title").value;
        var content = document.getElementById("content").value;

        if (title == "" || content == "") {
            alert("title or content empty!!!");
            return;
        }

        data = {
            "title": title,
            "content": content
        }

        $.post("handler/post_handler.php", data, function(resp, status) {
            if (status == "success" && resp == "OK") {
                window.location = "/list.php";
            } else {
                writeLog(status + ": " + resp);
            }
        });
    }
</script>
</body>
</html>