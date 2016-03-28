<?php
session_start();
?>
<html>

<head>

<title>Website's title  - Home</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="./css/website.css" />
 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="./js/website.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
<?php
	require_once("./rss/rsslib.php");
?>
<div class="page">
<div class="logo"><img src="./img/fluxlogo.png" alt="fluxlogo" height="150px" width="150px"/></div>
<?php
include ('./user.php');
?>
<?php
$save=false;
if (isset($_POST['name'])){
	/* Sauvegarde du flux rss */
	$addData=$bdd->prepare('INSERT INTO fluxrss (name, link) VALUES (:name, :link)');	
	$addData->execute(array(
			'name' => $_POST['name'],
			'link' => $_POST['dyn']
			));
	$save=true;
	echo '<p class="save">RSS flux added</p>';
}
?>
<div>
<p class="title">
Home
</p>
<div class="shift">
<p>
Welcome to this site.
</p>
<p>The site is created to gather all your RSS flux at the same place.<br>
It's able to distinct articles you have read and those you haven't.<br>
Once you read an article, its is transfered to the archive section.<br>
<br>
<?php
?>
</p>
</div>

<hr>
<div class="footer shift">
	<p>&copy; Yan 2015</p>
</div>
</div>

</body>

</html>