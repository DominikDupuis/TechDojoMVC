<?php
require_once('./controleur/Action.interface.php');
require_once('./view/Page.class.php');

class ContactControleur implements Action {
	public function execute(){
		return new Page("contact", "CALENDA. - Contact", null, null);
	}
}
?>