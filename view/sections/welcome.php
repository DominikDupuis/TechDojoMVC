<?php
// Initialise la session
session_start();
 
// Vérifie si l'utilisateur est connecter sinon l'envoyer à la page de connexion
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <link href="https://fonts.googleapis.com/css?family=Cutive+Mono|Major+Mono+Display" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styleLogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Bienvenue .</title>
</head>
<body>
	<?php $page = 'acceuil'; include 'include/Navbar.php';?>
    <div class="jumbotron">
        <h1>Bonjour, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b>. Bienvenue sur notre site.</h1>
		<p>
        <a href="reset-password.php" class="btn btn-warning">Réinitialiser votre mot de passe</a>
        <a href="logout.php" class="btn btn-danger">Déconnexion</a>
    </p>
    </div>
    
	<?php include 'include/Footer.php' ?> 
</body>
</html>