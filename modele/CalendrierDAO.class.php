<?php
include_once('./modele/classes/Database.class.php');
include_once('./modele/UtilisateurDAO.class.php');

class CalendrierDAO{
    //Fonction afin d'ajouter un rendez-vous dans la base de donnée.
    public static function addRdv($date, $userId){
        $db = Database::getInstance();
        $pstmt = $db->prepare("INSERT INTO rdv (dateRdv, ClientID, Statut) VALUES (:x, :y, :z )");
        $result = $pstmt->execute(array(':x' => $date, ':y' => $userId, ':z' => "À venir" ));
        if($result)
        {
            $pstmt->closeCursor();
            return $result;
        }
        $pstmt->closeCursor();
        return null;
    }
}
?>