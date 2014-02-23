<?php

require_once ('utilities/databaseconnect.php');

class Oeuvre {
    public $titre;
    public $artiste;
    public $date;
    public $commentaire;
    public $theme;
    public $reference;
    public $extension;
 
    
    
    public static function referenceMax(){
        $dbh = Database::connect();
        $query = "SELECT MAX(reference) AS reference FROM `oeuvres`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Oeuvre');
        $requestsucceeded=$sth->execute();
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $oeuvre = $sth->fetch();
            $sth->closeCursor();
            $refMax=$oeuvre->reference;
            if ($oeuvre==false){
                return NULL;
            }else{
                return $refMax;
            }
        }
    }
    
    
    public static function getOeuvre($id){
        $dbh = Database::connect();
        $query = "SELECT * FROM `oeuvres` WHERE reference=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Oeuvre');
        $requestsucceeded=$sth->execute(array($id));

        if(!$requestsucceeded){
            exit(0);
        }else{
            $oeuvre = $sth->fetch();
            $sth->closeCursor();
            if ($oeuvre==false){
                return NULL;
            }else{
                return $oeuvre;
            }
        }
    }
     
    
    public static function getToutesOeuvres(){
        $dbh = Database::connect();
        $query = "SELECT * FROM `oeuvres`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Oeuvre');
        $requestsucceeded=$sth->execute();
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $tabOeuvres = $sth->fetchAll();
            $sth->closeCursor();
            if ($tabOeuvres==false){
                return NULL;
            }else{
                return $tabOeuvres;
            }
        }
    }
    
    
    /*public static function getTousThemes(){
        $dbh = Database::connect();
        $query = "SELECT * FROM `oeuvres`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Oeuvre');
        $requestsucceeded=$sth->execute();
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $tabThemes = $sth->fetchAll();
            $sth->closeCursor();
            if ($tabThemes==false){
                return NULL;
            }else{
                return $tabThemes;
            }
        }
    }*/
    
    
    public static function getToutesOeuvresParThemes(){
        $dbh = Database::connect();
        $query = "SELECT * FROM `oeuvres` ORDER BY `theme`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Oeuvre');
        $requestsucceeded=$sth->execute();
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $tabOeuvres = $sth->fetchAll();
            $sth->closeCursor();
            if ($tabOeuvres==false){
                return NULL;
            }else{
                return $tabOeuvres;
            }
        }
    }
    
     
     public static function insererOeuvre($titre,$artiste,$date,$commentaire,$theme,$reference,$extension){
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `oeuvres` (`titre`, `artiste`, `date`, `commentaire`, `theme`, `reference`, `extension`) VALUES(?,?,?,?,?,?,?)");
        $sth->execute(array($titre,$artiste,$date,$commentaire,$theme,$reference,$extension));

        $dbh = null; // Deconnexion de MySQL
     }
     
     
     
     public function deleteOeuvre(){
        $dbh = Database::connect();
        $oeuvre=Oeuvre::getOeuvre($_POST["reference"]);
        $ref=$oeuvre->reference;
        $ext=$oeuvre->extension;
        $query = "DELETE FROM `oeuvres` WHERE reference=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($ref));
        $dbh=NULL;
        unlink ("images/oeuvres/$ref.$ext");
        unlink("images/miniatures/$ref.$ext");
        header('Location: index.php?page=oeuvres');
    }
}

?>