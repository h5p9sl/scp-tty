<?php
$pagetitle = 'REQUEST AUTH';
include 'header.php';       // Site <head> section
include 'hacks/titlebar.php';     // Titlebar for aeshetics
?>

<section style="width: 800px">

<?php
if (isset($_GET['rngpw'])) {
    rngpw();
}
if (
    isset($_POST['scp_id']) &&
    isset($_POST['scp_pw']) &&
    isset($_POST['scp_pw2'])
) {
    $errors = 0;
    if (strcmp($_POST['scp_pw'], $_POST['scp_pw2']) != 0) {
        echo '<b>Passwords <span style="color: red">do not</span> match</b><br>';
        $errors++;
    }
    if (!preg_match('/^[-_A-Za-z0-9]+$/', $_POST['scp_id'])) {
        echo '<b>ID has <span style="color: red">invalid characters</span></b><br>';
        $errors++;
    }
    if (!preg_match('/^[\w\S\ ]+$/', $_POST['scp_pw'])) {
        echo '<b>Password has <span style="color: red">invalid characters</span></b><br>';
        $errors++;
    }

    if ($errors > 0) {
        echo '<b>You have '. $errors .' errors</b><br>';
    } else {
        $name = $_POST['scp_id'];
        $pw_hash = password_hash($_POST['scp_pw'], PASSWORD_DEFAULT);

        include_once 'db.php';

        $stmt = mysqli_stmt_init($db);
        if (!(mysqli_stmt_prepare($stmt, 'INSERT INTO users (id, name, password, registration_date) VALUES (NULL, ?, ?, current_timestamp())'))) {
            echo 'Statement prepare failed: '. mysqli_error($db);
            die();
        }
        if (!mysqli_stmt_bind_param($stmt, 'ss', $name, $pw_hash)) {
            echo 'Statement parameter binding failed: '. mysqli_error($db);
            die();
        }
        if (!mysqli_stmt_execute($stmt)) {
            echo 'Statement execute failed: '. mysqli_error($db);
            die();
        }

        echo '<b>Request <span style="color: green">successfully processed</span>. You can now <a href=login.php>log in</a>.</b><br>';
    }
}
?>

<table><tr>
<td class=leftmost>

<form method=POST action="register.php">
<label>ID</label> <br>
<input type=text name=scp_id></input>

<br>
<label>Passphrase</label> <br>
<input type=password name=scp_pw></input>

<br>
<label>Confirm Passphrase <br>
<input type=password name=scp_pw2></input>

<br>
<label></label> <br>
<input type=submit value="Send Request"></input>
</form>

</td><td>
<h3>How to request SCP/TTY authorization</h3>
<ol>
    <li>Type your personnel ID in the "ID" box. (ex. dr_john-mack)</li>
    <li>Generate a <a href=register.php?rngpw>foundation standard passphrase</a> and memorize it.</li>
    <li>Type your foundation standard passphrase in "Passphrase" box.</li>
    <li>Press the "Send Request" button.</li>
    <li>Your request should be processed within a day.</li>
</ol>
</td>
</tr></table>

</section>

<?php
function rngpw() {
    $delim = ' -_+/%';
    $num_words = 2;
    $num_passwords_to_gen = 2;
    $words = preg_replace('/\ /', '', preg_split('/\n/', file_get_contents('words.txt')));
    $passwords = [];

    for ($i = 0; $i < $num_passwords_to_gen; $i++) {
        $pw = '';
        $d = $delim[rand(0, strlen($delim) - 1)];
        for ($j = 0; $j < $num_words; $j++) {
            $pw .= $words[rand(0, sizeof($words) - 2)];
            $pw .= $d;
        }
        $pw .= rand(0, 10);
        array_push($passwords, $pw);
    }

    echo '<b>Random passphrases: ';
    foreach ($passwords as $pw) {
        echo '<span style="color: green">"'. htmlspecialchars($pw) .'"</span>, ';
    }
    echo '</b>';
}
?>
