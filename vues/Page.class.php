<?php
class Page{

    private $section;
    private $titre;
    private $message;
    private $data;

    public function __construct($section, $titre, $data, $message)
    {
        $this->section = $section;
        $this->titre = $titre;
        $this->data = $data;
        $this->message = $message;
    }

    //Afficher la views que le routeur demande.
    public function genererContenu()
    {
        ob_start();
            $data = $this->data;
            $message = $this->message;
            require("./vues/sections/".$this->section.".php");
        $contenu = ob_get_clean();

        $titre = $this->titre;

        ob_start();
            require("./vues/sections/gabarit.php");
        return ob_get_clean();
    }

    public function setTitre($value)
    {
        $this->titre = $value;
    }

    public function setMessage($value)
    {
        $this->message = $value;
    }

    public function setData($value)
    {
        $this->data = $value;
    }

    public function setVue($value)
    {
        $this->vue = $value;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getMessage()
    {
        return $this->message;
    }
    
    public function getData()
    {
        return $this->data;
    }

    public function getVue()
    {
        return $this->vue;
    }

}
?>