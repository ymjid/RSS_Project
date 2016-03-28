<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login']==""){
	header('Location: ./home.php');
}
?>
<html>

<head>

<title>Website's title - Unread News</title>
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

<p class="title">
Unread News
</p>
<?php
include('./bdd/bdd.php');
echo '<div class="shift">';
	echo '<form name="rss">';
	echo '<SELECT class="flux" name="flux" size="1" onChange="restrictflux(document.rss.flux.value)">';
	echo '<option value="0">flux available</option>';
	$resultat = $bdd->query('SELECT * FROM fluxrss WHERE stateflux!="desactivated"');
	while ($donnees = $resultat->fetch()) {
 		$domain=$donnees['name'];
 		$url=$donnees['link'];
 		$fluxid=$donnees['ID'];
 		echo '<option value="'.$fluxid.'">'.$domain.'</option>';
	}
	echo '</SELECT>';
	echo '</form>';
	echo '</div>';
?>
<hr>
<?php
$fluxnb=0;
echo '<div id="fluxes">';	
   	$resultat2 = $bdd->query('SELECT * FROM fluxrss WHERE stateflux!="desactivated" ');
 	while ($donnees2 = $resultat2->fetch()) {
 		$domain=$donnees2['name'];
 		$numflux=$donnees2['ID'];
 		$test = $bdd->query('SELECT * FROM rssarticle WHERE fluxID='.$numflux.' && state="1" && statearticle!="desactivated" && numuser="'.$_SESSION['userid'].'" ORDER BY articledate DESC');
   			if ( 0 != $test->fetchColumn()){
   				$fluxnb++;
 				echo '<div id=flux_'.$numflux.'>';
 		 		echo '<p class="title">'.$domain.'</p>';
 				echo '<br><br>';
 				$resultat3 = $bdd->query('SELECT * FROM rssarticle WHERE fluxID='.$numflux.' && state="1" && statearticle!="desactivated" && numuser="'.$_SESSION['userid'].'" ORDER BY articledate DESC');
 				while ($donnees3 = $resultat3->fetch()) {
 					$articleID=$donnees3['articleID'];
 					$link=$donnees3['articlelink'];
 					$link2= '"'.$donnees3['articlelink'].'"';
 					$title=$donnees3['title'];
 					$type=$donnees3['type'];
 					$description = $donnees3['description'];
 					$date = $donnees3['articledate'];
 						$page = "";
 						$page .="<ul>";
 						$page .= "<li class=article name=".$articleID."><a href=".$link." target=\"_blank\" onclick=readarticle(".$articleID.",".$donnees3['numuser'].");>".$title."</a>";	
						if($date!="")
						{
      						$page .=' <br><span class="rssdate">'.$date.'</span>';
    					}
						if($description!="")
						{
							$page .= "<br><span class='rssdesc'>$description</span>";
						}
						$page .= "</li>\n";		
		
						if($type==0)
						{
							$page .="</b><br />";
						}
						$page .= "</ul>\n";
				echo $page;
 				}
 				echo '<hr>';
   			}
 
 		echo "</div>";
 	}
 	if ($fluxnb == 0){
 		echo '<p class="title">Your RSS flux list is empty</p>';
 	}
 echo '</div>';
?>
<div class="footer shift">
	<p>&copy; Yan 2015</p>
</div>
</div>

</body>

</html>