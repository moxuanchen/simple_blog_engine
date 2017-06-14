<html>
<head>
    <title>System manage...</title>
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
        user_list = [
            {
                "name": "name1",
                "role": 1,
                "active": 1,
                "create_at": "2017-01-01 00:00:00"
            },
            {
                "name": "name2",
                "role": 1,
                "active": 1,
                "create_at": "2017-01-01 00:00:00"
            }
        ]

        var table_start = "<table><th>Name</th><th>Role</th><th>Active</th><th>Create_at</th>";
        var table_end = "</table>"

        var table_body = "";
        for (i = 0; i < user_list.length; i ++) {
            table_body += "<tr>" + "<td>" + user_list[i]["name"] + "</td>" +
                "<td>" + user_list[i]["role"] + "</td>" +
                "<td>" + user_list[i]["active"] + "</td>" +
                "<td>" + user_list[i]["create_at"] + "</td>" + "</tr>";
        }
        var el_display = document.getElementById("display");
        el_display.innerHTML = table_start + table_body + table_end;
    }
</script>

</body>
</html>