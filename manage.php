<?php
    require_once "utils.php";
    confirmUserIsAdmin();
?>

<html>
<head>
    <title>System manage...</title>
    <script type="application/javascript" src="static/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<div id="operator">
    <h1>Blog System Manage...</h1>
    <a href="#" id="setting" onclick="doSetting()">Setting</a>
    <a href="#">Review Post</a>
    <a href="#">New Post</a>
    <a href="#" id="user" onclick="doUserManage()">User Manage</a>
</div>
<hr />
<div id="display"></div>

<script type="text/javascript">
    function doSetting() {

    }

    function doUserManage() {

        $.get("handler/manage_user_handler.php", function (resp, status) {
            if (status != "success") {
                return;
            }
            var user_list = JSON.parse(resp);
            var table_start = "<table><th>Name</th>" +
                "<th>Role</th>" +
                "<th>Active</th>" +
                "<th>Create_at</th>";

            var table_end = "</table>"
            var table_body = "";

            for (var i = 0; i < user_list.length; i ++) {
                table_body += "<tr>" + "<td>" +
                    "<a href=/user_edit.php?id=" + user_list[i]["id"] + ">" +
                    user_list[i]["name"] + "</a>" + "</td>" +
                    "<td>" + user_list[i]["role"] + "</td>" +
                    "<td>" + user_list[i]["active"] + "</td>" +
                    "<td>" + user_list[i]["create_at"] + "</td>" + "</tr>";
            }
            var el_display = document.getElementById("display");
            el_display.innerHTML = table_start + table_body + table_end;
        });
    }
</script>

</body>
</html>