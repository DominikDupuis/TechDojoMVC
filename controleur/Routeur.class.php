<?php
require_once('./controleur/AccueilControleur.class.php');
require_once('./controleur/AproposControleur.class.php');
require_once('./controleur/ConnexionControleur.class.php');
require_once('./controleur/DeconnexionControleur.class.php');
require_once('./controleur/ContactControleur.class.php');
require_once('./controleur/WelcomeControleur.class.php');
require_once('./controleur/ErreurControleur.class.php');
require_once('./controleur/CalendrierControleur.class.php');
require_once('./controleur/BookingControleur.class.php');
require_once('./controleur/ModifierBookingControleur.class.php');

class Routeur{
    public static function getAction($nomAction){
        $classe = ucfirst($nomAction) . 'Controleur';
        if (class_exists($classe)){
            return new $classe();
        } else{
            return new ErreurControleur();
        }
    }
}
?>