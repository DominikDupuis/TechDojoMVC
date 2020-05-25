<?php
header ('Content-type: text/html; charset=utf-8');;
include('modificationCompte.php'); 
require_once('./modele/RdvDAO.class.php');?>
<!DOCTYPE html>
<head>
    
<meta charset="UTF-8">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<html>
    <?php 
    if (!ISSET($_SESSION)) {
        session_start();
        }
    //Si nous ne somme pas connecter, renvoyer à l'accueil.
    if(!isset($_SESSION['username'])){
        header("location: ?action=accueil");
    }
    $user = $_SESSION['username']; ?>
    <head>
        <title> TechDojo - Mon compte </title>
        <link rel="stylesheet" type ="text/css" href="./css/styleContact.css">
        <link rel="stylesheet" type ="text/css" href="./css/styleWelcome.css">
    </head>
    <body>
        
        <section class="user-welcome">
           <h2 class="bienvenue-message">Bienvenue  <?php echo $user; ?> </h2>
        </section>
        <?php
                //Si il y a des erreurs, les afficher.
                if(isset($errorMsg)){
                    foreach($errorMsg as $error){
                    ?>
                        <section class="messages" style="display:flex;">
                            <div class="alert-danger">
                                <strong><?php echo $error; ?></strong>
                            </div>
                    <?php
                    }
                }
                //Si nous avons réussis l'action, on l'affiche. 
                if(isset($successMsg)){
                    foreach($successMsg as $success){
                        ?>
                        <section class="messages" style="display:flex;">
                            <div class="alert-success">
                                <strong><?php echo $success; ?></strong>
                            </div>
                    <?php
                    }
                }
            ?>
                        </section>
        <section class="modifier-compte">
            <!-- Formulaire intéractif pour changer le mot de passe -->
            <div id=mdp>
                <button  name="btnChangeMdp">Changer de mot de passe</button>
                <div id="mdpChange" class="modal">
                    <form class="modal-content animate"  method="post">

                        <div class="container">
                        <label for="vMdp">Ancien mot de passe</label>
                        <input type="password"  name="vMdp" required>

                        <label for="mdp">Nouveau mot de passe</label>
                        <input type="password"  name="mdp" required>

                        <label for="mdpConf">Confirmer votre nouveau mot de passe</label>
                        <input type="password"  name="mdpConf" required>
                            
                        <button type="submit" name="buttonMdp" class="bouton-change">Changer le mot de passe</button>
                        </div>

                        <div class="container" id="bottom-container">
                        <button type="button"   name= "cancelBtnMdp" class="cancelbtn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Formulaire intéractif pour changer le nom d'utilisateur -->
            <div id=user>
                <button  name="btnChangeUser">Changer de nom d'utilisateur</button>
                <div id="userChange" class="modal">
                    <form class="modal-content animate"  method="post">

                        <div class="container">

                        <label for="user">Nouveau nom d'utilisateur</label>
                        <input type="text" class="input-name" name="user" required>
                       
                        <button type="submit" name="buttonUser" class="bouton-change">Changer le nom d'utilisateur</button>
                        </div>

                        <div class="container" id="bottom-container">
                        <button type="button"  name= "cancelBtnUser" class="cancelbtn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Formulaire intéractif pour changer l'adresse courriel -->
            <div id=email>
                <button  name="btnChangeEmail">Changer de courriel</button>
                <div id="emailChange" class="modal">
                    <form class="modal-content animate"  method="post">

                        <div class="container">

                        <label for="courriel">Nouveau courriel</label>
                        <input type="email"  name="courriel" required>

                        <button type="submit" name="buttonEmail" class="bouton-change">Changer le courriel</button>
                        </div>

                        <div class="container" id="bottom-container">
                        <button type="button"  name="cancelBtnEmail" class="cancelbtn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="drop-down-user">
        <?php
                    //Création du liste de sélection dynamique des utilisateurs
                    $p = new UserDAO();
                    $row = $p::findUser($_SESSION['username']);
                    $userType = $row['type'];
                    $userList = $p::getAllUser();
                    $selectedLocation = "";
                    //Si on a choisis un usager manuellement, on garde la donnée.
                    if(isset($_POST['user_rdv'])){
                        $selectedLocation = $_POST['user_rdv'];
                    }
                    //Si nous sommes connecter en tant qu'admin du site, on affiche la liste
                    if($userType=="admin"){
                        ?>
                        <form method="post" id="form-select" name="form-select" class="form-rdv">
                        <div class="select">
                            <select name="user_rdv" id = user_name>
                                <?php
                                    foreach($userList as $user_name){
                                        $selected='';
                                        if($selectedLocation == $user_name['username']){
                                            $selected = 'selected';
                                        }
                                    ?>
                                        <option value="<?php echo $user_name['username']; ?>" <?php echo $selected;?> >  
                                                <?php echo $user_name['username'];?>
                                            </option>
                                        <?php 
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="submit" name="bouton_rdv" class="bouton-rdv" value="Voir les rendez-vous">
                        </form>
                    <?php
                    }
                    ?>
        </section>
        <section class="tableau-rdv">
        <script type="text/javascript">
            //Met en cookie le rendez-vous à modifier
            $( document ).ready(function() {
                $( ".tblRows" ).click(function() {
                    var rdv_date = $(this).find('.rdv_date').text();
                    var rdv_statut = $(this).find('.rdv_statut').text();
                    document.cookie="rdvDate=" +rdv_date;
                    document.cookie="rdvStatut=" +rdv_statut;


                });
                
            });
        </script>
                <?php
                    //Affichage du tableau des rendez-vous
                    echo '<form method="post" action="?action=modifierBooking">';
                    echo ' <table id="rdv-table" class="rdv-table" cellspacing="10" cellpadding="10">
                        <tr>
                            <th> Date du rendez-vous </th>
                            <th> Statut </th>';
                            if($userType=="admin"){
                                echo'<th> Modifier </th>';
                            }
                        '</tr>';
                    $rdv = new RDVDAO();
                    //Si nous voulons les rendez-vous d'un utilisateur en particulier on vas les chercher
                    if(isset($_POST['bouton_rdv'])){
                        $user = $_POST['user_rdv'];
                        $result = $rdv::getRDVUser($user);
                        if(isset($result)){
                            foreach($result as $rdv_user => $status){
                                echo '<tr class="tblRows">
                                        <td class="rdv_date">'.$rdv_user.'</td>
                                        <td class="rdv_statut">'.$status.'</td>';
                                        if($userType=="admin"){
                                            echo'<td> <input type=submit name="modifier_rdv[]" class="bouton-modifier" value="Modifier"> </td>';
                                        }
                                    '</tr>';
                            }
                        }
                        
                    echo'</table>
                        </form>';
                    //Sinon on prend les rendez-vous de la personne connecté
                    }else{
                        
                        $result = $rdv::getRDVUser($_SESSION['username']);
                        if(isset($result)){
                            foreach($result as $rdv_user => $status){

                                echo '<tr class="tblRows">
                                        <td class="rdv_date">'.$rdv_user.'</td>
                                        <td class="rdv_statut">'.$status.'</td>';
                                        if($userType=="admin"){
                                            echo'<input type=hidden name="rdv_modifier[]" value="'.$rdv_user.'">';
                                            echo'<input type=hidden name="rdv_statut[]" value="'.$status.'">';
                                            echo'<td> <input type=submit  name="bouton_modifier[]" class="bouton-modifier" value="Modifier"> </td>';
                                        }
                                    '</tr>';
                            }
                        }
                    echo'</table>
                        </form>';
                    }
                    
                ?>
        </section>
        <script src="./js/changeUser.js"></script>
    </body>
</html>