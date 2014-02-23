<?php
require_once ('utilities/databaseconnect.php');
require_once ('utilities/oeuvre.php');
require_once ('utilities/artiste.php');
require_once ('utilities/professeur.php');
require_once ('utilities/atelier.php');



function uploadOeuvre(){
    
    if(isset($_POST["titre"]) && $_POST["titre"] != "" &&
    isset($_POST["artiste"]) && $_POST["artiste"] != "" &&
    isset($_POST["date"]) && $_POST["date"] != "" &&
    isset($_POST["commentaire"]) && $_POST["commentaire"] != "" &&
    isset($_POST["theme"]) && $_POST["theme"] != "") {
        if (!empty($_FILES["photo"]["tmp_name"]) && is_uploaded_file($_FILES["photo"]["tmp_name"])) {
            if ($_FILES['photo']['size'] <= 1000000){
                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES["photo"]['name']);
                $extension_upload = $infosfichier['extension'];
                //attention j'accepte 4 extensions mais dans createminiature je n'en ai que 3
                $extensions_autorisees = array('jpg', 'jpeg', 'gif','png');
                if (in_array($extension_upload,$extensions_autorisees)) {
                    $refImage=  Oeuvre::referenceMax()+1;
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"],"images/oeuvres/".$refImage.".".$extension_upload)) {
                            Oeuvre::insererOeuvre($_POST["titre"],$_POST["artiste"],$_POST["date"],$_POST["commentaire"],$_POST["theme"],$refImage,$extension_upload);
                            createMiniature("miniatures","images/oeuvres/".$refImage.".".$extension_upload, $extension_upload, $refImage, 200, 150);
                            header('Location: index.php?page=oeuvres');
                            echo "Upload réussi";
                    }
                    else echo "Echec de l'upload";
                }
                else echo "Mauvais type de fichier";    
            }
            else echo "Fichier trop gros";
        } else echo "Erreur Upload";
    }
    else echo "Veuillez renseigner tous les champs";
}


function uploadArtiste(){
    if (!empty($_FILES["photo"]["tmp_name"]) && is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        if ($_FILES['photo']['size'] <= 1000000){
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES["photo"]['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg');
            if (in_array($extension_upload,$extensions_autorisees)) {
                $refImage=  Artiste::referenceMax()+1;
                if (move_uploaded_file($_FILES["photo"]["tmp_name"],"images/artistes/".$refImage.".".$extension_upload)) {
                    createMiniature("artistes","images/artistes/".$refImage.".".$extension_upload, $extension_upload, $refImage, 200, 150);
                    Artiste::insererArtiste($_POST["surnom"],$_POST["fonction"],$_POST["texte"],$refImage,$extension_upload);
                    header('Location: index.php?page=artistes');
                    echo "<p>Upload réussi</p>";
                }
                else echo "Echec de l'upload";
            }
            else echo "Mauvais type de fichier";    
        }
        else echo"Fichier trop gros";
    }
    else echo "Echec de l'upload";
}


function uploadProfesseur(){
    if (!empty($_FILES["photo"]["tmp_name"]) && is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        if ($_FILES['photo']['size'] <= 1000000){
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES["photo"]['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg');
            if (in_array($extension_upload,$extensions_autorisees)) {
                $refImage=  Professeur::referenceMax()+1;
                if (move_uploaded_file($_FILES["photo"]["tmp_name"],"images/professeurs/".$refImage.".".$extension_upload)) {
                    createMiniature("professeurs","images/professeurs/".$refImage.".".$extension_upload, $extension_upload, $refImage, 200, 150);
                    Professeur::insererProfesseur($_POST["surnom"],$_POST["fonction"],$_POST["texte"],$refImage,$extension_upload);
                    header('Location: index.php?page=professeurs');
                    echo "<p>Upload réussi</p>";
                }
                else echo "Echec de l'upload";
            }
            else echo "Mauvais type de fichier";    
        }
        else echo"Fichier trop gros";
    }
    else echo "Echec de l'upload";
}


function uploadEvenement(){
    if (!empty($_FILES["photo"]["tmp_name"]) && is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        if ($_FILES['photo']['size'] <= 1000000){
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES["photo"]['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg');
            if (in_array($extension_upload,$extensions_autorisees)) {
                $refImage=  Evenement::referenceMax()+1;
                if (move_uploaded_file($_FILES["photo"]["tmp_name"],"images/evenements/".$refImage.".".$extension_upload)) {
                    createMiniature("evenements","images/evenements/".$refImage.".".$extension_upload, $extension_upload, $refImage, 200, 150);
                    Evenement::insererEvenement($_POST["titre"],$_POST["sousTitre"],$_POST["descriptif"],$_POST["permanent"],$_POST["dateDebut"],$_POST["dateFin"],$extension_upload,$refImage);
                    header('Location: index.php?page=expos');
                    echo "<p>Upload réussi</p>";
                }
                else echo "Echec de l'upload";
            }
            else echo "Mauvais type de fichier";    
        }
        else echo"Fichier trop gros";
    }
    else echo "Echec de l'upload";
}



function uploadAtelier(){
    if (!empty($_FILES["photo"]["tmp_name"]) && is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        if ($_FILES['photo']['size'] <= 1000000){
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES["photo"]['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg');
            if (in_array($extension_upload,$extensions_autorisees)) {
                $refImage=  Atelier::referenceMax()+1;
                if (move_uploaded_file($_FILES["photo"]["tmp_name"],"images/ateliers/".$refImage.".".$extension_upload)) {
                    createMiniature("ateliers","images/ateliers/".$refImage.".".$extension_upload, $extension_upload, $refImage, 200, 150);
                    Atelier::insererAtelier($_POST["titre"],$_POST["sousTitre"],$_POST["texte"],$refImage,$extension_upload);
                    header('Location: index.php?page=ateliers');
                    echo "<p>Upload réussi</p>";
                }
                else echo "Echec de l'upload";
            }
            else echo "Mauvais type de fichier";    
        }
        else echo"Fichier trop gros";
    }
    elseif(empty($_FILES["photo"]["tmp_name"])){
        $id=  Atelier::referenceMax()+1;
        Atelier::insererAtelier($_POST["titre"],$_POST["sousTitre"],$_POST["texte"],$id,'vide');
        header('Location: index.php?page=ateliers');
    }
    else echo "Echec de l'upload";
}

function uploadUpdateArtiste(){
    if (!empty($_FILES["photo"]["tmp_name"]) && is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        if ($_FILES['photo']['size'] <= 1000000){
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES["photo"]['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg');
            if (in_array($extension_upload,$extensions_autorisees)) {
                $artiste=Artiste::getArtiste($_POST["surnom"]);
                $refImage=  $artiste->id;
                if (move_uploaded_file($_FILES["photo"]["tmp_name"],"images/artistes/".$refImage.".".$extension_upload)) {
                    createMiniature("artistes","images/artistes/".$refImage.".".$extension_upload, $extension_upload, $refImage, 200, 150);
                    $artiste->updateArtiste($_POST["fonction"],$_POST["texte"],$extension_upload);
                    header('Location: index.php?page=artistes');
                    echo "<p>Upload réussi</p>";
                }
                else echo "Echec de l'upload";
            }
            else echo "Mauvais type de fichier";    
        }
        else echo"Fichier trop gros";
    }
    else echo "Echec de l'upload";
}


function uploadUpdateProfesseur(){
    if (!empty($_FILES["photo"]["tmp_name"]) && is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        if ($_FILES['photo']['size'] <= 1000000){
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES["photo"]['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg');
            if (in_array($extension_upload,$extensions_autorisees)) {
                $professeur=Professeur::getProfesseur($_POST["surnom"]);
                $refImage=  $professeur->id;
                if (move_uploaded_file($_FILES["photo"]["tmp_name"],"images/professeurs/".$refImage.".".$extension_upload)) {
                    createMiniature("professeurs","images/professeurs/".$refImage.".".$extension_upload, $extension_upload, $refImage, 200, 150);
                    $professeur->updateProfesseur($_POST["fonction"],$_POST["texte"],$extension_upload);
                    header('Location: index.php?page=professeurs');
                    echo "<p>Upload réussi</p>";
                }
                else echo "Echec de l'upload";
            }
            else echo "Mauvais type de fichier";    
        }
        else echo"Fichier trop gros";
    }
    else echo "Echec de l'upload";
}


function uploadUpdateEvent(){
    if (!empty($_FILES["photo"]["tmp_name"]) && is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        if ($_FILES['photo']['size'] <= 1000000){
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES["photo"]['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg');
            if (in_array($extension_upload,$extensions_autorisees)) {
                $event=Evenement::getEvenement($_POST["id"]);
                $refImage=$event->id;
                if (move_uploaded_file($_FILES["photo"]["tmp_name"],"images/evenements/".$_POST["id"].".".$extension_upload)) {
                    createMiniature("evenements","images/evenements/".$refImage.".".$extension_upload, $extension_upload, $refImage, 200, 150);
                    $event->updateEvenement($_POST["titre"],$_POST["sousTitre"],$_POST["descriptif"],$_POST["permanent"],$_POST["dateDebut"],$_POST["dateFin"],$extension_upload);
                    header('Location: index.php?page=expos');
                    echo "<p>Upload réussi</p>";
                }
                else echo "Echec de l'upload";
            }
            else echo "Mauvais type de fichier";    
        }
        else echo"Fichier trop gros";
    }
    else echo "Echec de l'upload";
}

function uploadUpdateAtelier(){
    if (!empty($_FILES["photo"]["tmp_name"]) && is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        if ($_FILES['photo']['size'] <= 1000000){
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES["photo"]['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg');
            if (in_array($extension_upload,$extensions_autorisees)) {
                $atelier=Atelier::getAtelier($_POST["id"]);
                $refImage=$atelier->id;
                if (move_uploaded_file($_FILES["photo"]["tmp_name"],"images/ateliers/".$_POST["id"].".".$extension_upload)) {
                    createMiniature("ateliers","images/ateliers/".$refImage.".".$extension_upload, $extension_upload, $refImage, 200, 150);
                    $atelier->updateAtelier($_POST["titre"],$_POST["sousTitre"],$_POST["texte"],$extension_upload);
                    header('Location: index.php?page=ateliers');
                    echo "<p>Upload réussi</p>";
                }
                else echo "Echec de l'upload";
            }
            else echo "Mauvais type de fichier";    
        }
        else echo"Fichier trop gros";
    }
    elseif(empty($_FILES["photo"]["tmp_name"])){
        $id=  Atelier::referenceMax()+1;
        $atelier=Atelier::getAtelier($_POST["id"]);
        $atelier->updateAtelier($_POST["titre"],$_POST["sousTitre"],$_POST["texte"],$id,"vide");
        header('Location: index.php?page=ateliers');
    }
    else echo "Echec de l'upload";
}
?>