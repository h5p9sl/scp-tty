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
<small>Discussion may be monitored by your surperiors</small><br>
</td>
</tr>

<tr>

<td class=leftmost style="vertical-align: top">
<a href="document.php?id=8942">SCP-8942</a> "Cran"<br>
<a href="document.php?id=8942?sub=1">SCP-8942-1</a> "Cranfiles"<br>
<h3>Request Document</h3>
<input type=text></input>
<input type=submit value="Request"></input>
</td>

<td>
<div class=chat style="background-color: black; text-align: left; overflow: scroll; height: 400px">
Person01: Hello World!<br>
Person02: Yo!<br>
</div>
<input type=text></input>
<input type=submit></input>
</td>

</tr>

</table>
</section>

</body>
