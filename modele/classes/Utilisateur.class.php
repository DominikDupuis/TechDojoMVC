<?php
class Utilisateur{
    protected $id;
    protected $pseudo;
    protected $courriel;
    protected $mdp;

    public function __construct($n="XXX000")
    {
        $this->pseudo = $n;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getCourriel()
    {
        return $this->courriel;
    }

    public function setCourriel($courriel)
    {
        $this->courriel = $courriel;
    }

    public function getMDP()
    {
        return $this->mdp;
    }
    

    public function setMDP($mdp)
    {
        $this->mdp = $mdp;
    }

    public function __toString()
    {
        return "User[".$this->pseudo.", ".$this->mdp."]";
    }

    public function affiche()
    {
        echo $this->__toString();
    }


}
?>