<?php
// Initialise la session
session_start();
 
// Efface toute les variables de la session
$_SESSION = array();
 
// Detruit la session.
session_destroy();
 
// Redirige à la page de connexion
header("location: login.php");
exit;
?>