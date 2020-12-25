<?php
class Fonction
{

	private $num, $lib;

	function __construct($num, $lib)
	{
		$this->num = $num;
		$this->lib = $lib;
	}

	public function getLib()
	{
		return $this->lib;
	}

	public function getNum()
	{
		return $this->num;
	}

	public function setNum($num)
	{
		$this->num = $num;

		return $this;
	}
}
