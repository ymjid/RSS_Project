<html>

<head>

<title>Website's title - Menu</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="./css/website.css" />

</head>

<body>

<div class="optionmenu">
<ul class="menu">
<a class="menulink" href="home.php" OnMouseOver="switchimg(home)" OnMouseOut="switchbackimg(home)"><li class="item"><img id="home" class="linkimg" src="./img/home2.png"/> Home
</li></a>
<?php
if (isset($_SESSION['login']) || $_SESSION['login']!=""){
	echo '<a class="menulink"href="news.php" OnMouseOver="switchimg(news)" OnMouseOut="switchbackimg(news)"><li class="item"><img id="news" class="linkimg" src="./img/news2.png"/> Unread News';
	echo '</li></a>';
	echo '<a class="menulink" href="archive.php" OnMouseOver="switchimg(archive)" OnMouseOut="switchbackimg(archive)"><li class="item"><img id="archive" class="linkimg" src="./img/archive2.png"/> Archives';
	echo '</li></a>';
	echo '<a class="menulink" href="flux.php" OnMouseOver="switchimg(flux)" OnMouseOut="switchbackimg(flux)"><li class="item"><img id="flux" class="linkimg" src="./img/flux2.png"/> Flux';
	echo '</li></a>';
	echo '<a class="menulink" href="logout.php" OnMouseOver="switchimg(logout)" OnMouseOut="switchbackimg(logout)"><li class="item"><img id="logout" class="linkimg" src="./img/logout2.png"/> Logout';
	echo '</li></a>';
}
?>
</ul>
</div>

</body>

</html>