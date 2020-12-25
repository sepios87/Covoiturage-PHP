<?php
include_once("./include/config.inc.php");

class Mypdo extends PDO
{

	protected $dbo;

	public function __construct ()
	{
		if (ENV=='dev'){
			$bool=true;
		}
		else
		{
			$bool=false;
		}
		try {
			$this->dbo =parent::__construct("mysql:host=".DBHOST."; dbname=".DBNAME."; port=".DBPORT.";charset=UTF8", DBUSER, DBPASSWD,
			array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => $bool, PDO::ERRMODE_EXCEPTION => $bool));
			
		}
		catch (PDOException $e) {
			echo 'Echec lors de la connexion : ' . $e->getMessage();
		}
	}

}
