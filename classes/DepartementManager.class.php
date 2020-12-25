<?php
class DepartementManager
{

	private $pdo;

	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	function addDepartement($departement)
	{
		$nomDep = $departement->getNom();
		$req = $this->pdo->prepare("INSERT INTO ville (DEP_NOM) VALUES ('$nomDep')");
		$retour = $req->execute();
		echo "valeur verif : $retour";
	}

	function getDepartement()
	{
		$listeDepartement = array();

		$req = $this->pdo->prepare("SELECT * FROM departement");
		$req->execute();

		while ($departement = $req->fetch(PDO::FETCH_OBJ)) {
			$listeDepartement[] = new Departement($departement->dep_num, $departement->dep_nom, $departement->vil_num);
		}

		$req->closeCursor();
		return $listeDepartement;
	}
}
