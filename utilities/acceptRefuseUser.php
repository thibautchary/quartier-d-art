<?php
require_once('utilities/utilisateur.php');
require_once('utilities/mail.php');

function acceptRefuseUser(){
    if(isset($_POST["accepter"])){
        Utilisateur::getUtilisateur($_POST["login"])->validerUtilisateur();
        sendMailAccepted($_POST["email"]);
        header('Location: index.php?page=utilisateurs');
    }
    else{
        sendMailRefusal($_POST["email"]);
        Utilisateur::getUtilisateur($_POST["login"])->deleteUser();
        header('Location: index.php?page=utilisateurs');
    }
}
?>