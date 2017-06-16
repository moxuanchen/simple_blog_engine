<!DOCTYPE html>
<html>
<head>
    <title>User register...</title>
    <script type="text/javascript" src="static/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="static/bootstrap/js/bootstrap.min.js"></script>
    <link href="static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<p><h2>User Register...</h2></p>
<form method="POST" action="handler/register_handler.php">
    Username: <input type="text" name="username" id="username" onblur="checkUserName()" />
    <br />
    Password: <input type="Password" name="password" />
    <br />
    <input type="submit" />
    <input type="reset" />
</form>
<script type="text/javascript">
    function checkUserName() {
        var username = document.getElementById("username").value;
        data = {
            "username": username
        }

        $.post("/handler/username_handler.php", data, function(resp, status) {
            if (status != "success" || resp != "OK") {
                alert("Username: " + username + " has existed.");
            }
        });
    }
</script>
</body>
</html>