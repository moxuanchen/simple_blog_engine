<?php

require_once "utils.php";
confirmUserHasLogin();

?>

<html>
<head>
    <title>User edit...</title>
    <script type="application/javascript" src="static/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<h1 id="edit_name">User Editing: </h1>
<form>
        Username: <input type="text" id="username" /><br />
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
    <input type="submit" id="submit"/>
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
            document.getElementById("active").selectedIndex = user["active"];
            document.getElementById("role").selectedIndex = user["role"];
        });
    };
</script>
</body>
</html>
