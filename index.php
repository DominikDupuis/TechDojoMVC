<?php
	// -- Contrôleur frontal --
	require_once('./controleur/Routeur.class.php');

	if (ISSET($_REQUEST["action"]))
		{

			$actionDemandee = $_REQUEST["action"];
			$controleur = Routeur::getAction($actionDemandee);
			$vue = $controleur->execute();
		}
	else	
		{
			$action = Routeur::getAction("accueil");
			$vue = $action->execute();
		}

	echo $vue->genererContenu();
?>
