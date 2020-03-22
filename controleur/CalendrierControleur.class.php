<?php
require_once('./controleur/Action.interface.php');
require_once('./view/Page.class.php');

class CalendrierControleur implements Action {
	public function execute(){
		return new Page("calendrier", "CALENDA. - Calendriers", null, null);
	}
}
?>