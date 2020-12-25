<?php

class AvisManager
{

    private $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getMoyenne($idPersonne)
    {
        $req = $this->pdo->prepare("SELECT AVG(avi_note) as moy FROM avis WHERE per_per_num=$idPersonne");
        $req->execute();

        $moyenne = $req->fetch(PDO::FETCH_OBJ)->moy;

        return $moyenne;
    }

    public function getLastCom($idPersonne)
    {
        $req = $this->pdo->prepare("SELECT max(avi_date), avi_comm FROM avis WHERE per_per_num=$idPersonne group by avi_comm");
        $req->execute();

        $comm = $req->fetch(PDO::FETCH_OBJ)->avi_comm;

        return $comm;
    }
}
