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
<button onclick="checkAndSendLoginInfo()">Login</button>
<button onclick="redirectToRegister()">Register</button>


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

        $.post("handler/login_handler.php", data, function(resp, status) {
            if (resp == "OK" && status == "success") {
                $.get("handler/get_user_info_handler.php?username=" + username, function (resp, status) {
                    if (status == "success") {
                        var data = JSON.parse(resp);
                        if (data["role"] == 1) {
                            window.location="manage.php";
                        }
                    } else {
                        window.location = "list.php";
                    }
                });
            } else {
                alert(status + ": " + resp);
            }
        });
    }

    function redirectToRegister() {
        window.location = "/register.php";
    }
</script>
</body>
</html>