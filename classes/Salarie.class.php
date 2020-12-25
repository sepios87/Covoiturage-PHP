<?php
class Salarie
{

	private $num, $tel, $fonction;

	function __construct($num, $tel, $fonNum)
	{
		$this->num = $num;
		$this->tel = $tel;
		$this->fonction = new Fonction($fonNum, null);
	}

	public function getTel()
	{
		return $this->tel;
	}

	public function getFonNum()
	{
		return $this->fonction->getNum();
	}

	public function getNum()
	{
		return $this->num;
	}

	public function setFonction($fonction)
	{
		$this->fonction = $fonction;

		return $this;
	}
}
