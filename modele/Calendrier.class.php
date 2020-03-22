<?php
    require_once('RDVDAO.class.php');
    class Calendrier {
        private $mois;
        private $mois_annee = array("", "Janvier","Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
        private $annee;
        private $jours_de_semaine;
        private $nb_jours;
        private $info_date;
        private $jour_de_semaine;
        private $rdv_du_mois;

        public function __construct($mois, $annee, $jours_de_semaine = array('D', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'S')) {
            //$this->mois = intval(date('m'));
            $this->mois = $mois;
            //$this->annee = intval(date('Y'));
            $this->annee = $annee;
            $this->jours_de_semaine = $jours_de_semaine;
            $this->nb_jours = cal_days_in_month(CAL_GREGORIAN, $this->mois, $this->annee);
            $this->info_date = getdate(strtotime('first day of', mktime(0,0,0,$this->mois,1,$this->annee)));
            $this->jour_de_semaine = $this->info_date['wday'];
            $this->getRdvDuMoi();
        }

        public function afficher() {
            // Début du buffer pour réaffichage lors du changement de mois.
            ob_start();
            // Construction de l'entête et début du tableau (calendrier)
            $calendrier = '<div class="legende-calendrier justify-content-between">
                            <h1>DISPONIBILITÉS</h1>
                            <hr>
                            <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-4">
                                            <a class="dispo dispo-oui">ÉLEVÉ</a>
                                        </div>
                                        <div class="col-4">
                                            <a class="dispo dispo-pt">PEU ÉLEVÉ</a>
                                        </div>
                                        <div class="col-4">
                                            <a class="dispo dispo-non">AUCUNE</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';

            $calendrier .= '<div class = "overflow-x:auto">';
            // Button PREV
            $calendrier .=  '<h1 class="titre-calendrier">
                                <form method="post">
                                    <input type="hidden" name="mois" value="' . $this->mois . '"/>
                                    <input type="hidden" name="annee" value="' . $this->annee . '"/>
                                    <input class="btn-prev-next" type="submit" name="prev" id="prev" value="<"/></form> ';
            // Affichage entête
            $calendrier .= $this->mois_annee[$this->info_date['mon']] . ' ' . $this->annee . ' ';
            
            // Boutton NEXT
            $calendrier .= '<form method="post">
                                <input type="hidden" name="mois"  value="' . $this->mois . '">
                                <input type="hidden" name="annee" value="' . $this->annee . '"/>
                                <input class="btn-prev-next" type="submit" name="next" id"next" value=">"></form></h1>';

            
            $calendrier .= '<table class="table table-bordered table-calendrier">';
            $calendrier .= '<tr>';
            foreach($this->jours_de_semaine as $jour) {
                $calendrier .= '<th class="entete-cal">' . $jour . '</th>';
            }
            $calendrier .= '</tr><tr>';
            if($this->jour_de_semaine > 0) {
                $calendrier .= '<td colspan="' . $this->jour_de_semaine . '"></td>';
            }
            $compteur_jours = 1;
            while($compteur_jours <= $this->nb_jours) {
                if ($this->jour_de_semaine == 7) {
                    $this->jour_de_semaine = 0;
                    $calendrier .= '</tr><tr>';
                }
                if($this->jour_de_semaine != 0 && $this->jour_de_semaine != 6) {
                $calendrier .= '<td class="jour"><p>' . $compteur_jours . '<p>' . self::getDots($compteur_jours) . '</form></td>';
                } else {
                    $calendrier .= '<td class="jour">' . $compteur_jours . '</td>';
                }

                $compteur_jours++;
                $this->jour_de_semaine++;
            }

            if($this->jour_de_semaine != 7) {
                $jours_restants = 7 - $this->jour_de_semaine;
                $calendrier .= '<td colspan="' . $jours_restants . '"</td>';
            }

            $calendrier .= '</tr>';
            $calendrier .= '</table>';
            $calendrier .= '</div>';
            
            
            echo $calendrier;
        }

        public function ajouterMois() {
            $this->mois += 1;

            if ($this->mois == 13) {
                $this->mois = 1;
                $this->annee += 1;
            }

            $this->nb_jours = cal_days_in_month(CAL_GREGORIAN, $this->mois, $this->annee);
            $this->info_date = getdate(strtotime('first day of', mktime(0,0,0,$this->mois,1,$this->annee)));
            $this->jour_de_semaine = $this->info_date['wday'];
            self::getRdvDuMoi();
            
            ob_end_clean();
            self::afficher();
        }

        public function retirerMois() {
            $this->mois -= 1;

            if ($this->mois == 0) {
                $this->mois = 12;
                $this->annee -= 1;
            }

            $this->nb_jours = cal_days_in_month(CAL_GREGORIAN, $this->mois, $this->annee);
            $this->info_date = getdate(strtotime('first day of', mktime(0,0,0,$this->mois,1,$this->annee)));
            $this->jour_de_semaine = $this->info_date['wday'];
            $this->getRdvDuMoi();
            // Efface tous les anciens "echo" pour laisser place au nouveau mois
            ob_end_clean();
            self::afficher();
        }

        // public function getMois() {
        //     return $this->mois;
        // }

        public function getRdvDuMoi() {
            $liste_rdv = RDVDAO::getRDVMois($this->mois);
            $rdv_formatte = [];

            foreach($liste_rdv as $rdv) {
                array_push($rdv_formatte, date("d-H", strtotime($rdv))); 
            }

           $this->rdv_du_mois = array();
           $this->rdv_du_mois = $rdv_formatte;
        }

        public function getDots($jour_du_rdv) {
            $rdv_am =  [];
            $rdv_pm = [];
            $affichage_dot = '';

            foreach($this->rdv_du_mois as $rdv) {
                if(explode('-',$rdv)[0] == $jour_du_rdv) {
                    if(explode('-',$rdv)[1] >= 12) {
                        array_push($rdv_pm, $rdv);
                    } else {
                        array_push($rdv_am, $rdv);
                    }
                }
            }
            
            // Affichage des dispos AM
            if(sizeof($rdv_am) >= 4) {
                $affichage_dot .= '<a class="dispo dispo-non">AM</a>';
            }
            else if(sizeof($rdv_am) >= 2) {
                $affichage_dot .= '<form action="?action=booking" method="post">';
                $affichage_dot .= '<input type="hidden" name="rdvAM_j" id="rdvAM_j" value="'. $jour_du_rdv .'"/>';
                $affichage_dot .= '<input type="hidden" name="rdvAM_m" id="rdvAM_m" value="'. $this->mois .'"/>';
                $affichage_dot .= '<input type="hidden" name="rdvAM_a" id="rdvAM_a" value="'. $this->annee .'"/>';
                $affichage_dot .= '<input type="submit" class="dispo dispo-pt" name="rdvAM" id="rdvAM" value="AM"/>';
            } else {
                $affichage_dot .= '<form action="?action=booking" method="post">';
                $affichage_dot .= '<input type="hidden" name="rdvAM_j" id="rdvAM_j" value="'. $jour_du_rdv .'"/>';
                $affichage_dot .= '<input type="hidden" name="rdvAM_m" id="rdvAM_m" value="'. $this->mois .'"/>';
                $affichage_dot .= '<input type="hidden" name="rdvAM_a" id="rdvAM_a" value="'. $this->annee .'"/>';
                $affichage_dot .= '<input type="submit" class="dispo dispo-oui" name="rdvAM" id="rdvAM" value="AM"/>';
                
            }

            $affichage_dot .= '</form>';
            // <form action="?action=booking" method="post">';
            //$affichage_dot .= '<form method="post">';


            //Affichage des dispos PM
            if(sizeof($rdv_pm) >= 4) {
                $affichage_dot .= '<a class="dispo dispo-non">PM</a>';
            } 
            else if(sizeof($rdv_pm) >= 2) {
                $affichage_dot .= '<form action="?action=booking" method="post">';
                $affichage_dot .= '<input type="hidden" name="rdvPM_j" id="rdvPM_j" value="'. $jour_du_rdv .'"/>';
                $affichage_dot .= '<input type="hidden" name="rdvPM_m" id="rdvPM_m" value="'. $this->mois .'"/>';
                $affichage_dot .= '<input type="hidden" name="rdvPM_a" id="rdvPM_a" value="'. $this->annee .'"/>';
                $affichage_dot .= '<input type="submit" class="dispo dispo-pt" name="rdvPM" id="rdvPM" value="PM"/>';
            } else {
                // $affichage_dot .= '<a href="?action=bookingPm" type="hidden" class="dispo dispo-oui">PM</a>';
                $affichage_dot .= '<form action="?action=booking" method="post">';
                $affichage_dot .= '<input type="hidden" name="rdvPM_j" id="rdvPM_j" value="'. $jour_du_rdv .'"/>';
                $affichage_dot .= '<input type="hidden" name="rdvPM_m" id="rdvPM_m" value="'. $this->mois .'"/>';
                $affichage_dot .= '<input type="hidden" name="rdvPM_a" id="rdvPM_a" value="'. $this->annee .'"/>';
                $affichage_dot .= '<input type="submit" class="dispo dispo-oui" name="rdvPM" id="rdvPM" value="PM"/>';
            }

            $affichage_dot .= '</form>';
            
            return $affichage_dot;
        }

    }
