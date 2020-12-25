<?php
class Propose
{
	private $parcoursNum, $personneNum, $date, $time, $place, $sens;

	public function __construct($parcoursNum, $personneNum, $date, $time, $place, $sens)
	{
		$this->parcoursNum = $parcoursNum;
		$this->personneNum = $personneNum;
		$this->date = $date;
		$this->time = $time;
		$this->place = $place;
		$this->sens = $sens;
	}

	public function getParcoursNum()
	{
		return $this->parcoursNum;
	}

	public function getPersonneNum()
	{
		return $this->personneNum;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getTime()
	{
		return $this->time;
	}

	public function getPlace()
	{
		return $this->place;
	}

	public function getSens()
	{
		return $this->sens;
	}
}
