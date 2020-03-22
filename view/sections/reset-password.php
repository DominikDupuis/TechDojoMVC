<?php
// Initialise la session
session_start();
 
// Vérifie si l'utilisateur est connecté sinon l'envoyer à la page de connexion
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Inclure le fichier config
require_once "config.php";
 
// Définition des variables
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Effectuer la tache quand l'utilisateur envoye
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Valide le nouveau mot de passe
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Veuillez entrer un nouveau mot de passe.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Le mot de passe doit avoir au moins 6 caractères.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Valide la confirmation du mot de passe
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Veuillez confirmer le mot de passe.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Le mot de passe ne concorde pas.";
        }
    }
        
    // Vérifie pour des erreurs avant de mettre la BD à jour
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare la commande de UPDATE
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Lie les variables avec la commandes
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Met les valeurs dans les paramètres
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Tente d'effectuer la commande
            if(mysqli_stmt_execute($stmt)){
                // Le mot de passe à été changer, ferme la session et redirige vers la connexion
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Il y a eu une erreure, veuillez retenter plus tard.";
            }
        }
        
        // Fermeture de la commande
        mysqli_stmt_close($stmt);
    }
    
    // Fermeture de connexion
    mysqli_close($link);
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
    <title>Réinitialisation .</title>
</head>
<body>
	<?php $page = 'acceuil'; include '../include/Navbar.php';?>
    <div class="jumbotron">
        <h2>Réinitialiser le mot de passe</h2>
        <p>Veuillez compléter le formulaire pour réinitialiser votre mot de passe.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Nouveau mot de passe</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmez le mot de passe</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Soumettre">
                <a class="btn btn-link" href="welcome.php">Annulez</a>
            </div>
        </form>
    </div> 
	<?php include '../include/Footer.php' ?> 	
</body>
</html>