<?php
    require_once('./modele/Calendrier.class.php');
    require_once('./modele/RDVDAO.class.php');

    class Booking {
        private $jour;
        private $mois;
        private $annee;
        private $rdv_am;
        private $rdv_du_jour;
        
        public function __construct() {
            if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['rdvAM'])) {
                $this->jour = $_POST['rdvAM_j'];
                $this->mois = $_POST['rdvAM_m'];
                $this->annee = $_POST['rdvAM_a'];
                $this->rdv_am = true;
            } 
            if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['rdvPM'])) {
                $this->jour = $_POST['rdvPM_j'];
                $this->mois = $_POST['rdvPM_m'];
                $this->annee = $_POST['rdvPM_a'];
                $this->rdv_am = false;
            }
            $this->rdv_du_jour = RDVDAO::getRdvJour($this->jour, $this->mois);
        }

        public function getMois() {
            echo $this->mois;
        }

        public function genererSelecteur() {
            $liste_dispos='';

            if($this->rdv_am == true) {
                $i = 8;
                $max = 12;
            } else {
                $i = 13;
                $max = 17;
            }
            print_r($this->rdv_du_jour);
            for($i; $i < $max; $i++) {
                
                $liste_dispos .= '<option value="'.$i.'"';

                foreach($this->rdv_du_jour as $rdv) {
                    //echo "A::po";
                    if(date("H", strtotime($rdv)) == $i) {
                        $liste_dispos .= '" disabled';
                        break;
                    }
                }
                $liste_dispos .= '>'. $i .'H00</option>';
        }

        echo $liste_dispos;
    }

    public function getMoisToString() {
        $mois = array("", "Janvier","Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
        return $mois[$this->mois];
    }

    public function getJour() {
        return $this->jour;
    }
}
