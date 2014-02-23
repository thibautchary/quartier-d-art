<?php

require_once ('utilities/databaseconnect.php');
require_once('utilities/upload.php');

class Artiste {
    public $surnom;
    public $fonction;
    public $texte;
    public $id;
    public $extension;
 
    
    
    
    public static function referenceMax(){
        $dbh = Database::connect();
        $query = "SELECT MAX(id) AS id FROM `artistes`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Artiste');
        $requestsucceeded=$sth->execute();
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $artiste = $sth->fetch();
            $sth->closeCursor();
            $refMax=$artiste->id;
            if ($artiste==false){
                return NULL;
            }else{
                return $refMax;
            }
        }
    }
    
    
    public static function getArtiste($surnom){
        $dbh = Database::connect();
        $query = "SELECT * FROM `artistes` WHERE surnom=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Artiste');
        $requestsucceeded=$sth->execute(array($surnom));

        if(!$requestsucceeded){
            exit(0);
        }else{
            $artiste = $sth->fetch();
            $sth->closeCursor();
            if ($artiste==false){
                return NULL;
            }else{
                return $artiste;
            }
        }
    }
     
    
    public static function getTousArtistes(){
        $dbh = Database::connect();
        $query = "SELECT * FROM `artistes`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Artiste');
        $requestsucceeded=$sth->execute();
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $tabArtistes = $sth->fetchAll();
            $sth->closeCursor();
            if ($tabArtistes==false){
                return NULL;
            }else{
                return $tabArtistes;
            }
        }
    } 
     
     
     public static function insererArtiste($surnom,$fonction,$texte,$id,$extension){
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `artistes` (`surnom`, `fonction`, `texte`, `id`, `extension`) VALUES(?,?,?,?,?)");
        $sth->execute(array($surnom,$fonction,$texte,$id,$extension));

        $dbh = null; // Deconnexion de MySQL
     }
    
     
     public function deleteArtiste(){
        $dbh = Database::connect();
        $artiste=Artiste::getArtiste($_POST["surnom"]);
        $ref=$artiste->id;
        $ext=$artiste->extension;
        $query = "DELETE FROM `artistes` WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($ref));
        $dbh=NULL;
        unlink ("images/artistes/$ref.$ext");
        header('Location: index.php?page=artistes');
    }
    
    
    public function updateArtiste($fonction,$texte,$extension){
         $dbh = Database::connect();
         $sth = $dbh->prepare("UPDATE `artistes` SET `fonction`=? WHERE surnom=?");
         $sth->execute(array($fonction,$this->surnom));
         $sth = $dbh->prepare("UPDATE `artistes` SET `texte`=? WHERE surnom=?");
         $sth->execute(array($texte,$this->surnom));
         $sth = $dbh->prepare("UPDATE `artistes` SET `extension`=? WHERE surnom=?");
         $sth->execute(array($extension,$this->surnom));
         $dbh=NULL;
     }
}


function registerArtist(){
    if(isset($_POST["surnom"]) && $_POST["surnom"] != "" &&
    isset($_POST["texte"]) && $_POST["texte"] != "") {
        if(!Artiste::getArtiste($_POST["surnom"])==NULL) {
            return "Surnom deja utilisé.";
        }
        else{
            uploadArtiste();
            }
        }
    else{
        return "Certains champs requis ne sont pas remplis.";
    }
}
?>