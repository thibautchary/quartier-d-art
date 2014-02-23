<?php

require_once ('utilities/databaseconnect.php');
require_once('utilities/upload.php');

class Professeur {
    public $surnom;
    public $fonction;
    public $texte;
    public $id;
    public $extension;
 
    
    
    
    public static function referenceMax(){
        $dbh = Database::connect();
        $query = "SELECT MAX(id) AS id FROM `professeurs`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Professeur');
        $requestsucceeded=$sth->execute();
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $professeur = $sth->fetch();
            $sth->closeCursor();
            $refMax=$professeur->id;
            if ($professeur==false){
                return NULL;
            }else{
                return $refMax;
            }
        }
    }
    
    
    public static function getProfesseur($surnom){
        $dbh = Database::connect();
        $query = "SELECT * FROM `professeurs` WHERE surnom=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Professeur');
        $requestsucceeded=$sth->execute(array($surnom));

        if(!$requestsucceeded){
            exit(0);
        }else{
            $professeur = $sth->fetch();
            $sth->closeCursor();
            if ($professeur==false){
                return NULL;
            }else{
                return $professeur;
            }
        }
    }
     
    
    public static function getTousProfesseurs(){
        $dbh = Database::connect();
        $query = "SELECT * FROM `professeurs`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Professeur');
        $requestsucceeded=$sth->execute();
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $tabProfesseurs = $sth->fetchAll();
            $sth->closeCursor();
            if ($tabProfesseurs==false){
                return NULL;
            }else{
                return $tabProfesseurs;
            }
        }
    } 
     
     
     public static function insererProfesseur($surnom,$fonction,$texte,$id,$extension){
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `professeurs` (`surnom`, `fonction`, `texte`, `id`, `extension`) VALUES(?,?,?,?,?)");
        $sth->execute(array($surnom,$fonction,$texte,$id,$extension));

        $dbh = null; // Deconnexion de MySQL
     }
    
     
     public function deleteProfesseur(){
        $dbh = Database::connect();
        $professeur=Professeur::getProfesseur($_POST["surnom"]);
        $ref=$professeur->id;
        $ext=$professeur->extension;
        $query = "DELETE FROM `professeurs` WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($ref));
        $dbh=NULL;
        unlink ("images/professeurs/$ref.$ext");
        header('Location: index.php?page=professeurs');
    }
    
    
    public function updateProfesseur($fonction,$texte,$extension){
         $dbh = Database::connect();
         $sth = $dbh->prepare("UPDATE `professeurs` SET `fonction`=? WHERE surnom=?");
         $sth->execute(array($fonction,$this->surnom));
         $sth = $dbh->prepare("UPDATE `professeurs` SET `texte`=? WHERE surnom=?");
         $sth->execute(array($texte,$this->surnom));
         $sth = $dbh->prepare("UPDATE `professeurs` SET `extension`=? WHERE surnom=?");
         $sth->execute(array($extension,$this->surnom));
         $dbh=NULL;
     }
}


function registerProfesseur(){
    if(isset($_POST["surnom"]) && $_POST["surnom"] != "" &&
    isset($_POST["texte"]) && $_POST["texte"] != "") {
        if(!Professeur::getProfesseur($_POST["surnom"])==NULL) {
            return "Surnom deja utilisé.";
        }
        else{
            uploadProfesseur();
            }
        }
    else{
        return "Certains champs requis ne sont pas remplis.";
    }
}
?>