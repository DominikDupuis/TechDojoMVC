<?php
require_once('./controleur/Action.interface.php');
require_once('./vues/Page.class.php');

class AccueilControleur implements Action {
	public function execute(){
		return new Page("accueil", "TechDojo - Accueil", null, null);
	}
}
?>