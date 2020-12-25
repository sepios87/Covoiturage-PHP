<?php
class EtudiantManager
{

	private $pdo;

	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function addEtudiant($etudiant)
	{
		$depNum = $etudiant->getDepNum();
		$divNum = $etudiant->getDivNum();
		$persNum = $etudiant->getNum();
		$req = $this->pdo->prepare("INSERT INTO etudiant (per_num, dep_num, div_num) VALUES ($persNum, $depNum, $divNum)");
		$retour = $req->execute();
		$req->closeCursor();
		return $retour;
	}

	public function getEtudiantById($idEtudiant)
	{

		$etudiantRetour = NULL;

		$req = $this->pdo->prepare("SELECT * FROM etudiant e, departement d, ville v 
			WHERE e.dep_num=d.dep_num AND d.vil_num=v.vil_num AND per_num=$idEtudiant");
		$req->execute();

		while ($etudiant = $req->fetch(PDO::FETCH_OBJ)) {
			$etudiantRetour = new Etudiant($etudiant->per_num, $etudiant->dep_num, $etudiant->div_num);
			$etudiantRetour->setDepartement(new Division($etudiant->dep_num, $etudiant->dep_nom));
			$etudiantRetour->setVille(new Ville($etudiant->vil_num, $etudiant->vil_nom));
		}

		$req->closeCursor();
		return $etudiantRetour;
	}
}
