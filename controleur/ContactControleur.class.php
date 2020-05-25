<?php
require_once('./controleur/Action.interface.php');
require_once('./vues/Page.class.php');

class ContactControleur implements Action {
	public function execute(){
		return new Page("contact", "TechDojo - Contact", null, null);
	}
}
?>