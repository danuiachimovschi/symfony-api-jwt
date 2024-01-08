<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<script>
    var conn = new WebSocket('ws://0.0.0.0:8080/dsds');

    conn.onopen = function(e) {
        console.log("Connection established!");
        conn.send(JSON.stringify({category: 'dsdsds'}));
    };

    conn.onmessage = function(e) {
        let data = JSON.parse(e.data);

        console.log(data);
    };

   conn.onclose = function(e) {
        console.log("Connection closed!");
    };

   conn.onerror = function(e) {
        console.log(e);
    };


</script>
</body>
</html>
