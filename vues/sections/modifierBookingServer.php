<?php
if (!ISSET($_SESSION)) {
    session_start();
}

require_once('./modele/RdvDAO.class.php');
require_once('./modele/UtilisateurDAO.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['bouton_modifier'])){
        $r = new RDVDAO();
        try{
            //Si on choisis pas un statut, on ne le change pas
            if(empty($_POST['rdv_statut'])){
                $oldDate = strtotime($_POST['datePickerRdv']);
                $newDate = date("Y-m-d",$oldDate);
                if($r::changerRdv($newDate,$_COOKIE['rdvDate'],$_COOKIE['rdvStatut'])){
                    //On efface les cookies
                    setcookie("rdvDate", "", time() - 3600);
                    setcookie("rdvStatut", "", time() - 3600);
                    header("Refresh:3; url=?action=welcome");
                    $successMsg[] = "Votre rendez-vous a été modifié, merci";
                }else{
                    $errorMsg[] = "Il y a eu une erreur, réessayer plus tard";
                }
                //Sinon on change le tout
            }else if (!empty($_POST['datePickerRdv']) AND !empty($_POST['rdv_statut'])){
                $oldDate = strtotime($_POST['datePickerRdv']);
                $newDate = date("Y-m-d",$oldDate);
                if($r::changerRdv($newDate,$_COOKIE['rdvDate'],$_POST['rdv_statut'])){
                    setcookie("rdvDate", "", time() - 3600);
                    setcookie("rdvStatut", "", time() - 3600);
                    header("Refresh:3; url=?action=welcome");
                    $successMsg[] = "Votre rendez-vous a été modifié, merci";
                }else{
                    $errorMsg[] = "Il y a eu une erreur, réessayer plus tard";
                }
            }else if (isset($_POST['datePickerRdv'])){

                if($r::changerRdv($_COOKIE['rdvDate'],$_COOKIE['rdvDate'],$_POST['rdv_statut'])){
                    setcookie("rdvDate", "", time() - 3600);
                    setcookie("rdvStatut", "", time() - 3600);
                    header("Refresh:3; url=?action=welcome");
                    $successMsg[] = "Votre rendez-vous a été modifié, merci";
                }else{
                    $errorMsg[] = "Il y a eu une erreur, réessayer plus tard";
                }
            }
        }catch(PDOException $e){
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    if(isset($_POST['bouton_supp'])){
        $r = new RDVDAO();
        try{
            if($r::supprimerRdv($_COOKIE['rdvDate'])){
                setcookie("rdvDate", "", time() - 3600);
                setcookie("rdvStatut", "", time() - 3600);
                header("Refresh:3; url=?action=welcome");
                $successMsg[] = "Votre rendez-vous a été supprimé, merci";
            }else{
                $errorMsg[] = "Il y a eu une erreur, réessayer plus tard";
            }
            


        }catch(PDOException $e){
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    
}

?>