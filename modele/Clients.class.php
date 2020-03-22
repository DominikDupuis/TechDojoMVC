<?php 
    class Clients {
        private $id;
        private $email;
        private $nom;
        private $prenom;
        static private $listeClients = array();

        public static function GetClients() {
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=calendrier;charset=utf8', 'root', 'root');
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
            $sql = 'SELECT * FROM Clients';
            $req = $bdd->query($sql);
            while($d = $req->fetch(PDO::FETCH_OBJ)) {
                $nom = $d->Nom;
                array_push(self::$listeClients, $d->Nom);
                echo '<pre>';
                print_r($d->Nom);
                echo '</pre>';
            }
            echo '<pre>' . implode(", ", self::$listeClients) . $nom .'</pre>';
            //print_r(self::$listeClients);
        }
    }
