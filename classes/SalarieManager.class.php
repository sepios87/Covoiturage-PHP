<?php
class SalarieManager
{

	private $pdo;

	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function addSalarie($salarie)
	{
		$persNum = $salarie->getNum();
		$fonNum = $salarie->getFonNum();
		$tel = $salarie->getTel();
		$req = $this->pdo->prepare("INSERT INTO salarie (per_num, sal_telprof, fon_num) VALUES ($persNum, '$tel', $fonNum)");
		$retour = $req->execute();
		$req->closeCursor();
		return $retour;
	}

	public function getSalarieById($idSalarie)
	{

		$salarieRetour = NULL;

		$req = $this->pdo->prepare("SELECT * FROM salarie s, fonction f WHERE s.fon_num=f.fon_num AND per_num=$idSalarie");
		$req->execute();

		while ($salarie = $req->fetch(PDO::FETCH_OBJ)) {
			$salarieRetour = new Salarie($salarie->per_num, $salarie->sal_telprof, $salarie->fon_num);
			$salarieRetour->setFonction(new Fonction($salarie->fon_num, $salarie->fon_libelle));
		}

		$req->closeCursor();
		return $salarieRetour;
	}
}
