<div id="texte">
	<?php
	if (!empty($_GET["page"])) {
		$page = $_GET["page"];
	} else {
		$page = 0;
	}

	switch ($page) {

		case 0:
			include_once('pages/accueil.inc.php');
			break;

		case 1:
			include("pages/ajouterPersonne.inc.php");
			break;

		case 2:
			include_once('pages/listerPersonnes.inc.php');
			break;
		case 3:
			include("pages/ModifierPersonne.inc.php");
			break;

		case 4:
			include_once('pages/supprimerPersonne.inc.php');
			break;

		case 5:
			include("pages/ajouterParcours.inc.php");
			break;

		case 6:
			include("pages/listerParcours.inc.php");
			break;

		case 7:
			include("pages/ajouterVille.inc.php");
			break;

		case 8:
			include("pages/listerVilles.inc.php");
			break;

		case 9:
			include_once('pages/ProposerTrajet.inc.php');
			break;
		case 10:
			include_once('pages/ChercherTrajet.inc.php');
			break;

		case 11:
			include_once('pages/Connexion.inc.php');
			break;

		case 12:
			include_once('pages/Deconnexion.inc.php');
			break;

		default:
			include_once('pages/accueil.inc.php');
	}

	?>
</div>