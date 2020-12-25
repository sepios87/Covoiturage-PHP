<?php

class Captcha
{

    private $alea1, $alea2;

    function __construct()
    {
        $this->generNewValue();
    }

    public function generNewValue()
    {
        $this->alea1 = rand(1, 9);
        $this->alea2 = rand(1, 9);
    }

    public function getEgal($valeur)
    {
        $somme = $this->alea2 + $this->alea1;
        return empty($valeur) ? false : $valeur == ($somme);
    }

    public function getAlea1()
    {
        return $this->alea1;
    }

    public function getAlea2()
    {
        return $this->alea2;
    }
}
