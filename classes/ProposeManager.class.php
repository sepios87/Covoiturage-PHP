<?php
class ProposeManager
{

	private $pdo;

	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function addPropose($propose)
	{
		$par_num = $propose->getParcoursNum();
		$per_num = $propose->getPersonneNum();
		$date = $propose->getDate();
		$time = $propose->getTime();
		$place = $propose->getPlace();
		$sens = $propose->getSens();
		$req = $this->pdo->prepare("INSERT INTO propose (par_num, per_num, pro_date, pro_time, pro_place, pro_sens) 
			VALUES ($par_num, $per_num, '$date', '$time', $place, $sens)");
		$retour = $req->execute();
		$req->closeCursor();
		return $retour;
	}

	public function getPropose($idVilleDepart, $idVilleArrive, $time, $dateDepart, $precision)
	{
		$listePropose = array();

		$dateMax = date('Y-m-d', strtotime($dateDepart.' + '.$precision.' days'));
		$dateMin = date('Y-m-d', strtotime($dateDepart.' - '.$precision.' days'));



		$req = $this->pdo->prepare("SELECT * FROM propose pr, parcours pa WHERE pa.par_num=pr.par_num AND (pa.vil_num1 = $idVilleDepart OR pa.vil_num1 = $idVilleDepart 	OR 
		pa.vil_num2 = $idVilleDepart OR pa.vil_num2 = $idVilleDepart) AND (pa.vil_num1 = $idVilleArrive OR pa.vil_num1 = $idVilleArrive 	OR 
		pa.vil_num2 = $idVilleArrive OR pa.vil_num2 = $idVilleArrive) AND pro_time > '$time' AND pro_date BETWEEN '$dateMin' AND '$dateMax'");
		
		$req->execute();

		while ($propose = $req->fetch(PDO::FETCH_OBJ)) {
			if (($propose->pro_sens == 0 && $propose->vil_num1 == $idVilleDepart) || ($propose->pro_sens == 1 && $propose->vil_num2 == $idVilleDepart))
				$listePropose[] = new Propose($propose->par_num, $propose->per_num, $propose->pro_date, $propose->pro_time, $propose->pro_place, $propose->pro_sens);
		}

		$req->closeCursor();
		return $listePropose;
	}
}
