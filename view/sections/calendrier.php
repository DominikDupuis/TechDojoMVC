
        <?php
        $page = "calendrier";
        require_once('./modele/RDV.class.php');
        require_once('./modele/Calendrier.class.php');


        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['mois'])) {
            $mois = $_POST['mois'];
            $annee = $_POST['annee'];
        } else {
            $mois = intval(date('m'));
            $annee = intval(date('Y'));
        }

        $calendrier = new Calendrier($mois, $annee);
        
        $calendrier->afficher();
        

        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['prev'])) {
            $calendrier->retirerMois();
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['next'])) {
            $calendrier->ajouterMois();
        }


        
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['rdvAM'])) {
            echo $_POST['rdvAM_j'];
            //$var= new BookingControleur();
            //$var->execute();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['rdvPM'])) {
            echo $_POST['rdvPM_j'];
            //$var= new BookingControleur();
            //$var->execute();  
        }

        // try {
        //  $bdd = new PDO('mysql:host=localhost;dbname=calendrier;charset=utf8', 'root', 'root');
        // } catch (Exception $e) {
        //     die("Erreur : " . $e->getMessage());
        // }
        // $sql = 'SELECT Date,Client FROM calendrier' ;
        // $req = $bdd->query($sql);
        // while($d = $req->fetch(PDO::FETCH_OBJ)) {
        //     echo '<pre>';
        //     print_r($d->Client);
        //     print_r($d->Date);
        //     echo '</pre>';
        // }

        // EXEMPLE RECHERCHE PAR MOIS ET HEURES

        // $sql1 = 'SELECT * FROM calendrier WHERE MONTH(Date)=4 AND HOUR(Date) > 15';
        // $req1 = $bdd->query($sql1);
        // while($d = $req1->fetch(PDO::FETCH_OBJ)) {
        //     echo '<pre>';
        //     print_r($d->Client);
        //     echo '</pre>';
        // }

        // Retourne le nombre de resultats

        // $sql1 = 'SELECT * FROM calendrier WHERE MONTH(Date)=4';
        // $req1 = $bdd->query($sql1);
        // $nb_resultats = $req1->rowCount();
        // echo $nb_resultats;

        // </div>
        // <form method="post">
        //     <input type="submit" name="prev" id="prev" value="RUN" /><br />
        // </form>

        // <?php


        ?>
    </div>