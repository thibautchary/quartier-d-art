<?php
    require_once('utilities/utils.php');
    require_once('utilities/printForms.php');
?>



<div id="artists">
    <?php
        generateArtistsList();
    ?>
</div>   


<?php    
    if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
        printArtistForm($messageUploadArtiste);
    }
    
?>