<?php 

require_once ('utilities/databaseconnect.php');
require_once('utilities/logInOut.php');
require_once ('utilities/mail.php');


class Format {
    public $format;
    public $type;
    public $largeur;
    public $hauteur;
    public $prix;
    public $id;
    
    
     public static function getFormat($id){
        $dbh = Database::connect();
        $query = "SELECT * FROM `formats` WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Format');
        $requestsucceeded=$sth->execute(array($id));
        
        if(!$requestsucceeded){
            exit(0);
        }else{
            $format = $sth->fetch();
            $sth->closeCursor();
            if ($format==false){
                return NULL;
            }else{
                return $format;
            }
        }
     }
     
     
     
     public static function getTousFormatsCarres(){
        $dbh = Database::connect();
        $query = "SELECT * FROM `formats` WHERE `format`='carre'";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Format');
        $requestsucceeded=$sth->execute();
        if(!$requestsucceeded){
            exit(0);
        }else{
            $tabFormats = $sth->fetchAll();
            $sth->closeCursor();
            if ($tabFormats==false){
                return NULL;
            }else{
                return $tabFormats;
            }
        }
     }

     
     
     public static function getTousFormatsStandardsParLargeur(){
        $dbh = Database::connect();
        $query = "SELECT * FROM `formats` WHERE `format`='standard' ORDER BY `largeur`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Format');
        $requestsucceeded=$sth->execute();
        if(!$requestsucceeded){
            exit(0);
        }else{
            $tabFormats = $sth->fetchAll();
            $sth->closeCursor();
            if ($tabFormats==false){
                return NULL;
            }else{
                return $tabFormats;
            }
        }
     }
     
     public static function insererFormat($format,$type,$largeur,$hauteur,$prix){
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `formats` (`format`, `type`, `largeur`, `hauteur`, `prix`, `id`) VALUES(?,?,?,?,?,?)");
        $sth->execute(array($format,$type,$largeur,$hauteur,$prix,'0'));
        $dbh = null; // Deconnexion de MySQL
     }
     
     
     public function updatePrix($prix){
         $dbh = Database::connect();
         $sth = $dbh->prepare("UPDATE `formats` SET prix=? WHERE id=?");
         $sth->execute(array($prix,$this->id));
         $dbh=NULL;
     }
     

    public function deleteFormat(){
        $dbh = Database::connect();
        $query = "DELETE FROM `formats` WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($_POST["id"]));
        $dbh=NULL;
        header('Location: index.php?page=formats');
    }
}


function registerFormat(){
    if(isset($_POST["largeur"]) && $_POST["largeur"] != "" &&
    isset($_POST["hauteur"]) && $_POST["hauteur"] != "" &&
    isset($_POST["prix"]) && $_POST["prix"] != ""){
        if($_POST["format"]=="carre"){
            Format::insererFormat($_POST["format"],"NC",$_POST["largeur"],$_POST["hauteur"],$_POST["prix"]);
            header('Location: index.php?page=formats');
            echo "Insertion réussie";
        }
        elseif($_POST["format"]=="standard" && $_POST["type"]!=null){
            Format::insererFormat($_POST["format"],$_POST["type"],$_POST["largeur"],$_POST["hauteur"],$_POST["prix"]);
            header('Location: index.php?page=formats');
            echo "Insertion réussie";
        }
        else echo "Certains champs requis ne sont pas remplis.";
    }
    else echo "Certains champs requis ne sont pas remplis.";
}


function changePrix(){
    if(isset($_POST["prix"]) && $_POST["prix"] != ""){
        $format=Format::getFormat($_POST["id"]);
        $format->updatePrix($_POST["prix"]);
        header('Location: index.php?page=formats');
    }
}
?>