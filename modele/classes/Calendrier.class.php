<?php
    require_once('./modele/RDVDAO.class.php');
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
            $this->mois = $mois;
            $this->annee = $annee;
            $this->jours_de_semaine = $jours_de_semaine;
            $this->nb_jours = cal_days_in_month(CAL_GREGORIAN, $this->mois, $this->annee);
            $this->info_date = getdate(strtotime('first day of', mktime(0,0,0,$this->mois,1,$this->annee)));
            $this->jour_de_semaine = $this->info_date['wday'];
            $this->getRdvDuMois();
        }

        public function afficher() {
            // Début du buffer pour réaffichage lors du changement de mois.
            ob_start();
            // Construction de l'entête et début du tableau (calendrier)
            $calendrier = '<div class="legende-calendrier justify-content-between">
                            <h1>DISPONIBILITÉS</h1>
                            <hr>
                            <div class="legende-dispo">
                                    <div class="row">
                                        <div class="col-4">
                                            <a class="dispo dispo-oui">Disponible</a>
                                        </div>
                                        <div class="col-4">
                                            <a class="dispo dispo-pt">Limités</a>
                                        </div>
                                        <div class="col-4">
                                            <a class="dispo dispo-non">N/A</a>
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
                                    <input class="btn-prev-next" type="submit" name="prev" id="prev" value="<"/> </form> ';
            // Affichage entête
            $calendrier .= $this->mois_annee[$this->info_date['mon']] . ' ' . $this->annee . ' ';
            
            // Boutton NEXT
            $calendrier .= '<form method="post">
                                <input type="hidden" name="mois"  value="' . $this->mois . '">
                                <input type="hidden" name="annee" value="' . $this->annee . '"/>
                                <input class="btn-prev-next" type="submit" name="next" id"next" value=">"> </form></h1>';

            //Affichage de chaque journée du mois
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

        //Fonction pour avancer d'un mois
        public function ajouterMois() {
            $this->mois += 1;
            //Retour au premier mois de la nouvelle année.
            if ($this->mois == 13) {
                $this->mois = 1;
                $this->annee += 1;
            }

            $this->nb_jours = cal_days_in_month(CAL_GREGORIAN, $this->mois, $this->annee);
            $this->info_date = getdate(strtotime('first day of', mktime(0,0,0,$this->mois,1,$this->annee)));
            $this->jour_de_semaine = $this->info_date['wday'];
            self::getRdvDuMois();
            // Efface tous les anciens "echo" pour laisser place au nouveau mois
            ob_end_clean();
            self::afficher();
        }

        //Fonction pour reculer d'un mois
        public function retirerMois() {
            $this->mois -= 1;

            if ($this->mois == 0) {
                $this->mois = 12;
                $this->annee -= 1;
            }

            $this->nb_jours = cal_days_in_month(CAL_GREGORIAN, $this->mois, $this->annee);
            $this->info_date = getdate(strtotime('first day of', mktime(0,0,0,$this->mois,1,$this->annee)));
            $this->jour_de_semaine = $this->info_date['wday'];
            $this->getRdvDuMois();
            // Efface tous les anciens "echo" pour laisser place au nouveau mois
            ob_end_clean();
            self::afficher();
        }

        //Aller prendre les rendez-vous du mois 
        public function getRdvDuMois() {
            $liste_rdv = RDVDAO::getRDVMois($this->mois, $this->annee);
            $rdv_formatte = [];

            foreach($liste_rdv as $rdv) {
                array_push($rdv_formatte, date("d-H", strtotime($rdv))); 
            }

           $this->rdv_du_mois = array();
           $this->rdv_du_mois = $rdv_formatte;
        }

        //Fonction qui affiche les dates
        public function getDots($jour_du_rdv) {
            $rdv =  [];
            $journeeRel = str_pad(date('d'),2,"0", STR_PAD_LEFT);
            $date = "$jour_du_rdv-$this->mois-$this->annee";
            $affichage_dot = '';

            foreach($this->rdv_du_mois as $rdv_mois) {
                if(explode('-',$rdv_mois)[0] == $jour_du_rdv) {
                    array_push($rdv, $rdv_mois);
                }
            }
            
            // Affichage des dispos 
            if(sizeof($rdv) >= 4 || strtotime($date) < time() ) {
                $affichage_dot .= '<a class="dispo dispo-non">N/A</a>';
            }
            else if(sizeof($rdv) >= 2) {
                $affichage_dot .= '<form action="?action=booking" method="post">';
                $affichage_dot .= '<input type="hidden" name="rdv_j" id="rdv_j" value="'. $jour_du_rdv .'"/>';
                $affichage_dot .= '<input type="hidden" name="rdv_m" id="rdv_m" value="'. $this->mois .'"/>';
                $affichage_dot .= '<input type="hidden" name="rdv_a" id="rdv_a" value="'. $this->annee .'"/>';
                $affichage_dot .= '<input type="submit" class="dispo dispo-pt" name="rdv" id="rdv" value="Limités"/>';
            } else {
                $affichage_dot .= '<form action="?action=booking" method="post">';
                $affichage_dot .= '<input type="hidden" name="rdv_j" id="rdv_j" value="'. $jour_du_rdv .'"/>';
                $affichage_dot .= '<input type="hidden" name="rdv_m" id="rdv_m" value="'. $this->mois .'"/>';
                $affichage_dot .= '<input type="hidden" name="rdv_a" id="rdv_a" value="'. $this->annee .'"/>';
                $affichage_dot .= '<input type="submit" class="dispo dispo-oui" name="rdv" id="rdv" value="Disponible"/>';
                
            }
            $affichage_dot .= '</form>';
            
            return $affichage_dot;
        }

    }
