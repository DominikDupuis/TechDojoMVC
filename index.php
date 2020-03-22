<?php
	// -- Contr�leur frontal --
    require_once('controleur/Routeur.class.php');
	//print_r($_REQUEST);
	if (ISSET($_REQUEST["action"]))
		{
			//$vue = ActionBuilder::getAction($_REQUEST["action"])->execute();
			/*
			Ou :*/
			$actionDemandee = $_REQUEST["action"];
			//echo $actionDemandee;
			$controleur = Routeur::getAction($actionDemandee);
			$vue = $controleur->execute();
			/**/
		}
	else	
		{
			$action = Routeur::getAction("accueil");
			$vue = $action->execute();
		}

	echo $vue->genererContenu();
?>
