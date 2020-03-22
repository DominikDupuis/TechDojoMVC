<?php
require_once('./controleur/Action.interface.php');
require_once('./view/Page.class.php');

class AccueilControleur implements Action {
	public function execute(){
		return new Page("accueil", "CALENDA. - Accueil", null, null);
	}
}
?>