<?php
$pagetitle = 'PORTAL';
include_once 'header.php';
?>

<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['die'])) {
    session_destroy();
    header("Location: index.php");
}
?>

<img height=400px src=img/white_scp_emblem.png></img>

<h1>Access Portal <u>#<?php echo dechex(rand());?></u></h1>

<section style="width: 400px">
<?php
if (isset($_POST['scp_id'])) {
    include_once 'db.php';

    $stmt = mysqli_stmt_init($db);
    if (!(mysqli_stmt_prepare($stmt, 'SELECT id, name, password FROM users WHERE name = ?;'))) {
        echo 'Statement prepare failed: '. mysqli_error($db);
        die();
    }
    if (!mysqli_stmt_bind_param($stmt, 's', $_POST['scp_id'])) {
        echo 'Statement parameter binding failed: '. mysqli_error($db);
        die();
    }
    if (!mysqli_stmt_execute($stmt)) {
        echo 'Statement execute failed: '. mysqli_error($db);
        die();
    }
    if (!mysqli_stmt_bind_result($stmt, $id, $name, $password)) {
        echo 'Statement result binding failed: '. mysqli_error($db);
        die();
    }
    mysqli_stmt_fetch($stmt);
    if ($password != NULL) {
        if (password_verify($_POST['scp_pw'], $password)) {
            $_SESSION['uid'] = $id;
            $_SESSION['uname'] = $name;
            header("Location: index.php");
        } else {
            echo '<b style="color: red">Password incorrect</b>';
        }
    } else {
        echo '<b style="color: red">User does not exist</b>';
    }
}
?>
<form method=POST action="login.php">
<label>ID</label> <br>
<input type=text name=scp_id></input>

<br>
<label>Passphrase</label> <br>
<input type=password name=scp_pw></input>

<br>
<label></label> <br>
<input type=submit value="Request Entry"></input>
</form>
</section>

<section style="width: 400px">
<a href=register.php>Request Authorization</a>
</section>

</body>
