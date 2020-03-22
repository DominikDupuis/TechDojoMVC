<?php
require_once('./controleur/Action.interface.php');
require_once('./view/Page.class.php');

class CreateControleur implements Action {
	public function execute(){
		return new Page("create", "CALENDA. - Enregistrement", null, null);
	}
}
