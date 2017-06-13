<!DOCTYPE html>
<html>
<head>
    <title>Login...</title>
    <script type="text/javascript" src="static/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<?php

require_once "utils.php";
if (userHasLogin()) {
    header("location: /post.php");
}

?>
Username: <input type="text" id="username" />
<br />
Password: <input type="password" id="password" />
<br />
<input type="submit" onclick="checkAndSendLoginInfo()" />

<script type="text/javascript">
    function checkAndSendLoginInfo() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        if (username == "" || password == "") {
            alert("Username or Password empty!");
            return;
        }

        data = {
            "username": username,
            "password": password,
        }

        $.post("login.php", data, function(resp, status) {
            if (resp == "OK" && status == "success") {
                window.location = "post.php";
            } else {
                alert(status + ": " + resp);
            }
        });
    }
</script>
</body>
</html>