<?php
class FonctionManager
{

	private $pdo;

	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	function getFonction()
	{
		$listeFonction = array();

		$req = $this->pdo->prepare("SELECT * FROM fonction");
		$req->execute();

		while ($fonction = $req->fetch(PDO::FETCH_OBJ)) {
			$listeFonction[] = new Fonction($fonction->fon_num, $fonction->fon_libelle);
		}

		$req->closeCursor();
		return $listeFonction;
	}
}
