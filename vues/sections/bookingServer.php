<?php
if (!ISSET($_SESSION)) {
    session_start();
}

require_once('./modele/CalendrierDAO.class.php');
require_once('./modele/UtilisateurDAO.class.php');

$jour = $_POST['rdv_j'];
$mois = $_POST['rdv_m'];
$annee = $_POST['rdv_a'];
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    //On enregistre dans la base de donnée le rendez-vous si on confirme.
    if(isset($_POST['bouton_book'])){
        $c = new CalendrierDAO();
        $d = mktime(0,0,0,$mois,$jour,$annee);
        $rdv = date('Y-m-d',$d); 
        $p = new UserDAO();
        //Si on n'est pas admin ou que le champs rdv_user est vide, on enregistre pour l'utilisateur connecter.'
        if(!isset($_POST['rdv_user']) OR empty($_POST['rdv_user'])){
            $row = $p::findUser($_SESSION['username']);
            $userId= $row['id'];
            try{
                if($c::addRdv($rdv,$userId)){
                    header("Refresh:3; url=?action=welcome");
                    $successMsg[] = "Votre rendez-vous est enregistrer, merci!";
                    
                }
            } catch(PDOException $e){
                echo 'Exception -> ';
                var_dump($e->getMessage());
            }
        }else{
                //On enregistre pour l'usager inscrit dans le champs.
                if($p::findUser($_POST['rdv_user'])){
                    $row = $p::findUser($_POST['rdv_user']);
                    $userId= $row['id'];
                    try{
                        if($c::addRdv($rdv,$userId)){
                            header("Refresh:3; url=?action=welcome");
                            $successMsg[] = "Votre rendez-vous est enregistrer, merci!";
                            
                        }
                    } catch(PDOException $e){
                        echo 'Exception -> ';
                        var_dump($e->getMessage());
                    }
                }else{
                    $errorMsg[] = "L'utilisateur n'existe pas";
                }    
        }
        
        
    
    }
}

?>