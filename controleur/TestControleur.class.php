<?php
require_once('./controleur/Action.interface.php');
require_once('./view/Page.class.php');

class TestControleur implements Action {
	public function execute(){
		return new Page("test", "CALENDA. - test", null, null);
	}
}
?>