<?php
class PersonneManager
{

	private $pdo;

	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function addPersonne($personne)
	{
		$nom = $personne->getNom();
		$prenom = $personne->getPrenom();
		$mail = $personne->getMail();
		$tel = $personne->getTel();
		$login = $personne->getLogin();
		$pwd = $personne->getPwd();
		$req = $this->pdo->prepare("INSERT INTO personne (per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd) 
			VALUES ('$nom', '$prenom', '$tel', '$mail', '$login', '$pwd')");
		$req->execute();
		$req->closeCursor();
	}

	public function getPersonne()
	{

		$listePersonne = array();

		$req = $this->pdo->prepare("SELECT * FROM personne");
		$req->execute();

		while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
			$listePersonne[] = new Personne(
				$personne->per_num,
				$personne->per_nom,
				$personne->per_prenom,
				$personne->per_tel,
				$personne->per_mail,
				$personne->per_login,
				$personne->per_pwd
			);
		}
		$req->closeCursor();

		return $listePersonne;
	}

	public function getByIdPersonne($idPersonne)
	{

		$req = $this->pdo->prepare("SELECT * FROM personne WHERE per_num=$idPersonne");
		$req->execute();

		while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
			$personneRetour = new Personne(
				$personne->per_num,
				$personne->per_nom,
				$personne->per_prenom,
				$personne->per_tel,
				$personne->per_mail,
				$personne->per_login,
				$personne->per_pwd
			);
		}

		$req->closeCursor();
		return $personneRetour;
	}

	public function getByLoginPwdPersonne($login, $pwd)
	{

		$personneRetour = null;

		$req = $this->pdo->prepare("SELECT * FROM personne WHERE per_login='$login' AND per_pwd='$pwd'");
		$req->execute();

		while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
			$personneRetour = new Personne(
				$personne->per_num,
				$personne->per_nom,
				$personne->per_prenom,
				$personne->per_tel,
				$personne->per_mail,
				$personne->per_login,
				$personne->per_pwd
			);
		}
		$req->closeCursor();
		return $personneRetour;
	}

	public function getIdPersonne($personne)
	{
		$nom = $personne->getNom();
		$prenom = $personne->getPrenom();
		$tel = $personne->getTel();
		$req = $this->pdo->prepare("SELECT * FROM personne WHERE per_tel='$tel' AND per_nom='$nom' AND per_prenom='$prenom'");
		$req->execute();

		$num = $req->fetch(PDO::FETCH_OBJ)->per_num;
		$req->closeCursor();

		return $num;
	}

	public function modifPersonne($personne)
	{
		$num = $personne->getNum();
		$nom = $personne->getNom();
		$prenom = $personne->getPrenom();
		$mail = $personne->getMail();
		$tel = $personne->getTel();
		$req = $this->pdo->prepare("UPDATE personne SET per_nom='$nom', per_prenom='$prenom', per_mail='$mail', per_tel='$tel' WHERE per_num=$num");
		$retour = $req->execute();
		$req->closeCursor();
		return $retour;
	}

	public function suppPersonne($idPersonne)
	{
		$req = $this->pdo->prepare("DELETE FROM propose WHERE per_num=$idPersonne");
		$req->execute();
		$req = $this->pdo->prepare("DELETE FROM etudiant WHERE per_num=$idPersonne");
		$req->execute();
		$req = $this->pdo->prepare("DELETE FROM salarie WHERE per_num=$idPersonne");
		$req->execute();
		$req = $this->pdo->prepare("DELETE FROM personne WHERE per_num=$idPersonne");
		$retour = $req->execute();
		$req->closeCursor();

		return $retour;
	}
}
