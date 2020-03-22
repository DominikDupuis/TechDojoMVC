<?php
require_once('./controleur/Action.interface.php');
require_once('./view/Page.class.php');

class WelcomeControleur implements Action
{
    public function execute()
    {
        return new Page("welcome", "CALENDA. - Compte", null, null);
    }
}
