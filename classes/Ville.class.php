<?php
class Ville
{

	private $num, $nom;

	function __construct($num, $nom)
	{
		$this->num = $num;
		$this->nom = $nom;
	}

	public function getNom()
	{
		return $this->nom;
	}

	public function getNum()
	{
		return $this->num;
	}

	public function setNom($nom)
	{
		$this->nom = $nom;

		return $this;
	}
}
