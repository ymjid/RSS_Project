<?php	
	echo $_POST['numitem'].' '.$_POST['nuser'];
	include('./bdd/bdd.php');
	$addData = $bdd -> prepare('UPDATE rssarticle SET state = :etat WHERE articleID="'.$_POST['numitem'].'" && numuser="'.$_POST['nuser'].'"');
	$addData->execute(array(
						'etat' => "0"
						));
?>