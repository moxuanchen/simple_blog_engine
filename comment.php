<!DOCTYPE html>
<html>
<head>
    <title>comment</title>
    <script type="text/javascript" src="static/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<p>Comment: </p>
<textarea rows="20", cols="100" id="comment"></textarea>
<p><input type="submit" onclick="checkAndSendComment()"></input></p>
<script type="application/javascript">
    alert(window.location.href);
    function checkAndSendComment() {
        alert("click");
        var comment = document.getElementById("comment").value;
        var id=1;

        data = {
            "id": id,
            "comment": comment,
        }

        $.post("comment.php", data, function (resp, status) {
            if (resp == "OK" && status == "success") {
                window.location = window.location.href;
            } else {
                alert("Add comment failed.");
            }
        });
    }
</script>
</body>
</html>