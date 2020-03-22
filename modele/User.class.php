<?php

class User {
	private $id = "";
    private $mdp = "";
    private $email = "";
    private $phone = "";
    private $client;
    
	public function __construct($id, $mdp, $email, $phone, $client) {
        $this->id = $id;
        $this->mdp = $mdp;
        $this->email = $email;
        $this->phone = $phone;
        $this->client = $client;
	}	
	
	public function getId() {
			return $this->id;
	}
	
	public function setId($value) {
			$this->id = $value;
	}
        
	public function getMdp() {
			return $this->mdp;
	}
	
	public function setMdp($value) {
			$this->mdp = $value;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($value) {
        $this->phone = $value;
    }

    public function getClient() {
        return $this->mdp;
    }

    public function setClient($value) {
        $this->client = $value;
    }

	public function __toString() {
		return "User[".$this->id.", ".$this->mdp.", ".$this->email.", ".$this->phone."]";
	}
    
    public function affiche() {
		echo $this->__toString();
    }
    
	public function loadFromRecord($ligne) {
		$this->id = $ligne["NUMID"];
		$this->mdp = $ligne["MDP"];
	}	
}
?>