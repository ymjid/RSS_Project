<?php
include('./bdd/bdd.php');
$formfilled=false;
if (isset($_POST['log']) && isset($_POST['pwd'])){
	$formfilled=true;
	if ($_POST['switchnum']=="1"){
		$resultat = $bdd->query('SELECT * FROM user');
		$test=false;
		while ($donnees = $resultat->fetch()) {
 			$bddlog=$donnees['login'];
 			$bddpwd=$donnees['pwd'];
 			if ($_POST['log']==$bddlog && md5($_POST['pwd'])==$bddpwd){
 				$test=true;
 				$session=true;
 				$_SESSION['login']=$_POST['log'];
 				$_SESSION['userid']=$donnees['ID'];
 			}
		}
	}
	else {
		$resultat = $bdd->query('SELECT * FROM user');
		while ($donnees = $resultat->fetch()) {
			$nametest=false;
 			$bddlog=$donnees['login'];
 			if ($_POST['log']==$bddlog){
 				$nametest=true;
 			}
		}
		if ($nametest == false){
			$addData=$bdd->prepare('INSERT INTO user (login, pwd) VALUES (:login, :pwd)');	
			$addData->execute(array(
				'login' => $_POST['log'],
				'pwd' => md5($_POST['pwd'])
				));
		}
	}
}
if (!isset($_SESSION['login']) || $_SESSION['login']==""){
	$session=false;
}
else{
	$session=true;	
}
?>
<html>

<head>

<title>Website's title  - User menu</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="./css/website.css" />
 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="./js/website.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
<?php
if (isset ($_SESSION['login'])){
	echo '<div class="usermenu">';
	echo '<div class="shift">';
	echo '<p class="username">User : '.$_SESSION['login'].'</p>';
	include ('./menu.php');
	echo '</div>';
	echo '</div>';
}
else {
	if ($formfilled==true){	
		if ($_POST['switchnum']=="1"){
			if ($test==false){
				echo '<p class="error">Connexion Denied</p>';
			}
			else {
				echo '<p class="save">Connexion Granted</p>';
			}
		}
		if ($_POST['switchnum']=="0"){
			if ($nametest == false){
				echo '<p class="save">User account registered</p>';	
			}
			else {
				echo '<p class="error">This username is already used.</p>';
			}
		}
	}
	if ($session==false){
	echo '<div class="usermenu">';
	echo '<div class="shift">';
	echo '<div class="form">';
	echo '<p class="inboxtitle" id="switchtxt1a"> Register</p>';
	echo '<p class="inboxtitle" id="switchtxt2a" style="display:none"> Login</p>';
	echo '<p class="inbox" id="switchtxt1b"> To use all the feature of the website<br>';
	echo 'Please register by using the form below :</p>';
	echo '<p class="inbox" id="switchtxt2b" style="display:none"> <br>Login with the login and the password you used to register on the website :</p>';
	echo '<form method="POST" action="#">';
	echo '<INPUT type="text" hidden id="switchnum" name="switchnum" value="0">';
	echo '<div class="inboxstring">';
	echo 'Login : <input type="text" name="log" size="24" value="">';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	echo 'Password : <input type="password" name="pwd" size="24" value="">';
	echo '<br><br>';
	echo '<INPUT class="usercustombutton" type="submit" id="sendbutton" value="Create account">';
	echo '<div>';
	echo '<span class="txt" id="txt1">Already have an account ?</span>';
	echo '<span class="txt" id="txt2" style="display:none" >Don\'t have an account ?</span>';
	echo '<INPUT class="usercustombutton" type="button" id="switchtype" value="Login" onClick="switchlog()">';
	echo '</div>';
	echo '</div>';
	echo '</form>';
	echo '</div>';
	echo '<br>';
	echo '</div>';
	echo '</div>';
	}
}

?>




<!--<div id="pasf">
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6574971-1");
pageTracker._trackPageview();
} catch(err) {}
</script></div>-->
</body>

</html>