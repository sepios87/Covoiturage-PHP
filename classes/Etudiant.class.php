<?php
class Etudiant
{

	private $num, $divNum, $ville, $departement; //num = personne num

	function __construct($num, $depNum, $divNum)
	{
		$this->num = $num;
		$this->departement = new Departement($depNum, null, null);
		$this->divNum = $divNum;
	}

	public function getDepNum()
	{
		return $this->departement->getNum();
	}

	public function getDivNum()
	{
		return $this->divNum;
	}

	public function getNum()
	{
		return $this->num;
	}


	public function getVille()
	{
		return $this->ville;
	}

	public function setVille($ville)
	{
		$this->ville = $ville;

		return $this;
	}

	public function getDepartement()
	{
		return $this->departement;
	}

	public function setDepartement($departement)
	{
		$this->departement = $departement;

		return $this;
	}
}
