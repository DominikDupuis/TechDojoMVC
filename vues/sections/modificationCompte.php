<?php
if (!ISSET($_SESSION)) {
    session_start();
}

$currentUser = $vUser = $vMdp = $vEmail = $nUser = $nMdp = $nMdpConf = $nEmail = "";

require_once "./modele/UtilisateurDAO.class.php";

//Modification du mot de passe

if(isset($_POST['buttonMdp'])){
    $p = new UserDAO();
    $vMdp = strip_tags(trim($_POST['vMdp']));
    $nMdp = strip_tags(trim($_POST['mdp']));
    $nMdpConf = strip_tags(trim($_POST['mdpConf']));

    //Si des champs sont vide on affiche une erreur
    if((empty($vMdp)) || (empty($nMdp)) || (empty($nMdpConf)) ){
        $errorMsg[] = "Veuillez remplir tout les champs";
    }else{
        try{
            //On vérifie si on essaie de changer pour le même mot de passe
            $row = $p::findUser($_SESSION['username']);
            if(password_verify($nMdp, $row['pass'])){
                $errorMsg[] = "Vous ne pouvez pas utiliser le même mot de passe";
            }else{
                if($p::changerMdp($nMdp,$_SESSION['username'])){
                    $successMsg[] = "Votre mot de passe a bien été modifié";
                    header("refresh:3; location: ?action=welcome");
                }
            }
        } catch(PDOException $e){
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }

}

//Modification du courriel

if(isset($_POST['buttonEmail'])){
    $p = new UserDAO();
    $nEmail = strip_tags(trim($_POST['courriel']));
    //Si le champ est vide on affiche une erreur
    if(empty($nEmail)){
        $errorMsg[] = "Veuillez remplir tout les champs";
    }else{
        try{
            //On vérifie si on essaie de changer pour le même courriel
            $row = $p::findUser($_SESSION['username']);
            if($nEmail == $row['email']){
                $errorMsg[] = "Vous ne pouvez pas utiliser le même courriel";
            }else{
                if($p::changerEmail($nEmail,$_SESSION['username'])){
                    $successMsg[] = "Votre adresse courriel a bien été modifié";
                    header("refresh:5; location: ?action=welcome");
                }
            }
        } catch(PDOException $e){
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
}

//Modification du nom d'utilisateur

if(isset($_POST['buttonUser'])){
    $p = new UserDAO();
    $nUser = strip_tags(trim($_POST['user']));
    //Si le champ est vide on affiche une erreur
    if(empty($nUser)){
        $errorMsg[] = "Veuillez remplir tout les champs";
    }else{
        try{
            //On vérifie si on essaie de changer pour le même nom d'utilisateur
            $row = $p::findUser($_SESSION['username']);
            if($nUser == $row['username']){
                $errorMsg[] = "Vous ne pouvez pas utiliser le même nom d'utilisateur";
            }else{
                if($p::changerUsername($nUser,$_SESSION['username'])){
                    $successMsg[] = "Votre nom d'utilisateur a bien été modifié";
                    $_SESSION['username'] = $nUser;
                    header("refresh: 3; location: ?action=welcome");
                }
            }
        } catch(PDOException $e){
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
}
    
?>