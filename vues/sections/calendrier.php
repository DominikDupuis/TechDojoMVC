<!DOCTYPE html>
<html>
    <head>
        <title> TechDojo - Calendrier </title>
        <link rel="stylesheet" type ="text/css" href="./css/styleContact.css">
        <link rel="stylesheet" type ="text/css" href="./css/styleCalendrier.css">
    </head>
    <body>
    <?php
    require_once('./modele/classes/Calendrier.class.php');

    //On initialise les valeurs du mois à afficher quand on arrive sur le calendrier.
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['mois'])) {
        $mois = $_POST['mois'];
        $annee = $_POST['annee'];
    }else if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['dateButton'])) {
        $date = strtotime($_POST['date_picker']);
        $mois = intval(date('m',$date));
        $annee = intval(date('Y',$date));
        echo date('m',$date);
    }else {
            $mois = intval(date('m'));
            $annee = intval(date('Y'));
    }

    $calendrier = new Calendrier($mois, $annee);
        
    $calendrier->afficher();
        
    //Si on change de mois en utilisant les boutons du calendrier, changer le mois.
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['prev'])) {
        $calendrier->retirerMois();
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['next'])) {
        $calendrier->ajouterMois();
    }


        
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['rdvAM'])) {
        echo $_POST['rdvAM_j'];
    }
        ?>
    </body>
</html>