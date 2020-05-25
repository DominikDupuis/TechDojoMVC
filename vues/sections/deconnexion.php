<?php
//On efface la valeur de la session afin de se deconnecter.
if (!ISSET($_SESSION)) {
    session_start();
    }    
UNSET($_SESSION['username']);
header('Location: ?action=accueil');

?>