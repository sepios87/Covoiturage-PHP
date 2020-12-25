<?php
class Parcours
{

	private $num, $distance, $ville1, $ville2;

	function __construct($num, $distance, $ville_num1, $ville_num2)
	{
		$this->num = $num;
		$this->distance = $distance;
		$this->ville1 = new Ville($ville_num1, null);
		$this->ville2 = new Ville($ville_num2, null);
	}

	public function getDistance()
	{
		return $this->distance;
	}

	public function getVille1()
	{
		return $this->ville1;
	}

	public function getVille2()
	{
		return $this->ville2;
	}

	public function getNum()
	{
		return $this->num;
	}
}
