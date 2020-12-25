<?php
class VilleManager
{

	private $pdo;

	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function addVille($ville)
	{
		$nomVille = $ville->getNom();
		$req = $this->pdo->prepare("INSERT INTO ville (vil_nom) VALUES ('$nomVille')");
		$retour = $req->execute();
		$req->closeCursor();
		return $retour;
	}

	public function getVille()
	{

		$listeVille = array();

		$req = $this->pdo->prepare("SELECT * FROM ville order by vil_nom asc");
		$req->execute();

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$listeVille[] = new Ville($ville->vil_num, $ville->vil_nom);
		}

		$req->closeCursor();
		return $listeVille;
	}

	public function getVilleById($idVille)
	{

		$req = $this->pdo->prepare("SELECT * FROM ville WHERE vil_num = $idVille");
		$req->execute();

		while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
			$villeRetour = new Ville($ville->vil_num, $ville->vil_nom);
		}

		$req->closeCursor();
		return $villeRetour;
	}
}
