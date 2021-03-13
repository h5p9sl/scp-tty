<?php
$pagetitle = 'HISTORY: '. $page['title'];
include 'mklogin.php';              // Ensures we're logged in
include 'header.php';               // Site <head> section
include 'hacks/titlebar.php';
include 'hacks/hotbar.php';         // Hotbar for easy user navigation
?>

<section>
<div style="display: block" class=rightmost>
<a href=<?php echo 'document.php?id='. $page['id'];?>>Back</a>
</div>

<h1>HISTORY PAGE: <a href=<?php echo 'document.php?id='. $page['id']; ?>><?php echo $page['title'];?></a></h1>

<?php
    include_once 'db.php';

    $stmt = mysqli_stmt_init($db);
    if (!(mysqli_stmt_prepare($stmt, 'SELECT * FROM `document_history` WHERE doc_id = ? ORDER BY edit_date DESC LIMIT 15'))) {
        echo 'Statement prepare failed: '. mysqli_error($db);
        die();
    }
    if (!mysqli_stmt_bind_param($stmt, 'i', $page['id'])) {
        echo 'Statement parameter binding failed: '. mysqli_error($db);
        die();
    }
    if (!mysqli_stmt_execute($stmt)) {
        echo 'Statement execute failed: '. mysqli_error($db);
        die();
    }
    $result =  mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $usr_result = mysqli_query($db, 'SELECT name FROM `users` WHERE id='. $row['author']);
        $usr = mysqli_fetch_assoc($usr_result);

        echo '<div class=leftmost>'.
        '<a href="about:blank">Undo</a> '.
        'edit made by '.
        '<a href="about:blank">'. $usr['name'] .'</a> @ '. $row['edit_date']. ': <div style="white-space: pre">'.
            htmlspecialchars($row['diff']) .'</div></div>';
    }
?>

</section>
