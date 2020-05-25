<?php 
    require_once('./modele/classes/Database.class.php');
    require_once('./modele/UtilisateurDAO.class.php');

    class RDVDAO {
        static private $listeRDV = array();
        static private $listeStatus = array();

        //On vas prendre tout les rendez-vous du mois.
        public static function getRDVMois($mois, $annee) {
            self::$listeRDV = array();
            
            try {
                $db = Database::getInstance();
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
            $sql = 'SELECT * FROM rdv WHERE MONTH(`dateRdv`)='. $mois .' AND YEAR(`dateRdv`)=' .$annee;
            
            $req = $db->query($sql);
            while($d = $req->fetch(PDO::FETCH_OBJ)) {
                array_push(self::$listeRDV, $d->dateRdv);
            }

            return self::$listeRDV;
        }

        //Fonction pour avoir les rendez-vous d'un usager en particulier
        public static function getRDVUser($user){
            self::$listeRDV = array();
            self::$listeStatus = array();
            $db = Database::getInstance();
            $p = new UserDAO();
            $row = $p::findUser($user);
            $userId= $row['id'];
            $sql = 'SELECT * FROM rdv WHERE ClientID = '.$userId .' ORDER BY dateRdv';
            $req = $db->query($sql);
            while($d = $req->fetch(PDO::FETCH_OBJ)){
                array_push(self::$listeRDV, $d->dateRdv);
                array_push(self::$listeStatus, $d->Statut);
                $c = array_combine(self::$listeRDV, self::$listeStatus);
            }
            if(isset($c)){
                return $c;
            }else{
                return null;
            }

            
        }

        //Fonction afin de changer un rendez-vous dans la base de donnée.
        public static function changerRdv($newRdv, $currentRdv, $newStatut){
            $db = Database::getInstance();
            $user = $_SESSION['username'];
            $pstmt = $db->prepare("UPDATE rdv SET dateRdv = :x, statut = :y WHERE dateRdv = :z");
            $result = $pstmt->execute(array(':x' => $newRdv, ':y' => $newStatut, ':z' => $currentRdv));
            if($result)
            {
                $pstmt->closeCursor();
                return $result;
            }
            $pstmt->closeCursor();
            return null;
        }

        //Fonction afin de supprimer un rendez-vous dans la base de donnée.
        public static function supprimerRdv($Rdv){
            $db = Database::getInstance();
            $user = $_SESSION['username'];
            $pstmt = $db->prepare("DELETE FROM rdv WHERE dateRdv = :x");
            $result = $pstmt->execute(array(':x' => $Rdv));
            if($result)
            {
                $pstmt->closeCursor();
                return $result;
            }
            $pstmt->closeCursor();
            return null;
        }

        //On vas prendre tout les rendez-vous du jour.
        public static function getRdvJour($jours, $mois) {
            self::$listeRDV = array();

            try {
                $db = Database::getInstance();
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
            $sql = 'SELECT * FROM rdv WHERE MONTH(`dateRdv`)='. $mois .' AND DAY(`dateRdv`)='. $jours;
            
            $req = $db->query($sql);
            while($d = $req->fetch(PDO::FETCH_OBJ)) {
                array_push(self::$listeRDV, $d->dateHeure);
            }
            
            return self::$listeRDV;
        }
    }
