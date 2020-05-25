<?php
require_once('./controleur/Action.interface.php');
require_once('./vues/Page.class.php');

class WelcomeControleur implements Action {
	public function execute(){
		return new Page("welcome", "TechDojo - Mon compte", null, null);
	}
}
?>