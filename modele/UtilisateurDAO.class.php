<?php
include_once('./modele/classes/Database.class.php');


class UserDAO
{
    //Fonction afin de trouver un utilisateur dans la base de donnée.
    public static function findUser($username)
    {
        $db = Database::getInstance();

        $pstmt = $db->prepare("SELECT * FROM membres WHERE username = :x");
        $pstmt->execute(array(':x' => $username));

        $result = $pstmt->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $pstmt->closeCursor();
            return $result;
        }
        $pstmt->closeCursor();
        return null;
    }

    //Fonction afin de trouver un utilisateur dans la base de donnée.
    public static function getAllUser()
    {
        $db = Database::getInstance();

        $pstmt = $db->prepare("SELECT username FROM membres ORDER BY id asc");
        $pstmt->execute();

        $result = $pstmt->fetchAll(PDO::FETCH_ASSOC);

        if($result)
        {
            $pstmt->closeCursor();
            return $result;
        }
        $pstmt->closeCursor();
        return null;
    }

    //Fonction afin de trouver un courriel dans la base de donnée.
    public static function findEmail($email)
    {
        $db = Database::getInstance();

        $pstmt = $db->prepare("SELECT * FROM membres WHERE email = :x");
        $pstmt->execute(array(':x' => $email));

        $result = $pstmt->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $pstmt->closeCursor();
            
            return $result;
        }
        $pstmt->closeCursor();
        return null;
    }

    //Fonction afin d'ajouter un utilisateur dans la base de donnée.
    public static function addUser($username, $email, $password){
        $db = Database::getInstance();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $pstmt = $db->prepare("INSERT INTO membres (username, email, pass, type) VALUES (:w, :x, :y, :z)");
        $result = $pstmt->execute(array(':w' => $username, ':x' => $email, ':y' => $hashed_password, ':z' => 'utilisateur'));
        if($result)
        {
            $pstmt->closeCursor();
            return $result;
        }
        $pstmt->closeCursor();
        return null;
    }

    //Fonction afin de changer le nom d'utilisateur d'un membres dans la base de donnée.
    public static function changerUsername($username, $currentUser){
        $db = Database::getInstance();
        $user = $_SESSION['username'];
        $pstmt = $db->prepare("UPDATE membres SET username = :x WHERE username = :y");
        $result = $pstmt->execute(array(':x' => $username, ':y' => $currentUser));
        if($result)
        {
            $pstmt->closeCursor();
            return $result;
        }
        $pstmt->closeCursor();
        return null;
    }

    //Fonction afin de changer le mot de passe d'un membres dans la base de donnée.
    public static function changerMdp($mdp,$username){
        $db = Database::getInstance();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pstmt = $db->prepare("UPDATE membres SET pass = :x WHERE username = :y");
        $hashed_password = password_hash($mdp, PASSWORD_DEFAULT);
        $result = $pstmt->execute(array(':x' => $hashed_password, ':y' => $username));
        if($result)
        {
            $pstmt->closeCursor();
            return $result;
        }
        $pstmt->closeCursor();
        return null;
    }

    //Fonction afin de changer le courriel d'un membres dans la base de donnée.
    public static function changerEmail($email, $username){
        $db = Database::getInstance();
        $user = $_SESSION['username'];
        $pstmt = $db->prepare("UPDATE membres SET email = :x WHERE username = :y");
        $result = $pstmt->execute(array(':x' => $email, ':y' => $username));
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