<?php
    printChangePasswordForm();
    echo $messageChangePassword;
    if(Utilisateur::getUtilisateur($_SESSION["login"])->admin!=1){
    printDeleteUserForm();
    echo $messageDeleteUser;}
?>