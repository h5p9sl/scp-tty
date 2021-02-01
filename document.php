<?php
$pagetitle = '#'. $_GET['id'];
include 'mklogin.php';              // Ensures we're logged in
include 'header.php';               // Site <head> section
include 'hacks/titlebar.php';
include 'hacks/hotbar.php';         // Hotbar for easy user navigation
?>

<?php
$object_class = 'Keter';
$scp_id = 'SCP-'. $_GET['id'];
$document_title = '"Cran"';
?>

<section>
<a href=<?php echo $_SERVER['REQUEST_URI']; ?>><h1><?php echo $scp_id;?></h1></a>
<h3><?php echo $document_title?></h3>

<table class=infobox style="width: 22em">
<tr style="border: 1px white solid; background-color: red"><td><h3><?php echo $document_title?></h3></td></tr>
<tr><td><img width=100px src=img/white_scp_emblem.png></img></td></tr>
<tr><td class=leftmost><b>Object Class: </b><?php echo $object_class;?></td></tr>
</table>

<div id=document_body class=leftmost> <p>
Document body goes here. <b>Markdown is supported.</b> <br>
<br>
Index goes here
<ul>
    <li><a href=#section_1>Section 1</a></li>
    <li><a href=#section_2>Section 2</a></li>
</ul>

<br>
<h2>Section 1</h2>
<br>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec ullamcorper nunc. Sed at felis ut ante pulvinar convallis. Donec lacinia odio nec egestas vulputate. Curabitur mi justo, vulputate eget ante a, eleifend tempus est. Suspendisse non suscipit libero, ac faucibus sapien. Suspendisse cursus augue nisi, nec dictum justo posuere sit amet. Pellentesque quis ligula vel diam dignissim eleifend. Praesent facilisis consequat enim, eget porttitor magna finibus at. Mauris tortor sem, blandit quis lorem nec, pulvinar convallis augue. Aliquam sit amet arcu in nisi bibendum porttitor nec eget leo. Etiam lobortis mi vitae massa lobortis, sed consectetur ligula placerat. Curabitur eu vestibulum erat. In hac habitasse platea dictumst.<br>
<br>
<h2>Section 2</h2>
Nulla blandit ultrices condimentum. Nullam rutrum quam aliquam, luctus turpis in, rutrum nisl. Duis sed sagittis dolor, nec scelerisque ligula. Proin libero orci, scelerisque eu eleifend a, fringilla non eros. Vivamus interdum dictum odio, consectetur aliquet arcu malesuada blandit. Nullam imperdiet lacus id nulla semper semper. Vivamus ac diam nec eros molestie auctor a vitae eros. <br>

</p> </div>

</section>
