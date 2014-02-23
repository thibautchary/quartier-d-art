<?php
session_start();
require_once('utilities/utilisateur.php');

function logIn(){
    $user = Utilisateur::getUtilisateur($_POST["login"]);
    if(!$user==null){
        if($user->testerMdp($_POST["password"])){
            $_SESSION['loggedIn']=true;
            $_SESSION['login']=$_POST['login'];
            $_SESSION['nom']=$user->nom;
            $_SESSION['prenom']=$user->prenom;
            if($user->admin==1){
                $_SESSION['admin']=true;
            }
            else{
                $_SESSION['admin']=false;

            }
        }
        else{
            $_SESSION['loggedIn']=false;
            return "Mot de passe invalide";
        }
    }
    else{
        $_SESSION['loggedIn']=false;
        return "Utilisateur non enregistré";
    }
}

function logOut(){
    session_unset();
    session_destroy();
    $_SESSION['loggedIn']=false;
}
?>