<?php
//require_once('./modele/Calendrier.class.php');
//require_once('./modele/RDV.class.php');
require_once('./modele/Booking.class.php');
$page = "calendrier"
?>
<section class="container-fluid booking-form">
    <h1 class="h1-booking"><?php

        $booking = new Booking();
        echo $booking->getJour() . " " . $booking->getMoisToString();

        ?></h1><hr class="hr-booking">
    <form method="post">
        <div class="form-row booking-row">
            <label class="mr-lg-2 lbl-heure" for="inlineFormCustomSelect">HEURE DU RENDEZ-VOUS : </label>
            <select class="custom-select mr-lg-2" id="inlineFormCustomSelectLg">
                <option selected> ... </option>
                <?php
                // $rdv_formatte = [];
                // $dispo = RDV::getRdvJour($_POST['rdvAM_j'], $_POST['rdvAM_m']);
                // //echo '<h1>'. print_r($dispo) .'</h1>';
                // foreach ($dispo as $rdv) {
                //     if (date("H", strtotime($rdv)) < 12) {
                //         array_push($rdv_formatte, date("H", strtotime($rdv)));
                //     }
                // }
                // //print_r($rdv_formatte);

                //$booking = new Booking();
                //$booking->getMois();
                $booking->genererSelecteur();
                ?>

            </select>
        </div>


        <!-- IMPORTANT DE CHANGER QUAND LE DAO VA ETRE PRET -->
        <div class="row form-nom">
            <div class="col">
                <input type="text" class="form-control input-lg" placeholder="Prénom">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Nom">
            </div>
        </div>
        <div class="row form-email">
            <div class="col">
                <input type="text" class="form-control input-lg" placeholder="adresse@email.com">
            </div>
        </div>
        <div class="row form-commentaire">
            <div class="col">
                <textarea class="form-control input-lg input-commentaire" placeholder="Commentaires"></textarea>
            </div>
        </div>
        <div class="row for-submit">
            <button type="submit" class="btn btn-primary mb-2 btn-booking">RÉSERVER</button>
        </div>

    </form>
</section>
<?php
// if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['rdvAM'])) {
//             echo $_POST['rdvAM_m'];
// } else {
//     echo "caca";
// }
?>
<?php
// if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['rdvAM'])) {
//     //$dispo = RDV::getRDV($_POST['rdvAM_m']);
//     echo '<option value="8">08:00</option>
//             <option value="9">09:00</option>
//             <option value="10">10:00</option>
//             <option value="11">11:00</option>';

//     //print_r($dispo);
// } else {
//     echo '<option value="1">13:00</option>
//             <option value="2">14:00</option>
//             <option value="3">15:00</option>
//             <option value="4">16:00</option>';
// }
?>