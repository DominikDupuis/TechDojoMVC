<?php
    include('ModifierBookingServer.php');
    $rdv_modifier = $_COOKIE['rdvDate'];
    $date_rdv = date("d/m/Y",strtotime($rdv_modifier));
    $mois_annee = array("", "Janvier","Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

?>
<head>
    <title> TechDojo - Booking </title>
    <link rel="stylesheet" type ="text/css" href="./css/styleContact.css">
    <link rel="stylesheet" type ="text/css" href="./css/styleWelcome.css">
    <link rel="stylesheet" type ="text/css" href="./css/styleBooking.css">
    <link rel="stylesheet" type ="text/css" href="./css/styleModifierBooking.css">
</head>
<section class="booking"> 
    <!----Script du datePicker ---->
    <script>
        $(function() {
            $( "#datepicker_rdv" ).datepicker({
                beforeShowDay : function (date) {
                    var dayOfWeek = date.getDay ();
                    // 0 : Sunday, 1 : Monday, ...
                    if (dayOfWeek == 0 || dayOfWeek == 6) return [false];
                    else return [true];
                }
            });
        });
    </script>
    <!-----Formulaire de modification de rendez-vous ----->
    <div class="row modal">
        <div class="modal-content">
            <h1 class="date-booking"> Modifier le rendez-vous du :  </br> <?php echo $date_rdv?> </h1></hr>
            <div class="row-bouton">
                <form method="post">
                    <input type = "text" name="datePickerRdv" class="date-picker" placeholder="Entrez une date" id = "datepicker_rdv">
                    <select name="rdv_statut">
                        <option value ="" selected disabled>Veuillez selectionner un statut</option>
                        <option value = "À venir">À venir</option>
                        <option value = "Complété">Complété</option>
                        <option value = "En traitement">En traitement</option>
                    </select>
                    <button type="submit" name="bouton_modifier" class="bouton-book">Modifier</button>
                    <button type="submit" name="bouton_supp" class="bouton-cancel">Supprimer</button>
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

