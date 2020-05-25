<?php
require_once('./controleur/Action.interface.php');
require_once('./vues/Page.class.php');

class BookingControleur implements Action {
	public function execute(){
		return new Page("booking", "TechDojo - Booking", null, null);
	}
}
?>