<?php 

require_once ('utilities/databaseconnect.php');
require_once('utilities/logInOut.php');
require_once ('utilities/mail.php');


class Utilisateur {
    public $login;
    public $mdp;
    public $nom;
    public $prenom;
    public $email;
    public $admin;
    public $etat;
 
    public function __toString() {
            return "[".$this->login."]".$this->prenom."<strong>".$this->nom."</strong>". $this->email;
    }
    
     public static function getUtilisateur($login){
        $dbh = Database::connect();
        $query = "SELECT * FROM `utilisateurs` WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $requestsucceeded=$sth->execute(array($login));
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $user = $sth->fetch();
            $sth->closeCursor();
            if ($user==false){
                return NULL;
            }else{
                return $user;
            }
        }
     }
     
     
     public static function getUtilisateursEnAttente(){
        $dbh = Database::connect();
        $query = "SELECT * FROM `utilisateurs` WHERE `etat`='0'";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $requestsucceeded=$sth->execute();
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $tabUsers = $sth->fetchAll();
            $sth->closeCursor();
            if ($tabUsers==false){
                return NULL;
            }else{
                return $tabUsers;
            }
        }
    }
     
     
     public static function utilisateurExiste($login){
        $dbh = Database::connect();
        $query = "SELECT * FROM `utilisateurs` WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $requestsucceeded=$sth->execute(array($login));

        
        if(!$requestsucceeded){
            echo 'Connexion echouee';
            exit(0);
        }else{
            $user = $sth->fetch();
            $sth->closeCursor();
            if ($user==false){
                return NULL;
            }else{
                return $user;
            }
        }
     }
     
     
     
     public static function insererUtilisateur($login,$mdp,$nom,$prenom,$email){
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `email`, `admin`, `etat`) VALUES(?,SHA1(?),?,?,?,?,?)");
        $sth->execute(array($login,$mdp,$nom,$prenom,$email,'0','0'));
        $dbh = null; // Deconnexion de MySQL
     }
     
     
     
     public function validerUtilisateur(){
         $dbh = Database::connect();
         $sth = $dbh->prepare("UPDATE `utilisateurs` SET `etat`='1' WHERE login=?");
         $sth->execute(array($this->login));
         $dbh=NULL;
     }
     
     
     public function testerMdp($pwd){
         return ($this->mdp == sha1($pwd));
     }
     
     
     public function updatePassword($pwd){
         $dbh = Database::connect();
         $sth = $dbh->prepare("UPDATE `utilisateurs` SET mdp=SHA1(?) WHERE login=?");
         $sth->execute(array($pwd,$this->login));
         $dbh=NULL;
     }
     

    public function deleteUser(){
        $dbh = Database::connect();
        $query = "DELETE FROM `utilisateurs` WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($this->login));
        $dbh=NULL;
    }
}

function changePassword() {
    if (isset($_POST["password"]) && $_POST["password"] != "" &&
            isset($_POST["up"]) && $_POST["up"] != "" &&
            isset($_POST["up2"]) && $_POST["up2"] != "") {
        if (!up == up2) {
            return "Les nouveaux mots de passe different.";
        }
        else {
            $user = Utilisateur::getUtilisateur($_SESSION["login"]);
            if (!$user->testerMdp($_POST["password"])) {
                return "Ancien mot de passe incorrect";
            }
            else {
                $user->updatePassword($_POST["up"]);
                return "Mot de passe mis à jour.";
            }
        }
    } else {
        return "Certains champs ne sont pas remplis.";
    }
}


function deleteUser(){
    if(isset($_POST["password"]) && $_POST["password"] != ""){
        $user = Utilisateur::getUtilisateur($_SESSION["login"]);
        if(!$user->testerMdp($_POST["password"])){
            return "Mot de passe incorrect";
        }
        else{
            logOut();
            $user->deleteUser();
            return "Utilisateur supprimé";
        }
    }  
    else{
        return "Certains champs ne sont pas remplis";
    }
}

function register(){
    if(isset($_POST["login"]) && $_POST["login"] != "" &&
    isset($_POST["email"]) && $_POST["email"] != "" &&
    isset($_POST["up"]) && $_POST["up"] != "" &&
    isset($_POST["up2"]) && $_POST["up2"] != "" &&
    isset($_POST["nom"]) && $_POST["nom"] != "" &&
    isset($_POST["prenom"]) && $_POST["prenom"] != "") {
        if(!Utilisateur::getUtilisateur($_POST["login"])==NULL) {
            echo "Login deja utilisé.";
            return "Login deja utilisé.";
        }
        else{
            if(!up==up2){
                echo "Les deux mots de passe different.";
                return "Les deux mots de passe different.";
            }
            else{
                sendMailRequest();
                Utilisateur::insererUtilisateur($_POST["login"],$_POST["up"],$_POST["nom"],$_POST["prenom"],$_POST["email"]);
                header('Location: index.php?page=accueil');
                echo "Votre demande d'inscrpition est en attente de validation";
                return "Votre demande d'inscrpition est en attente de validation";
            }
        }
    }
    else{
        echo "Certains champs requis ne sont pas remplis.";
        return "Certains champs requis ne sont pas remplis.";
    }
}
?>