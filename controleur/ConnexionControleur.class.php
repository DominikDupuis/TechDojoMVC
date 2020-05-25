<?php
require_once('./controleur/Action.interface.php');
require_once('./vues/Page.class.php');

class ConnexionControleur implements Action {
	public function execute(){
		return new Page("connexion", "TechDojo - Connexion", null, null);
	}
}
?>