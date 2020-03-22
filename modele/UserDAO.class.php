<?php 
    require_once('./modele/Database.class.php');

    class UserDAO {
        static private $liste_users = [];

        public static function find($id) {
            try {
                $bdd = Database::getInstance();
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
            
            $sql = 'SELECT * FROM utilisateurs WHERE id = "'.$id.'" '; 

            $req = $bdd->query($sql);
            while($d = $req->fetch(PDO::FETCH_OBJ)) {
                $nom = $d->id;
                array_push(self::$liste_users, $d->id);
            }

            return self::$liste_users;
        }

        public static function create($user) {
            
            try {
                $bdd = Database::getInstance();
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
            
            $sql = 'INSERT INTO utilisateurs (id, mdp, email, client) VALUES (:pseudo, :courriel, :mdp)';

		    try {
            	$resultat = self::executerRequete($sql, $user->toArray());

            	if($resultat->rowCount() > 0) {
                	$id = self::getBdd()->lastInsertId(); // récupère l'id du dernier utilisateur crée en cas de succès
                    $user->setID($id);

            	} else {

            		throw new Exception("L'utilisateur n'a pas pu être ajouté à la base de donnée");
            	}

            } catch(Exception $e) {
                throw new Exception("L'utilisateur n'a pas pu être ajouté à la base de donnée");
            }

            return $user;
        }
    }
?>
