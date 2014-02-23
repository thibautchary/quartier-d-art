<?php
    require_once('utilities/utils.php');
    require_once('utilities/printForms.php');
?>

 
<div id="gallery">
    <?php
        generateGallery();
    ?>
</div>



<?php    
    if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
        printUploadOeuvreForm($messageUploadOeuvre);
    }
?>