<?php
require_once('./controleur/Action.interface.php');
require_once('./view/Page.class.php');

class A_proposControleur implements Action {
	public function execute(){
		return new Page("a_propos", "CALENDA. - À propos", null, null);
	}
}
