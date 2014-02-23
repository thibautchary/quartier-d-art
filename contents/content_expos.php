<?php
    require_once('utilities/utils.php');
    require_once('utilities/printForms.php');
?>


<div id="events">
    <?php
        generateEventsList();
    ?>
</div> 


<?php    
    if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
        printEventForm($messageUploadEvent);
    }
?>