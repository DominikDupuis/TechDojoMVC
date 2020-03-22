<?php
require_once('./controleur/Action.interface.php');
require_once('./view/Page.class.php');

class BookingControleur implements Action {
	public function execute(){
		return new Page("booking", "CALENDA. - Booking", null, null);
	}
}
?>