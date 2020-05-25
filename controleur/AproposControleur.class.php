<?php
require_once('./controleur/Action.interface.php');
require_once('./vues/Page.class.php');

class AProposControleur implements Action {
    public function execute(){
        return new Page("apropos", "TechDojo - A propos", null, null);
    }
}
?>