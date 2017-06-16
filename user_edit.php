<?php

require_once "utils.php";
confirmUserHasLogin();

?>

<html>
<head>
    <title>User edit...</title>
    <script type="application/javascript" src="static/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="static/bootstrap/js/bootstrap.min.js"></script>
    <link href="static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<h1 id="edit_name">User Editing: </h1>
<form>
        Username: <input type="text" id="username" disabled/><br />
    Role:
    <select id="role">
        <option value="1">Admin</option>
        <option value="2">Author</option>
    </select>
    <br />Active:
    <select id="active">
        <option value="0">Freeze</option>
        <option value="1">Active</option>
    </select>
    <br />
    <input type="submit" id="submit" onclick="checkAndUpdateUserInfo()"/>
</form>
<script type="application/javascript">
    function get_user_id() {
        return window.location.search.split("=")[1];
    }

    window.onload = function () {
        var id = get_user_id();
        $.get("handler/get_user_info_handler.php?id=" + id, function (resp, status) {
            var user = JSON.parse(resp);
            var el_head = document.getElementById("edit_name");
            el_head.innerHTML = el_head.innerHTML + user["username"];

            document.getElementById("username").value = user["username"];
            var active_selector = document.getElementById("active");
            for (var i = 0; i < active_selector.options.length; i ++) {
                if (active_selector.options[i].value == user["active"]) {
                    active_selector.options[i].selected = true;
                    break;
                }
            }
            var role_selector = document.getElementById("role");
            for (var i = 0; i < role_selector.options.length; i ++) {
                if (role_selector.options[i].value == user["role"]) {
                    role_selector.options[i].selected = true;
                    break;
                }
            }
        });
    };
    
    function checkAndUpdateUserInfo() {
        var data = {
            "id": get_user_id(),
            "active": document.getElementById("active").value,
            "role": document.getElementById("role").value
        }

        $.post("handler/update_user_info_handler.php", data, function (resp, status) {
            if (resp == "OK" && status == "success") {
                window.location = "/manage.php";
            } else {
                alert(status + ": " + resp);
            }
        });
    }

</script>
</body>
</html>
