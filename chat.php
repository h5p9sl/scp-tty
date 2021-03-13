<small style="color: red" id=chat-jswarn>You do not have javascript enabled. The chat will not automatically update.</small>
<script>document.getElementById('chat-jswarn').remove()</script>

<?php /*

<script>
const socket = new WebSocket("chat.php?updates");
socket.onmessage = function (event) {
    document.write(event.data);
};
</script>

*/ ?>

<div class=chat>

<?php
include_once 'db.php';

if (isset($_POST['message']) && strlen($_POST['message']) > 0) {
    $stmt = mysqli_stmt_init($db);
    if (!(mysqli_stmt_prepare($stmt, 'INSERT INTO `discussion` (`id`, `author`, `message`, `timestamp`) VALUES (NULL, ?, ?, current_timestamp())'))) {
        echo 'Statement prepare failed: '. mysqli_error($db);
        die();
    }
    if (!mysqli_stmt_bind_param($stmt, 'is', $_SESSION['uid'], $_POST['message'])) {
        echo 'Statement parameter binding failed: '. mysqli_error($db);
        die();
    }
    if (!mysqli_stmt_execute($stmt)) {
        echo 'Statement execute failed: '. mysqli_error($db);
        die();
    }
}

$result = mysqli_query($db, 'SELECT * FROM `discussion` ORDER BY `timestamp` DESC LIMIT 100');

while ($row = mysqli_fetch_assoc($result)) {
    $name = mysqli_fetch_row(mysqli_query($db, 'SELECT name FROM `users` WHERE id='. $row['author']));
    echo '<p class=message>['. $row['timestamp'] .'] <a href="personnel?id='. $row['author'] .'">'. $name[0] .'</a>: '. htmlspecialchars($row['message']) .'</p><br>';
}
?>


</div>
