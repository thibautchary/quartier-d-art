<?php
    require_once('utilities/utils.php');
    require_once('utilities/printForms.php');
?>
    
<div id="professeurs">
    <?php
        generateProfesseursList();

        if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
            printProfesseurForm($messageUploadProfesseur);
        }
    ?>
</div>