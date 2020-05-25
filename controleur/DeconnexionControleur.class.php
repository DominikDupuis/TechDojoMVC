<?php
require_once('./controleur/Action.interface.php');
require_once('./vues/Page.class.php');

class DeconnexionControleur implements Action {
	public function execute(){
		return new Page("deconnexion", "TechDojo - Deconnexion", null, null);
	}
}
?>