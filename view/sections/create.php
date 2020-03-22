<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Veuillez entrez une adresse courriel.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM membres WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Un compte existe déjà à cette adresse.";
                } else {
                    $username = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Une erreure c'est produite. Veuillez réessayer plus tard.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Veuillez entrez un mot de passe.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Le mot de passe doit avoir au moins 6 caractères.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Veuillez confirmez le mot de passe.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Le mot de passe ne concorde pas.";
        }
    }

    // Check input errors before inserting in database
    if (empty($password_err) && empty($confirm_password_err) && empty($email_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO membres (email, pass, date_inscription) VALUES (?, ?, ?)";
        echo $sql;
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 'sss', $param_email, $param_password, $param_date);


            // Set parameters
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            echo $param_password;
            $param_email = $email;
            echo $param_email;
            $param_date = date("Y-m-d");
            echo $param_date;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                
            } else {
                die('Error with prepare: ') . htmlspecialchars(mysqli_error($stmt));
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styleLogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Enregistrement .</title>
</head>

<body>
    <?php $page = 'acceuil';
    ?>
    <div class="jumbotron">
        <h2>Enregistrement</h2>
        <p>Veuillez entrez toutes les informations pour vous créer un compte.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Adresse courriel</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmez le mot de passe</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Soumettre">
                <input type="reset" class="btn btn-default" value="Effacer">
            </div>
            <p>Vous avez déja un compte? <a href="?action=login">Connectez-vous ici.</a>.</p>
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>