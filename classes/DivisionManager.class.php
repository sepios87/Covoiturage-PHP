<?php
class DivisionManager
{

	private $pdo;

	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	function getDivision()
	{
		$listeDivision = array();

		$req = $this->pdo->prepare("SELECT * FROM division");
		$req->execute();

		while ($division = $req->fetch(PDO::FETCH_OBJ)) {
			$listeDivision[] = new Division($division->div_num, $division->div_nom);
		}

		$req->closeCursor();
		return $listeDivision;
	}
}
