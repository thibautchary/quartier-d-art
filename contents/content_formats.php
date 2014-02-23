<?php
    require_once('utilities/utils.php');
    require_once('utilities/printForms.php');
?>

<h2>Les formats et les prix</h2>

<div id="formats">
    <?php
        generateFormatStandardList();
        generateFormatCarreList();
    ?>
</div> 


<?php    
    if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
        printFormatForm($messageInsertFormat);
    }
?>