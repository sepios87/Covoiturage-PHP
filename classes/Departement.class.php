<?php
class Departement
{

	private $num, $nom, $vil_num;

	function __construct($num, $nom, $vil_num)
	{
		$this->num = $num;
		$this->nom = $nom;
		$this->vil_num = $vil_num;
	}

	public function getNom()
	{
		return $this->nom;
	}

	public function getNum()
	{
		return $this->num;
	}
}
