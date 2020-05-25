<?php
    include('bookingServer.php');
    $rdv_j = $_POST['rdv_j'];
    $rdv_m = $_POST['rdv_m'];
    $rdv_a = $_POST['rdv_a'];
    $mois_annee = array("", "Janvier","Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

?>
<head>
    <title> TechDojo - Booking </title>
    <link rel="stylesheet" type ="text/css" href="./css/styleContact.css">
    <link rel="stylesheet" type ="text/css" href="./css/styleWelcome.css">
    <link rel="stylesheet" type ="text/css" href="./css/styleBooking.css">
</head>
<section class="booking">
    
    <!-----Formulaire de réservation---->
    <div class="row modal">
        <div class="modal-content">
            <h1 class="date-booking"> Réservation pour le : <?php echo $rdv_j . " " . $mois_annee[$rdv_m] . " " . $rdv_a?> </h1></hr>
            <div class="row-bouton">
                <form method="post">
                <?php
                    $p = new UserDAO();
                    $row = $p::findUser($_SESSION['username']);
                    $userType= $row['type'];
                    //Si nous sommes un admin du site, nous pouvons décider pour qui nous voulons prendre le rendez-vous.
                    if($userType=="admin"){
                        ?>
                        <input type="text" class="input-name" name="rdv_user" placeholder="Entrez un nom d'utilisateur">
                    <?php
                    }
                ?>
                <input type="hidden" name="rdv_j"  value="<?php echo $rdv_j ?>">
                <input type="hidden" name="rdv_m"  value="<?php echo $rdv_m ?>">
                <input type="hidden" name="rdv_a"  value="<?php echo $rdv_a ?>">
                <button type="submit" name="bouton_book" class="bouton-book">Réserver</button>
                <button type="button" onclick="location.href='?action=calendrier'"  name="bouton_cancel" class="bouton-cancel">Annuler</button>
                </form>
            </div>
            <?php
            //Si nous avons des messages de réussites ou d'erreurs, on les affiche.
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
        </div>
    </div>
    
</section>

