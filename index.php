<?php 
    session_name("MaRaffeSession");
    session_start();
    if (!isset($_SESSION['initiated'])) {
        session_regenerate_id();
        $_SESSION['initiated'] = true;
    }
require_once('utilities/printForms.php');
require_once('utilities/logInOut.php');
require_once('utilities/utils.php');
require_once('utilities/upload.php');
require_once('utilities/event.php');
require_once('utilities/acceptRefuseUser.php');
require_once('utilities/artiste.php');
require_once('utilities/professeur.php');
require_once('utilities/format.php');
require_once('utilities/oeuvre.php');


if(isset($_GET['page']) && pageInMenu($_GET["page"])){
    $askedPage=$_GET['page'];
}
elseif(isset($_GET['page'])){
    if(pageInGalerie($_GET["page"])){
        $askedPage='galerie';
        $askedUnderPage=$_GET["page"];
    }
    elseif(pageInCours($_GET["page"])){
        $askedPage='cours';
        $askedUnderPage=$_GET["page"];
    }
    if($_GET["page"]=='register'){
        $askedPage='accueil';
        $askedUnderPage='register';
    }
    if($_GET["page"]=='administration'){
        $askedPage ='accueil';
        $askedUnderPage='administration';
    }
    if($_GET["page"]=='utilisateurs'){
        $askedPage ='accueil';
        $askedUnderPage='utilisateurs';
    }
}
else{
    $askedPage='accueil';
}



$authorized=checkPage($askedPage);
$authorizedUnderPage=checkPage($askedUnderPage);



if($authorizedUnderPage){
    $pageTitle=getPageTitle($askedUnderPage);
}
elseif($authorized){
    $pageTitle=getPageTitle($askedPage);
}
else{
    $pageTitle='Erreur';
}


if(isset($_GET['todo'])){
    switch ($_GET['todo']) {
    case 'login' : $messageLogin=logIn(); break;
    case 'logout' : logOut(); break;
    case 'changepassword': $messageChangePassword=changepassword(); break;
    case 'changeprix': changePrix(); break;
    case 'updateartiste' : uploadUpdateArtiste(); break;
    case 'updateprofesseur' : uploadUpdateProfesseur(); break;
    case 'updateevent' : uploadUpdateEvent(); break;
    case 'updateatelier' : uploadUpdateAtelier(); break;
    case 'uploadoeuvre' : $messageUploadOeuvre=uploadOeuvre(); break;
    case 'acceptusers' : acceptRefuseUser(); break;
    case 'createevent' : $messageUploadEvent=createEvent(); break;
    case 'createatelier' : $messageUploadAtelier=createAtelier(); break;
    case 'register' : $messageRegister=register(); break;
    case 'registerartist' : $messageUploadArtiste=registerArtist(); break;
    case 'registerprofesseur' : $messageUploadProfesseur=registerProfesseur(); break;
    case 'registerformat' : $messageInsertFormat=registerFormat(); break;
    case 'deleteoeuvre' : Oeuvre::deleteOeuvre(); break;
    case 'deleteartiste' : Artiste::deleteArtiste(); break;
    case 'deleteprofesseur' : Professeur::deleteProfesseur(); break;
    case 'deleteatelier' : Atelier::deleteAtelier(); break;
    case 'deleteformat' : Format::deleteFormat(); break;
    case 'deleteevent' : Evenement::deleteEvenement();
    case 'deleteuser': $messageDeleteUser=deleteUser(); break;
    }
}



generateHTMLHeader($pageTitle, $_SESSION, $messageRegister, $messageLogin);
?>
<div class="main">
<?php

echo '<div id = "galerie-menu">'.PHP_EOL;
    generateMenu($askedPage);
echo '</div>'.PHP_EOL;


if($authorizedUnderPage){
    $fichierPage = 'contents/content_'.$askedUnderPage.'.php';
    if($pageTitle != "S'enregistrer"){
        if(pageInGalerie($askedUnderPage)) generateSousMenuGalerie($askedUnderPage);
        elseif(pageInCours($askedUnderPage)) generateSousMenuCours ($askedUnderPage);
    }
    echo "<div class='contenu'>";
    require_once($fichierPage);
    echo"</div>";
}
elseif($authorized){
    $fichierPage = 'contents/content_'.$askedPage.'.php';
    if($pageTitle != "S'enregistrer"){
        if($askedPage=='galerie') generateSousMenuGalerie($askedUnderPage);
        if($askedPage=='cours') generateSousMenuCours($askedUnderPage);
        echo "<div class='contenu'>";
        require_once($fichierPage);
        echo "</div>";
    }
    require_once($fichierPage);
}
else{
    echo "Vous devez être connecté pour avoir accès à cette page.";
}

/*

        <aside id="sidebar">
                <h3>Catégories</h3>
                <nav>
                    <ul>
                        <li><a href="#">Permet</a></li>
                        <li><a href="#">d avoir</a></li>
                        <li><a href="#">une </a></li>
                        <li><a href="#">zone info</a></li>
                        <li><a href="#">souvent independante</a></li>
                        <li><a href="#">de la page</a></li>
                    </ul>                   
                </nav>
        </aside>
</div><!-- main -->

 */
generateHTMLFooter();
?>