<?php
require_once('./controleur/Action.interface.php');
require_once('./vues/Page.class.php');

class ModifierBookingControleur implements Action {
	public function execute(){
		return new Page("modifierBooking", "TechDojo - Modifier le rendez-vous", null, null);
	}
}
?>