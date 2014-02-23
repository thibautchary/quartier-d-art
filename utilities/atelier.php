<?php

require_once ('utilities/databaseconnect.php');
require_once('utilities/upload.php');


class Atelier {
    public $titre;
    public $sousTitre;
    public $texte;
    public $id;
    public $extension;
 
    
    
    
    public static function referenceMax(){
        $dbh = Database::connect();
        $query = "SELECT MAX(id) AS id FROM `ateliers`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Atelier');
        $requestsucceeded=$sth->execute();
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $atelier = $sth->fetch();
            $sth->closeCursor();
            $refMax=$atelier->id;
            if ($atelier==false){
                return NULL;
            }else{
                return $refMax;
            }
        }
    }
    
    
    public static function getAtelier($id){
        $dbh = Database::connect();
        $query = "SELECT * FROM `ateliers` WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Atelier');
        $requestsucceeded=$sth->execute(array($id));

        if(!$requestsucceeded){
            exit(0);
        }else{
            $atelier = $sth->fetch();
            $sth->closeCursor();
            if ($atelier==false){
                return NULL;
            }else{
                return $atelier;
            }
        }
    }
     
    
    public static function getTousAteliers(){
        $dbh = Database::connect();
        $query = "SELECT * FROM `ateliers`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Atelier');
        $requestsucceeded=$sth->execute();
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $tabAteliers = $sth->fetchAll();
            $sth->closeCursor();
            if ($tabAteliers==false){
                return NULL;
            }else{
                return $tabAteliers;
            }
        }
    } 
     
     
     public static function insererAtelier($titre,$sousTitre,$texte,$id,$extension){
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `ateliers` (`titre`, `sousTitre`, `texte`, `id`, `extension`) VALUES(?,?,?,?,?)");
        $sth->execute(array($titre,$sousTitre,$texte,$id,$extension));

        $dbh = null; // Deconnexion de MySQL
     }
    
     
     public function deleteAtelier(){
        $dbh = Database::connect();
        $atelier=Atelier::getAtelier($_POST["id"]);
        $ref=$atelier->id;
        $ext=$atelier->extension;
        $query = "DELETE FROM `ateliers` WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($ref));
        $dbh=NULL;
        if($ext!="vide") unlink ("images/ateliers/$ref.$ext");
        header('Location: index.php?page=ateliers');
    }
    
    
    public function updateAtelier($titre,$sousTitre,$texte,$extension){
         $dbh = Database::connect();
         $sth = $dbh->prepare("UPDATE `ateliers` SET `titre`=? WHERE id=?");
         $sth->execute(array($titre,$this->id));
         $sth = $dbh->prepare("UPDATE `ateliers` SET `sousTitre`=? WHERE id=?");
         $sth->execute(array($sousTitre,$this->id));
         $sth = $dbh->prepare("UPDATE `ateliers` SET `texte`=? WHERE id=?");
         $sth->execute(array($texte,$this->id));
         $sth = $dbh->prepare("UPDATE `ateliers` SET `extension`=? WHERE id=?");
         $sth->execute(array($extension,$this->id));
         $dbh=NULL;
     }
}

function createAtelier(){
        if(isset($_POST["titre"]) && $_POST["titre"] != "" &&
        isset($_POST["texte"]) && $_POST["texte"] != "") {
            uploadAtelier();
        }
        else{
            return "Certains champs requis ne sont pas remplis.";
        }
}
?>