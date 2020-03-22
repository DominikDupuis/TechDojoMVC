<?php
require_once('./controleur/Action.interface.php');
require_once('./view/Page.class.php');

class LoginControleur implements Action
{
    public function execute(){
		if (!ISSET($_REQUEST["email"]))
			return new Page("login", "CALENDA. - Connexion", null, null);
		if (!$this->valide())
		{
			//$_REQUEST["global_message"] = "Le formulaire contient des erreurs. Veuillez les corriger.";	
			return new Page("login", "CALENDA. - Connexion", null, null);
		}

		$udao = new UserDAO();
		$user = $udao->find($_REQUEST["email"]);
		if ($user == null)
			{
				$_REQUEST["field_messages"]["email"] = "Utilisateur inexistant.";	
				return new Page("login", "CALENDA. - Connexion", null, null);
			}
		else if ($user->getPassword() != $_REQUEST["password"])
			{
				$_REQUEST["field_messages"]["password"] = "Mot de passe incorrect.";	
				return new Page("login", "CALENDA. - Connexion", null, null);
			}
		if (!ISSET($_SESSION)) session_start();
		$_SESSION["connected"] = $_REQUEST["email"];
		return new Page("accueil", "CALENDA. - Accueil", null, null);
	}
	public function valide()
	{
		$result = true;
		if ($_REQUEST['email'] == "")
		{
			$_REQUEST["field_messages"]["email"] = "Donnez votre nom d'utilisateur";
			$result = false;
		}	
		if ($_REQUEST['password'] == "")
		{
			$_REQUEST["field_messages"]["password"] = "Mot de passe obligatoire";
			$result = false;
		}	
		return $result;
	}
}
