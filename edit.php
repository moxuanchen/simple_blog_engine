<html>
    <head>
        <title>Edit...</title>
        <script type="text/javascript" src="static/js/jquery-3.2.1.min.js"></script>
    </head>
    <body>
        <h2>Edit Your Post...</h2>
        <p>Title: <input type="text" id="title" placeholder="Your post title here..."></p>
        <p>Content: </p>
        <textarea id="content" placeholder="Your post here..." rows="20", cols="100"></textarea>
        <p><input type="submit" id="submit" onclick="checkAndEditPost()"></input></p>
    
        <script type="text/javascript">
            function get_post_id() {
                return window.location.search.split("=")[1];
            }

            function checkAndEditPost() {
                var id = get_post_id();
                var title = document.getElementById("title").value;
                var content = document.getElementById("content").value;

                data = {
                    "id": id,
                    "title": title,
                    "content": content
                }

                $.post("handler/edit_post_handler.php", data, function (resp, status) {
                    alert(status + ": " + resp);
                })
            }

            window.onload = function () {
                var id = get_post_id();
                $.get("handler/get_post_handler.php?id=" + id, function (resp, status) {
                    if (status == "success") {
                        data = JSON.parse(resp);
                        var el_title = document.getElementById("title");
                        el_title.value = data["title"];

                        var el_content = document.getElementById("content");
                        el_content.value = data["content"];
                    }
                });
            }
        </script>
    </body>
</html>