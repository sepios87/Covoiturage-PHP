<?php
class Personne
{

	private $num, $nom, $prenom, $tel, $mail, $login, $pwd;

	function __construct($num, $nom, $prenom, $tel, $mail, $login, $pwd)
	{
		$this->num = $num;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->tel = $tel;
		$this->mail = $mail;
		$this->login = $login;
		$this->pwd = $pwd;
	}

	public function getNom()
	{
		return $this->nom;
	}

	public function getPrenom()
	{
		return $this->prenom;
	}

	public function getTel()
	{
		return $this->tel;
	}

	public function getMail()
	{
		return $this->mail;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function getPwd()
	{
		return $this->pwd;
	}

	public function getNum()
	{
		return $this->num;
	}

	public function setNum($num)
	{
		$this->num = $num;
	}
}
