<?php
require_once('./controleur/Action.interface.php');
require_once('./view/Page.class.php');

class ErreurControleur implements Action {
	public function execute(){
		return new Page("erreur", "Mon site - Page inexistante", null, null);
	}
}
?>