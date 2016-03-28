<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login']==""){
	header('Location: ./home.php');
}
function IsValidFeed($sURL) {
    	$sURL = 'http://feedvalidator.org/check.cgi?url=' . urlencode($sURL);
    	$sPage = file_get_contents($sURL);


    if (strstr($sPage, 'This is a valid RSS feed.')) {
        return TRUE;
    }


    return FALSE;
}

?>
<html>

<head>

<title>Website's title  - RSS Flux</title>
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

<div>
<p class="title">
<?php echo $_SESSION['login'];?>'s RSS flux list
</p>
<?php
$save=false;
$erase=false;
$nomflux="";
$urlflux="";
include('./bdd/bdd.php');
if (isset($_POST['name'])){
	$error=$_POST;
	if (isset($_POST['url'])  && $_POST['url']!=""){
		$filetype=IsValidFeed($_POST['url']);
		if ($filetype==true){
			$fluxdate=date('Y-m-d H:i:s');
			/* Sauvegarde du flux rss */
			$addData=$bdd->prepare('INSERT INTO fluxrss (name, link, numuser, fluxdate, stateflux) VALUES (:name, :link, :user, :fluxdate, :stateflux)');
			$addData->execute(array(
				'name' => $_POST['name'],
				'link' => $_POST['url'],
				'user' => $_SESSION['userid'],
				'fluxdate' => $fluxdate,
				'stateflux' => 'activated'
				));
			$save=true;
			unset($error);
		}
		else {
			echo '<p class="error">The URL given is not an RSS flux one</p>';
			
		}
	}
}
if ($save==true){
	echo '<p class="save">RSS flux added</p>';
}
if (isset($error)){
		$nomflux=$error['name'];
		$urlflux=$error['url'];
		if (!isset($_POST['name']) || $_POST['name']==""){
			echo '<p class="error">A name is missing for the RSS flux</p>';
		}
		if (!isset($_POST['url']) || $_POST['url']==""){
			echo '<p class="error">An URL is missing for the RSS flux</p>';
		}	
}
 	
?>
<br>

<div class="fluxblock2">
<p class="inboxtitleflux"><span class="itemtxt"> RSS flux list</span><?php echo '<img class="actionbutton1" src="./img/updateall.png" alt="Update all flux" title="Update all flux" onClick="updateallflux('.$_SESSION['userid'].')">';?><img id="fluxbutton" class="actionbutton2" src="./img/add.png" alt="Add Flux" title="Add flux" onClick="addflux()"></p>
<div class="tablelist">
<p class="tabletitle1"> RSS flux name</p><p class="tabletitle">Actions</p>
<?php
$fluxnb=0;
echo '<div id="addflux" style="display:none; background-color:#FFFED7;" class="tableitem">';
echo '<form method="POST" action="#">';
echo '<input type="text" name="name" size="48" required placeholder="RSS flux name" value="'.$nomflux.'" x-moz-errormessage="Put a name for the RSS flux"> ';
echo '<input type="text" name="url" size="48"  required pattern="https?://.+.xml" placeholder="RSS flux URL" value="'.$urlflux.'" x-moz-errormessage="Put a valid URL link for the RSS flux"> ';
echo '<input class="custombutton" type="submit" value="Add flux">';
echo '</form>';
	echo '</div> ';
$resultat2 = $bdd->query('SELECT * FROM fluxrss WHERE numuser="'.$_SESSION['userid'].'" && stateflux!="erase"');
while ($donnees2 = $resultat2->fetch()) {
	$fluxnb++;
	echo '<div id="item_'.$donnees2['ID'].'" class="tableitem '.$donnees2['stateflux'].'"><p id="fluxname'.$donnees2['ID'].'" class="itemtxt">'.$donnees2['name'].' </p><input style="display:none" type="text" id="changename'.$donnees2['ID'].'" name="changename"> <input class="custombutton" style="display:none" type="button" id="confirmname'.$donnees2['ID'].'" name="confirmname" value="Rename" onClick="changefluxname('.$donnees2['ID'].', '.$donnees2['numuser'].')">';
	echo '<img id="action1" class="action" src="./img/update.png" alt="update" title="Update flux" onClick="actionflux(action1, '.$donnees2['ID'].', '.$donnees2['numuser'].')">';
	if ($donnees2['stateflux']=="activated"){
		$stateimg="./img/desactivated.png";
	}
	else{
		$stateimg="./img/activated.png";
	}
	echo '<img id="action2" name ="action2_'.$donnees2['ID'].'" class="action2" src="'.$stateimg.'" alt="desactivate" title="Desactivate flux" onClick="actionflux(action2, '.$donnees2['ID'].', '.$donnees2['numuser'].')">';
	echo '<img id="action3" name ="action3_'.$donnees2['ID'].'" class="action2" src="./img/edit.png" alt="edit" title="Edit flux" onClick="actionflux(action3, '.$donnees2['ID'].')">';
	echo '<img id="action4" name ="action4_'.$donnees2['ID'].'" class="action2" src="./img/suppr.png" alt="delete" title="Delete flux" onClick="actionflux(action4, '.$donnees2['ID'].', '.$donnees2['numuser'].')">';
	echo '</div> ';
}
	if ($fluxnb == 0){
 		echo '<p class="title">Your RSS flux list is empty</p>';
 	}

?>
</div>
</div>
<div class="footer shift">
	<p>&copy; Yan 2015</p>
</div>
</div>

</body>

</html>