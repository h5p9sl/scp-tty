<section>

<table width=100%>
<tr>
<td class=leftmost>
<a href="index.php">Home</a>
<a href="resources.php">Resources</a>
<a href="personnel.php?id=<?php echo $_SESSION['uid']; ?>">Personnel</a>
</td>

<td class=rightmost>
Welcome, <?php
echo htmlspecialchars($_SESSION['uname']);
?>.
<a href="login.php?die">Log out</a>
</td>

</tr>
</table>
</section>
