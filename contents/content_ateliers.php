<?php
    require_once('utilities/utils.php');
    require_once('utilities/printForms.php');
?>

<div id="ateliers">
    <?php
        generateAteliersList();

        if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
            printAtelierForm($messageUploadAtelier);
        }
    ?>
</div>