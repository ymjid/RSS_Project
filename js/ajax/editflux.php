<?php	
if (isset($_POST['setaction'])){
	echo $_POST['setaction'].' '.$_POST['numflux'].' '.$_POST['numuser'].' '.$_POST['namef'];
	include('./bdd/bdd.php');
	require_once("./rss/rsslib.php");
	switch ($_POST['setaction']){
		case "update":
			$resultat = $bdd->query('SELECT * FROM fluxrss WHERE numuser="'.$_POST['numuser'].'" && ID="'.$_POST['numflux'].'"');
			while ($donnees = $resultat->fetch()) {
				RSS_Update($donnees['link'], $_POST['numflux'],$_POST['numuser'], true);
			}
			break;
		case "desactive":
			$updateData = $bdd -> prepare('UPDATE fluxrss SET stateflux = :state WHERE ID="'.$_POST['numflux'].'" && numuser="'.$_POST['numuser'].'"');
			$updateData->execute(array(
						'state' => "desactivated"
						));
			$updateData2 = $bdd -> prepare('UPDATE rssarticle SET statearticle = :statearticle WHERE fluxID="'.$_POST['numflux'].'" && numuser="'.$_POST['numuser'].'"');
			$updateData2->execute(array(
						'statearticle' => "desactivated"
						));

			break;
		case "active":
			$updateData = $bdd -> prepare('UPDATE fluxrss SET stateflux = :state WHERE ID="'.$_POST['numflux'].'" && numuser="'.$_POST['numuser'].'"');
			$updateData->execute(array(
						'state' => "activated"
						));
			$updateData2 = $bdd -> prepare('UPDATE rssarticle SET statearticle = :statearticle WHERE fluxID="'.$_POST['numflux'].'" && numuser="'.$_POST['numuser'].'"');
			$updateData2->execute(array(
						'statearticle' => "activated"
						));

			break;
		case "edit":
			$updateData = $bdd -> prepare('UPDATE fluxrss SET name = :name WHERE ID="'.$_POST['numflux'].'" && numuser="'.$_POST['numuser'].'"');
			$updateData->execute(array(
						'name' => $_POST['namef']
						));
			break;
		case "erase":
			$updateData = $bdd -> prepare('UPDATE fluxrss SET stateflux = :state WHERE ID="'.$_POST['numflux'].'" && numuser="'.$_POST['numuser'].'"');
			$updateData->execute(array(
						'state' => "erase"
						));
			$updateData2 = $bdd -> prepare('UPDATE rssarticle SET statearticle = :statearticle WHERE fluxID="'.$_POST['numflux'].'" && numuser="'.$_POST['numuser'].'"');
			$updateData2->execute(array(
						'statearticle' => "erase"
						));


			break;

		default :	
	}
}
if (isset($_POST['usernum'])){
		echo $_POST['usernum'];
		include('./bdd/bdd.php');
		require_once("./rss/rsslib.php");
		$resultat = $bdd->query('SELECT * FROM fluxrss WHERE numuser="'.$_POST['usernum'].'"');
		while ($donnees = $resultat->fetch()) {
			RSS_Update($donnees['link'], $donnees['ID'], $_POST['usernum'], true);
		}
}
?>