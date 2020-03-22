<?php
// Commence la sessions
session_start();
 
// Vérifie si l'utilisateur est connecté
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Inclut la config de la BD
require_once "config.php";
 
// définis les variables
$email = $password = "";
$email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"and isset($_POST['Connexion'])){
 
    // Vérifie si l'utilisateur est vide
    if(empty(trim($_POST["email"]))){
        $email_err = "Veuillez entrez votre courriel.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Vérifie si le password est vide
    if(empty(trim($_POST["password"]))){
        $password_err = "Veuillez entrez votre mot de passe.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Valide les infos avec la BD
    if(empty($email_err) && empty($password_err)){
        // Prépare le select
        $sql = "SELECT id, email, pass FROM membres WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Lie les variable à la commande
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // set les variables
            $param_email = $email;
            
            // essaye de rouler la commande
            if(mysqli_stmt_execute($stmt)){
                // store le résultat
                mysqli_stmt_store_result($stmt);
                
                // Vérifie si l'usager existe et si oui si le mot de passe est bon
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Lie le resultat au variable
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Le mot de passe est bon alors commence une session
                            session_start();
                            
                            // met les valeurs dans les variables de sessions
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;                            
                            
                            // Redirige à la page de bienvenue
                            header("location: welcome.php");
                        } else{
                            // Affiche une erreur si le mot de passe n'est pas bon
                            $password_err = "Le mot de passe n'est pas valide.";
                        }
                    }
                } else{
                    // Affiche si l'utilisateur n'existe pas
                    $email_err = "Aucun utilisateur a été trouvé.";
                }
            } else{
                echo "Oops! Une erreure c'est produite. Veuillez réessayer plus tard.";
            }
        }
        
        // ferme la commande
        mysqli_stmt_close($stmt);
    }
    
    // Ferme la connexion
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
    <title>Connexion .</title>
</head>
<body>
	<?php $page = 'acceuil'; ?>
    <div class="jumbotron">
        <h2>Connexion</h2>
        <p>Veuillez entrez vos informations pour vous connecter.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Courriel: </label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Mot de passe: </label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Connexion">
            </div>
            <p>Vous n'avez pas encore de compte? <a href="?action=create">Enregistrer vous maintenant!</a>.</p>
        </form>
    </div>  
	<section class="avantages">
        <div class="container-fluid">
            <div class="row avantages">
                <div class="col-lg-4 col-md-6 box-avantage">
                    <img class="img-avantage custom-img" src="../images/custom_icon.png">
                    <h5>AGENDA À VOTRE IMAGE</h5>
                    <hr>
                    <p class="description-avantage">
                        <span class="calenda-ref">Calenda. </span> vous offre la possibilité de personnalisable l'environnement
                        visuel de votre agenda. Que ce soit avec vos propres logos, photos ou couleurs.   
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 box-avantage">
                    <img class="img-avantage custom-img" src="../images/logo_horloge.png">
                    <h5>AGENDA FIABLE POUR UN HORAIRE CHARGÉ</h5>
                    <hr>
                    <p class="description-avantage">
                        Vous pourrez ajuster en temps réel votre agenda pour permettre à vos clients de prendre le rendez-vous qui leurs
                        conviendra le mieux. Plus de plage vides, plus d'appels pour combler vos annulations !
                    </p>
                </div>
                <div class="col-lg-4 offset-lg-0 col-md-6 offset-md-3 box-avantage">
                    <img class="img-avantage custom-img" src="../images/logoFacile.png">
                    <h5>SIMPLE COMME "BONJOURS"</h5>
                    <hr>
                    <p class="description-avantage">
                        Grâce à notre programme qui saura vous guider au cours de la construction de votre calendrier, vous pourrez annoncer
                        à vos clients que votre <span class="calenda-ref">Calenda. </span> est fin prêt à être utiliser.
                    </p>
                </div>
            </div>
        </div>
    </section>
	  
</body>
</html>