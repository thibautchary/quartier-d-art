<?php

require_once ('utilities/databaseconnect.php');
require_once('utilities/upload.php');


class Evenement {
    public $titre;
    public $sousTitre;
    public $descriptif;
    public $permanent;
    public $dateDebut;
    public $dateFin;
    public $extension;
    public $id;
 
 
    
    public static function referenceMax(){
        $dbh = Database::connect();
        $query = "SELECT MAX(id) AS id FROM `evenements`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Evenement');
        $requestsucceeded=$sth->execute();
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $evenement = $sth->fetch();
            $sth->closeCursor();
            $refMax=$evenement->id;
            if ($evenement==false){
                return NULL;
            }else{
                return $refMax;
            }
        }
    }
    
    
    public static function getEvenement($id){
        $dbh = Database::connect();
        $query = "SELECT * FROM `evenements` WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Evenement');
        $requestsucceeded=$sth->execute(array($id));

        if(!$requestsucceeded){
            exit(0);
        }else{
            $evenement = $sth->fetch();
            $sth->closeCursor();
            if ($evenement==false){
                return NULL;
            }else{
                return $evenement;
            }
        }
    }
     
    
    public static function getTousEvenements(){
        $dbh = Database::connect();
        $query = "SELECT * FROM `evenements`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Evenement');
        $requestsucceeded=$sth->execute();
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $tabEvenements = $sth->fetchAll();
            $sth->closeCursor();
            if ($tabEvenements==false){
                return NULL;
            }else{
                return $tabEvenements;
            }
        }
    } 
     
     
     public static function insererEvenement($titre,$sousTitre,$descriptif,$permanent,$dateDebut,$dateFin,$extension,$id){
        //var_dump($permanent); 
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `evenements` (`titre`, `sousTitre`, `descriptif`, `permanent`, `dateDebut`, `dateFin`,`extension`,`id`) VALUES(?,?,?,?,?,?,?,?)");
        $sth->execute(array($titre,$sousTitre,$descriptif,$permanent,$dateDebut,$dateFin,$extension,$id));
        $dbh = null; // Deconnexion de MySQL
     }
    
     
     public function deleteEvenement(){
        $dbh = Database::connect();
        $evenement=Evenement::getEvenement($_POST["id"]);
        $id=$evenement->id;
        $ext=$evenement->extension;
        $query = "DELETE FROM `evenements` WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));
        $dbh=NULL;
        unlink ("images/evenements/$id.$ext");
        header('Location: index.php?page=expos');
    }
    
    public function updateEvenement($titre,$sousTitre,$descriptif,$permanent,$dateDebut,$dateFin,$extension){
         
         $dbh = Database::connect();
         $sth = $dbh->prepare("UPDATE `evenements` SET `titre`=? WHERE id=?");
         $sth->execute(array($titre,$this->id));
         $sth = $dbh->prepare("UPDATE `evenements` SET `sousTitre`=? WHERE id=?");
         $sth->execute(array($sousTitre,$this->id));
         $sth = $dbh->prepare("UPDATE `evenements` SET `descriptif`=? WHERE id=?");
         $sth->execute(array($descriptif,$this->id));
         $sth = $dbh->prepare("UPDATE `evenements` SET `permanent`=? WHERE id=?");
         $sth->execute(array($permanent,$this->id));
         $sth = $dbh->prepare("UPDATE `evenements` SET `dateDebut`=? WHERE id=?");
         $sth->execute(array($dateDebut,$this->id));
         $sth = $dbh->prepare("UPDATE `evenements` SET `dateFin`=? WHERE id=?");
         $sth->execute(array($dateFin,$this->id));
         $sth = $dbh->prepare("UPDATE `evenements` SET `extension`=? WHERE id=?");
         $sth->execute(array($extension,$this->id));
         $dbh=NULL;
     }
}


function createEvent(){
    if($_POST["permanent"]==1){
        if(isset($_POST["titre"]) && $_POST["titre"] != "" &&
        isset($_POST["descriptif"]) && $_POST["descriptif"] != "") {
            uploadEvenement();
        }
        else{
            return "Certains champs requis ne sont pas remplis.";
        }
    }
    elseif($_POST["permanent"]==0){
        if(isset($_POST["titre"]) && $_POST["titre"] != "" &&
        isset($_POST["descriptif"]) && $_POST["descriptif"] != "" &&
        isset($_POST["dateDebut"]) && $_POST["dateDebut"] != "" &&
        isset($_POST["dateFin"]) && $_POST["dateFin"] != "") {
            uploadEvenement();
        }
        else{
            return "Certains champs requis ne sont pas remplis.";
        }
    }
    else{
        return "Certains champs requis ne sont pas remplis.";
    }
}
?>