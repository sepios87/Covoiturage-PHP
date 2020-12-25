<?php
class ParcoursManager
{

	private $pdo;

	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function addParcours($parcours)
	{
		$distance = $parcours->getDistance();
		$ville_num1 = $parcours->getVille1()->getNum();
		$ville_num2 = $parcours->getVille2()->getNum();
		$req = $this->pdo->prepare("INSERT INTO parcours (par_km, vil_num1, vil_num2) VALUES ($distance, $ville_num1, $ville_num2)");
		$retour = $req->execute();
		$req->closeCursor();
		return $retour;
	}

	public function getParcours()
	{

		$listeParcours = array();

		$req = $this->pdo->prepare("SELECT par_num, par_km ,V1.vil_num as vilnum1, V1.vil_nom as vilnom1, V2.vil_num as vilnum2, V2.vil_nom as vilnom2
			FROM parcours P, ville V1, ville V2 WHERE P.vil_num1 = V1.vil_num AND P.vil_num2 = V2.vil_num ORDER BY par_num");
		$req->execute();

		while ($parcours = $req->fetch(PDO::FETCH_OBJ)) {
			$parcoursTempo = new Parcours($parcours->par_num, $parcours->par_km, $parcours->vilnum1, $parcours->vilnum2);
			$parcoursTempo->getVille1()->setNom($parcours->vilnom1);
			$parcoursTempo->getVille2()->setNom($parcours->vilnom2);
			$listeParcours[] = $parcoursTempo;
		}

		$req->closeCursor();
		return $listeParcours;
	}

	public function getVilleParcours()
	{

		$listeVille = array();

		$req = $this->pdo->prepare("SELECT distinct vil_num, vil_nom 
			FROM parcours p, ville v WHERE p.vil_num1 = v.vil_num OR p.vil_num2 = v.vil_num");
		$req->execute();

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVille[] = new Ville($ville->vil_num, $ville->vil_nom);
		}

		$req->closeCursor();
		return $listeVille;
	}

	public function getParcoursByIdVilles($idVille2, $idVille1)
	{

		$req = $this->pdo->prepare("SELECT par_num, par_km ,V1.vil_num as vilnum1, V1.vil_nom as vilnom1, V2.vil_num as vilnum2, V2.vil_nom as vilnom2
			FROM parcours P, ville V1, ville V2 WHERE P.vil_num1 = V1.vil_num AND P.vil_num2 = V2.vil_num AND (P.vil_num1 = $idVille1 OR P.vil_num1 = $idVille2) 
			AND (P.vil_num2 = $idVille2 OR P.vil_num2 = $idVille1) ORDER BY par_num");
		$req->execute();

		while ($parcours = $req->fetch(PDO::FETCH_OBJ)) {
			$parcoursTempo = new Parcours($parcours->par_num, $parcours->par_km, $parcours->vilnum1, $parcours->vilnum2);
			$parcoursTempo->getVille1()->setNom($parcours->vilnom1);
			$parcoursTempo->getVille2()->setNom($parcours->vilnom2);
		}

		$req->closeCursor();
		return $parcoursTempo;
	}

	public function getParcoursById($idParcours)
	{

		$req = $this->pdo->prepare("SELECT par_num, par_km ,V1.vil_num as vilnum1, V1.vil_nom as vilnom1, V2.vil_num as vilnum2, V2.vil_nom as vilnom2
			FROM parcours P, ville V1, ville V2 WHERE P.vil_num1 = V1.vil_num AND P.vil_num2 = V2.vil_num AND par_num = $idParcours");
		$req->execute();

		while ($parcours = $req->fetch(PDO::FETCH_OBJ)) {
			$parcoursTempo = new Parcours($parcours->par_num, $parcours->par_km, $parcours->vilnum1, $parcours->vilnum2);
			$parcoursTempo->getVille1()->setNom($parcours->vilnom1);
			$parcoursTempo->getVille2()->setNom($parcours->vilnom2);
		}

		$req->closeCursor();
		return $parcoursTempo;
	}

	public function getVilleByIdVille($idVille)
	{
		$listeVille = array();

		$req = $this->pdo->prepare("SELECT vil_num, vil_nom FROM ville v, (
			SELECT V1.vil_num as vilnum1, V2.vil_num as vilnum2
			FROM parcours P, ville V1, ville V2 
			WHERE P.vil_num1 = V1.vil_num AND P.vil_num2 = V2.vil_num AND (vil_num1=$idVille OR vil_num2 = $idVille)
				)as T1
			WHERE (T1.vilnum1 = v.vil_num OR T1.vilnum2 = v.vil_num) and v.vil_num != $idVille");
		$req->execute();

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVille[] = new Ville($ville->vil_num, $ville->vil_nom);
		}

		$req->closeCursor();
		return $listeVille;
	}
}
