<?php
require_once('./controleur/Action.interface.php');
require_once('./vues/Page.class.php');

class CalendrierControleur implements Action {
	public function execute(){
		return new Page("calendrier", "TechDojo - Calendrier", null, null);
	}
}
?>