<?php

function sendMailRequest(){
    //changer cette adresse mail
    $to="thibaut.chary@gmail.com";
    $subject="Quartier d'Art - Demande d'inscription";
    $msg = "Une nouvelle demande d'inscription en attente. Pour la consulter : <a href='contents/content_utilisateurs.php'>Quartier d'Art</a>";
    
    mail($to, $subject, $msg);
}

function sendMailRefusal($to){
    $subject="Quartier d'Art - Inscription refusée";
    $msg = "Votre demande d'inscription au site Quartier d'Art a été refusée. Vous n'êtes pas affilié à cette galerie.</br></br>
            L'équipe Quartier d'Art.";

    mail($adresse, $subject, $msg);
}

function sendMailAccepted($to){
    $subject="Quartier d'Art - Inscription acceptée";
    $msg = "Votre demande d'inscription au site Quartier d'Art a été acceptée. Rendez-vous vite sur <a href='contents/content_accueil.php'>Quartier d'Art</a>.</br></br>
            L'équipe Quartier d'Art.";

    mail($adresse, $subject, $msg);
}
?>