<?php 
session_start();

	session_destroy();
	$_SESSION['login']="";
	$_SESSION['userid']="";
	header('Location: ./home.php');

?>