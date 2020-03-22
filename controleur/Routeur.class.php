<?php
require_once('./controleur/AccueilControleur.class.php');
require_once('./controleur/A_proposControleur.class.php');
require_once('./controleur/ErreurControleur.class.php');
require_once('./controleur/ContactControleur.class.php');
require_once('./controleur/CalendrierControleur.class.php');
require_once('./controleur/BookingControleur.class.php');
require_once('./controleur/TestControleur.class.php');
require_once( './controleur/LoginControleur.class.php');
require_once('./controleur/LogoutControleur.class.php');
require_once('./controleur/CreateControleur.class.php');
require_once('./controleur/WelcomeControleur.class.php');


class Routeur{
	public static function getAction($nomAction){

		$classe = ucfirst($nomAction) . 'Controleur';
		if (class_exists($classe)) {
			return new $classe();
		} else {
			return new ErreurControleur();
		}

	}
}
?>
