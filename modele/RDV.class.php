<?php 
    //require_once('./modele/Calendrier.class.php');

    class RDV {
        static private $listeRDV = array();

        //public static function getRDV($calendrier) {
        public static function getRDV($mois) {
            self::$listeRDV = array();
            
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=calendrier;charset=utf8', 'root', 'root');
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
            //$sql = 'SELECT * FROM rdv';
            $sql = 'SELECT * FROM rdv WHERE MONTH(`dateHeure`)='. $mois;
            
            //echo 'DEMANDE : '. $sql;
            $req = $bdd->query($sql);
            while($d = $req->fetch(PDO::FETCH_OBJ)) {
                $nom = $d->dateHeure;
                array_push(self::$listeRDV, $d->dateHeure);
            }

            return self::$listeRDV;
        }

        public static function getRdvJour($jours, $mois) {
            self::$listeRDV = array();

            try {
                $bdd = new PDO('mysql:host=localhost;dbname=calendrier;charset=utf8', 'root', 'root');
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
            //$sql = 'SELECT * FROM rdv';
            $sql = 'SELECT * FROM rdv WHERE MONTH(`dateHeure`)='. $mois .' AND DAY(`dateHeure`)='. $jours;
            
            //echo 'DEMANDE : '. $sql;
            $req = $bdd->query($sql);
            while($d = $req->fetch(PDO::FETCH_OBJ)) {
                $nom = $d->dateHeure;
                array_push(self::$listeRDV, $d->dateHeure);
            }
            
            return self::$listeRDV;
        }

        // public static function getRdvDuMois($calendrier) {
        //     $liste_rdv = self::getRDV($calendrier);
        //     $rdv_formatte = [];
        //     print_r($liste_rdv);
        //     foreach($liste_rdv as $rdv) {
        //         array_push($rdv_formatte, date("d-H", strtotime($rdv))); 
        //     }
        //     //print_r($liste_rdv);
        //     //print_r($rdv_formatte);
        //     //echo '<p>'.date("m-h", strtotime($liste_rdv[0]));
        //    return $rdv_formatte;
        // }
    }

?>