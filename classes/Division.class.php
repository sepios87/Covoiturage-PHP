<?php
class Division
{

    private $num, $nom;

    public function __construct($num, $nom)
    {
        $this->num = $num;
        $this->nom = $nom;
    }

    public function getNum()
    {
        return $this->num;
    }

    public function getNom()
    {
        return $this->nom;
    }
}
