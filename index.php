<?php
$pagetitle = 'HOME';
include 'mklogin.php';              // Ensures we're logged in
include 'header.php';               // Site <head> section
include 'hacks/titlebar.php';
include 'hacks/hotbar.php';         // Hotbar for easy user navigation
?>

<section>

<table>
<tr>
<td class=leftmost>
<h3>Your Authorized Documents</h3>
</td>

<td>
<h3>Peer Discussion</h3>
</td>
</tr>

<tr>

<td class=leftmost style="vertical-align: top">

<?php
    include_once 'db.php';
    $result = mysqli_query($db, 'SELECT * FROM `documents` ORDER BY creation_date ASC');
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<a href="document.php?id='.
            $row['id'] .'">'.
            $row['title'] .'</a> "'.
            $row['subtitle'] .'"<br>';
    }
?>

<td>

<form method=POST>
<input style="text-align: left; width: 80%" name=message type=text autofocus="autofocus" onfocus="this.select()"></input>
<input type=submit value="Send"></input>
</form>
<?php include_once 'chat.php'?>

</td>
</tr>
</table>
</section>

</body>
