<?php
if (!ISSET($_SESSION)) {
    session_start();
}
    

$username = $password = $confirm_password = $email = "";

require_once "./modele/UtilisateurDAO.class.php";

//Vérifie si on est connecter
if (isset($_SESSION['username'])){
    header("location: ?action=welcome");
}

//Connexion
if (isset($_POST['log_user'])){
    $p = new UserDAO();
    $username = strip_tags(trim($_POST['userLog']));
    $password = strip_tags(trim($_POST['passLog']));
    //On vérifie que les champs sont bien remplis.
    if(empty($username)){
        $errorMsg[] = "Veuillez entrez un nom d'utilisateur";
    }else if(empty($password)){
        $errorMsg[] = "Veuillez entrez un mot de passe";
    }else{
        try{
            
            if($row = $p::findUser($username)){
                //On vérifie que le nom d'utilisateur ainsi que le mot de passe concorde.
                if($username == $row['username']){
                    if(password_verify($password, $row['pass'])){
                        $_SESSION['username'] = $row['username'];
                        header("location: ?action=welcome");
                    }
                    else{
                        $errorMsg[] = "Mauvais mot de passe";
                    }    
                }else{
                    $errorMsg[] = "Mauvais nom d'utilisateur";
                }
            }else{
                $errorMsg[] = "Mauvais nom d'utilisateur";
            }
        } catch(PDOException $e){
            $e->getMessage();
        }
    }
}

//Inscription
if (isset($_POST['reg_user'])){
    $p = new UserDAO ();

    /*Vérification des champs de nom d'utilisateur.
    On vérifie si le champ est vide ou que l'utilisateur n'existe pas déja.*/
    if(empty(trim($_POST['username']))){
        $errorMsg[] = "Veuillez entrez un nom d'utilisateur";
    }else{
        if($p::findUser(trim($_POST['username']))){
            $errorMsg[] = "Cette utilisateur est déja pris";
        }else{
            $username = trim($_POST['username']);
        }
    }

    /*Vérification des champs d'adresse courriel'.
    On vérifie si le champ est vide ou que le courriel n'est pas déja utilisé.*/
    if(empty(trim($_POST['email']))){
        $errorMsg[] = "Veuillez entrez votre courriel.";
    } else{
        if($p::findEmail(trim($_POST['email']))){
            $errorMsg[] = "Ce courriel est déja pris";
        }else{
            $email = trim($_POST['email']);
        }
    }

    /*Vérification des champs de mot de passe.
    On vérifie si le champ est vide ou que le mot de passe ne répond pas au demandes.*/
    if (empty(trim($_POST['password']))) {
        $errorMsg[] = "Veuillez entrez un mot de passe";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $errorMsg[] = "Le mot de passe doit avoir entre 6 et 12 caractères";
    } else {
        $password = trim($_POST["password"]);
    }

    /*Vérification des champs de confirmation de mot de passe.
    On vérifie si le champ est vide ou que les mot de passes ne concordent pas.*/
    if (empty(trim($_POST["confirm_password"]))) {
        $errorMsg[] = "Veuillez confirmez le mot de passe";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($errorMsg) && ($password != $confirm_password)) {
            $confirm_password_err = "Les mot de passe ne concorde pas";
        }
    }
    // On vérifie si nous avons eu une erreur d'ici la.
    if (empty($errorMsg)) {
        // On essaie d'insérer l'utilisateur dans la base de donnée.
        if ($p::addUser($username,$email,$password)) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: ?action=welcome');
        }
    }
}

?>