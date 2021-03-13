<?php
include_once 'db.php';

$stmt = mysqli_stmt_init($db);
if (!(mysqli_stmt_prepare($stmt, 'SELECT * FROM documents WHERE id=?'))) {
    echo 'Statement prepare failed: '. mysqli_error($db);
    die();
}
if (!mysqli_stmt_bind_param($stmt, 'i', $_GET['id'])) {
    echo 'Statement parameter binding failed: '. mysqli_error($db);
    die();
}
if (!mysqli_stmt_execute($stmt)) {
    echo 'Statement execute failed: '. mysqli_error($db);
    die();
}
$result = mysqli_stmt_get_result($stmt);
if (!($page = mysqli_fetch_array($result))) {
    header('Location: 404.php');
}
?>

<?php
if (isset($_GET['edit'])) {
    include 'document/edit.php';
    die();
} else if (isset($_GET['history'])) {
    include 'document/history.php';
    die();
}
?>

<?php
$pagetitle = $page['title'];
include 'mklogin.php';              // Ensures we're logged in
include 'header.php';               // Site <head> section
include 'hacks/titlebar.php';
include 'hacks/hotbar.php';         // Hotbar for easy user navigation
?>

<section>
<?php
include 'document/parser.php';
$document_parser = new DocumentParser;
$body = $document_parser->parse_document_page($page);
if (!($scpimg = $document_parser->get_var('SCPIMG'))) {
    $scpimg = 'img/white_scp_emblem.png';
}
?>


<div style="display: block" class=rightmost>
<a href=<?php echo 'document.php?id='. $_GET['id'] .'&edit'; ?>>Edit</a>
<a href=<?php echo 'document.php?id='. $page['id']. '&history'; ?>>History</a>
</div>

<a href=<?php echo $_SERVER['REQUEST_URI']; ?>><h1><?php echo $page['title'];?></h1></a>
<h3>"<?php echo $page['subtitle']?>"</h3>

<table class=infobox style="width: 22em">
<tr class=<?php echo $page['object_class'];?> style="border: 1px white solid"><td><h3><?php echo $page['title']?></h3></td></tr>
<tr><td><img style="max-width: 22em;" src=<?php echo htmlspecialchars($scpimg);?>></img></td></tr>
<tr><td><h3>"<?php echo $page['subtitle']?>"</h3></td></tr>
<tr><td class="leftmost <?php echo $page['security_class'];?>"><b>Security Clearance: </b><?php echo $page['security_class'];?></td></tr>
<tr><td class="leftmost <?php echo $page['object_class'];?>"><b>Contaiment Class: </b><?php echo $page['object_class'];?></td></tr>
<tr><td class="leftmost <?php echo $page['disruption_class'];?>"><b>Disruption Class: </b><?php echo $page['disruption_class'];?></td></tr>
<tr><td class="leftmost <?php echo $page['risk_class'];?>"><b>Risk Class: </b><?php echo $page['risk_class'];?></td></tr>
<tr><td class=leftmost><b>Date: </b><?php echo $page['creation_date'];?></td></tr>
</table>

<div class=leftmost>
<?php
echo $body;
?>
</div>

</section>
