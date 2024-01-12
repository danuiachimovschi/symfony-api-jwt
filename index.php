<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>Title</title>-->
<!---->
<!--    <button onclick="sendAction()">-->
<!--send-->
<!--    </button>-->
<!--</head>-->
<!--<body>-->
<!---->
<!--<script>-->
<!--    function getRandomInt(min, max) {-->
<!--        min = Math.ceil(min);-->
<!--        max = Math.floor(max);-->
<!--        return Math.floor(Math.random() * (max - min)) + min;-->
<!--    }-->
<!---->
<!--    var conn = new WebSocket('ws://0.0.0.0:8080/dsds');-->
<!--    var user_id = getRandomInt(1, 100000);-->
<!---->
<!--    console.log(user_id);-->
<!--    conn.onopen = function(e) {-->
<!--        console.log("Connection established!");-->
<!--    };-->
<!---->
<!--    conn.onmessage = function(e) {-->
<!--        let data = JSON.parse(e.data);-->
<!---->
<!--        console.log(data);-->
<!--    };-->
<!---->
<!--   conn.onclose = function(e) {-->
<!--        console.log("Connection closed!");-->
<!--    };-->
<!---->
<!--   conn.onerror = function(e) {-->
<!--        console.log(e);-->
<!--    };-->
<!---->
<!--   function sendAction(){-->
<!--       conn.send(JSON.stringify({subscribe: 'chat',action: 'sendMessage', token : "Dsd", room_id: 1, message: 'Hello world', username: 'John Doe', user_id: user_id}));-->
<!--   }-->
<!---->
<!--</script>-->
<!--</body>-->
<!--</html>-->
