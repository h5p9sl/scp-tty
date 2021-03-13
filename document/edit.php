<?php
$pagetitle = 'EDIT: '. $page['title'];
include 'mklogin.php';              // Ensures we're logged in
include 'header.php';               // Site <head> section
include 'hacks/titlebar.php';
include 'hacks/hotbar.php';         // Hotbar for easy user navigation
?>

<?php
    include 'vendor/autoload.php';
    use SebastianBergmann\Diff\Differ;
if (isset($_POST['body'])) {
    include 'db.php';
    include 'vendor/autoload.php';

    $differ = new Differ;

    $stmt = mysqli_stmt_init($db);
    if (!(mysqli_stmt_prepare($stmt, 'SELECT body FROM documents WHERE id = ?'))) {
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
    if (!mysqli_stmt_bind_result($stmt, $old_body)) {
        echo 'Statement result binding failed: '. mysqli_error($db);
        die();
    }
    mysqli_stmt_fetch($stmt);

    $diff = $differ->diff($old_body, $_POST['body']);
    if (!$diff) {
        echo 'xdiff failed to create a page diff!';
        die();
    }

    $sql_cmd = "UPDATE `documents` SET `body` = ? WHERE `documents`.`id` = ?; ";
    $sql_sub_types = 'si';
    $stmt = mysqli_stmt_init($db);
    if (!(mysqli_stmt_prepare($stmt, $sql_cmd))) {
        echo 'Statement prepare failed: '. mysqli_error($db);
        die();
    }
    if (!mysqli_stmt_bind_param($stmt, $sql_sub_types, $_POST['body'], $page['id'])) {
        echo 'Statement parameter binding failed: '. mysqli_error($db);
        die();
    }
    if (!mysqli_stmt_execute($stmt)) {
        echo 'Statement execute failed: '. mysqli_error($db);
        die();
    }

    $sql_cmd = "INSERT INTO document_history(id, doc_id, author, edit_date, diff) VALUES (NULL, ?, ?, current_timestamp(), ?); ";
    $sql_sub_types = 'iis';
    $stmt = mysqli_stmt_init($db);
    if (!(mysqli_stmt_prepare($stmt, $sql_cmd))) {
        echo 'Statement prepare failed: '. mysqli_error($db);
        die();
    }
    if (!mysqli_stmt_bind_param($stmt, $sql_sub_types, $page['id'], $_SESSION['uid'], $diff)) {
        echo 'Statement parameter binding failed: '. mysqli_error($db);
        die();
    }
    if (!mysqli_stmt_execute($stmt)) {
        echo 'Statement execute failed: '. mysqli_error($db);
        die();
    }

    header('Location: document.php?id='. $page['id']);
}
?>

<section>
<div style="display: block" class=rightmost>
<a href=<?php echo 'document.php?id='. $page['id'];?>>Back</a>
<a href=<?php echo 'document.php?id='. $page['id']. '&history'; ?>>History</a>
</div>

<h1>EDIT PAGE: <a href=<?php echo 'document.php?id='. $page['id']; ?>><?php echo $page['title'];?></a></h1>

<div style="width: 100%">

<form style="width: 100%" method=POST>
<input type=submit />

<textarea name=body style="width: 100%; height: 500pt">
<?php
echo $page['body'];
?>
</textarea>

</form>
</div>

</section>
