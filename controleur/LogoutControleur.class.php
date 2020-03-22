<?php
require_once('./controleur/Action.interface.php');
require_once('./view/Page.class.php');

class LogoutControleur implements Action
{
    public function execute()
    {
        return new Page("logout", "CALENDA. - Connection", null, null);
    }
}
