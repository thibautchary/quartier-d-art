<?php

$page_list = array(
array(
    "name"=>"accueil",
    "title"=>"Accueil",
    "menutitle"=>"Accueil",
    "access"=>"0"),//access=0 correspond à un accès libre et à une page qui va apparaître dans le menu
array(
    "name"=>"galerie",
    "title"=>"La galerie et les expositions",
    "menutitle"=>"Galerie & Expos",
    "access"=>"0"),
array(
    "name"=>"cours",
    "title"=>"Les cours",
    "menutitle"=>"Cours",
    "access"=>"0"),
array(
    "name"=>"contact",
    "title"=>"Comment nous contacter ?",
    "menutitle"=>"Contact",
    "access"=>"0"),
array(
    "name"=>"acces",
    "title"=>"Accès",
    "menutitle"=>"Accès",
    "access"=>"0"),
array(
    "name"=>"administration",
    "title"=>"Mon compte",
    "menutitle"=>"Mon compte",
    "access"=>"1"),//accès seulement si je suis loggé
array(
    "name"=>"utilisateurs",
    "title"=>"Gestion des utilisateurs",
    "menutitle"=>"Gestion utilisateurs",
    "access"=>"2"),//acces admin
array(
    "name"=>"register",
    "title"=>"S'enregistrer",
    "menutitle"=>"S'enregistrer",
    "access"=>"3"),//access=3 correspond aux pages appartenant à la partie accueil et accessibles de tous
array(
    "name"=>"artistes",
    "title"=>"Les artistes",
    "menutitle"=>"Artistes",
    "access"=>"4"),//access=4 correspond aux pages appartenant à la partie galerie et accessibles de tous
array(
    "name"=>"oeuvres",
    "title"=>"Les oeuvres de la galerie",
    "menutitle"=>"Œuvres",
    "access"=>"4"),
array(
    "name"=>"expos",
    "title"=>"Les expositions",
    "menutitle"=>"Expositions",
    "access"=>"4"),
array(
    "name"=>"formats",
    "title"=>"Les formats et leurs tarifs",
    "menutitle"=>"Formats & Tarifs",
    "access"=>"4"),
array(
    "name"=>"ateliers",
    "title"=>"Les ateliers",
    "menutitle"=>"Ateliers",
    "access"=>"5"),//access=5 correspond aux pages appartenant à la partie cours et accessibles de tous
array(
    "name"=>"professeurs",
    "title"=>"L'équipe enseignante",
    "menutitle"=>"Équipe enseignante",
    "access"=>"5"),
array(
    "name"=>"emploidutemps",
    "title"=>"L'emploi du temps",
    "menutitle"=>"Emploi du temps",
    "access"=>"5")
);



function getPageTitle($askedPage){
    global $page_list;
    foreach($page_list as $page){
        if($askedPage==$page["name"]){
            return $page["title"];
        }
    }
}

function checkPage($askedPage){
    global $page_list;
    foreach($page_list as $page){
        if($askedPage==$page["name"]){
            if($page["access"]=="5" ||$page["access"]=="4" ||$page["access"]=="3" ||$page["access"]=="0" || ($page["access"]=="1" && $_SESSION['loggedIn']==true && userIsValid($_SESSION["login"])) || ($page["access"]=="2" && $_SESSION['admin']==true)){
                return true;
            }
        }
    }
    return false;
}

function pageInMenu($askedPage){
    global $page_list;
    foreach($page_list as $page){
        if($askedPage==$page["name"]){
            if($page["access"]=="0"){
                return true;
            }
        }
    }
    return false;
}

function pageInGalerie($askedUnderPage){
    global $page_list;
    foreach($page_list as $page){
        if($askedUnderPage==$page["name"]){
            if($page["access"]=="4"){
                return true;
            }
        }
    }
    return false;
}

function pageInCours($askedUnderPage){
    global $page_list;
    foreach($page_list as $page){
        if($askedUnderPage==$page["name"]){
            if($page["access"]=="5"){
                return true;
            }
        }
    }
    return false;
}

function generateMenu($askedPage){
    $page_menu =0;
    if ($askedPage != register) $page_menu=$askedPage;
    else $page_menu="accueil";
    global $page_list;
    foreach($page_list as $page){
        if($page["access"]==0){
            $reference = "index.php?page=".$page["name"];
            $menuName = $page["menutitle"];
            if($page_menu==$page["name"])
                echo '<a href="'.$reference.'" class="m_select" ><img src="css/images/'.$page[name].'.jpg" alt  ='.$menuName.'/>'.PHP_EOL.'</a>'; 
            else
                echo '<a href="'.$reference.'"><img src="css/images/'.$page[name].'.jpg" alt  ='.$menuName.'/>'.PHP_EOL.'</a>'; 
        }
    };
}


function generateSousMenuGalerie($askedUnderPage){
    global $page_list;
    echo "<div id='submenu'>";
    echo "<ul>";
    foreach($page_list as $page){
        if($page["access"]=="4"){
            $reference = "index.php?page=".$page["name"];
            $menuName = $page["menutitle"];
            if($askedUnderPage==$page["name"]){
                echo '<li><a href="'.$reference.'" class = "m_title m_selected" >'.$page[menutitle].'</a></li>'; }
            else
                echo '<li><a href="'.$reference.'" class = "m_title" >'.$page[menutitle].'</a></li>';             
        }
    };
    echo "</ul>";
    echo "</div>";
}

function generateSousMenuCours($askedUnderPage){
    global $page_list;
    echo "<div id='submenu'>";
    echo "<ul>";
    foreach($page_list as $page){
        if($page["access"]=="5"){
            $reference = "index.php?page=".$page["name"];
            $menuName = $page["menutitle"];
            if($askedUnderPage==$page["name"]){
                echo '<li><a href="'.$reference.'" class = "m_title m_selected" >'.$page[menutitle].'</a></li>'; }
            else
                echo '<li><a href="'.$reference.'" class = "m_title" >'.$page[menutitle].'</a></li>'; 
        }
    };
    echo "</ul>";
    echo "</div>";
}



function generateGallery(){
    $tabOeuvres=Oeuvre::getToutesOeuvresParThemes();
    $themePrecedent=$tabOeuvres[0]->theme;
    if($tabOeuvres==null){
        echo "Pas d'oeuvre pour le moment.";
    }
    else{
        echo <<<END
        <div class ="afficherMasquer">
        <div class = "clique">$themePrecedent</div>
        <div class="hidden">
END;
        foreach($tabOeuvres as $oeuvre){
            if($oeuvre->theme==$themePrecedent){
                echo <<<END
                        <a href=images/oeuvres/$oeuvre->reference.$oeuvre->extension title=$oeuvre->titre>
                            <img class = "image" src=images/miniatures/$oeuvre->reference.$oeuvre->extension height="140" alt=$oeuvre->titre />
                        </a>
END;
                if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
                    printDeleteOeuvreForm($oeuvre->reference);
                }
                
            }
            else{
                echo <<<END
                </div>
                </div>
                <div class ="afficherMasquer">
                <div class = "clique">$oeuvre->theme</div>
                <div class="hidden">
                        <a href=images/oeuvres/$oeuvre->reference.$oeuvre->extension title=$oeuvre->titre>
                            <img class = "image" src=images/miniatures/$oeuvre->reference.$oeuvre->extension height="140" alt=$oeuvre->titre />
                        </a>
END;
                if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
                    printDeleteOeuvreForm($oeuvre->reference);
                }
            }
            $themePrecedent=$oeuvre->theme;
        }
        echo <<<END
        </div>
        </div>
END;
    }
}




function generateArtistsList(){
    $n=0;
    require_once('utilities/artiste.php');
    $tabArtistes=Artiste::getTousArtistes();
    if($tabArtistes==null){
        echo "Pas d'artiste pour le moment.";
    }
    else{
        foreach($tabArtistes as $artiste){
            echo '<div class= "artiste">';
            if($artiste->fonction!=null){
                echo <<<END
                        <h2>$artiste->fonction : $artiste->surnom</h2>
                        <img src=images/artistes/$artiste->id.$artiste->extension alt=$artiste->surnom title=$artiste->surnom>
                        <div class= "txt">
                            $artiste->texte
                        </div>
END;
                if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
                    printDeleteArtisteForm($artiste->surnom);
                    printUpdateArtisteForm($n,$artiste->surnom);
                    $n=$n+1;
                }
                echo '</div>';
            }
            else{
                echo <<<END
                        <h2>$artiste->surnom</h2>
                        <img src=images/artistes/$artiste->id.$artiste->extension alt=$artiste->surnom title=$artiste->surnom>
                        <div class= "txt">
                            $artiste->texte
                        </div>
END;
                if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
                    printDeleteArtisteForm($artiste->surnom);
                    printUpdateArtisteForm($n,$artiste->surnom);
                    $n=$n+1;
                }
                echo '</div>';
            }
        }
    }
}


function generateProfesseursList(){
    $n=0;
    require_once('utilities/professeur.php');
    $tabProfesseurs=Professeur::getTousProfesseurs();
    if($tabProfesseurs==null){
        echo "Pas de professeur actuellement.";
    }
    else{
        foreach($tabProfesseurs as $professeur){
            echo '<div class = "prof">';
            if($professeur->fonction!=null){
                echo <<<END
                        <h2>$professeur->fonction : $professeur->surnom</h2>
                        <img src=images/professeurs/$professeur->id.$professeur->extension alt=$professeur->surnom title=$professeur->surnom>
                        <div class= "txt">
                            $professeur->texte
                        </div>
END;
                if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
                    printDeleteProfesseurForm($professeur->surnom);
                    printUpdateProfesseurForm($n,$professeur->surnom);
                    $n=$n+1;
                }
                echo '</div>';
            }
            else{
                echo <<<END
                        <h2>$professeur->surnom</h2>
                        <img src=images/professeurs/$professeur->id.$professeur->extension alt=$professeur->surnom title=$professeur->surnom>
                        <div class= "txt">
                            $professeur->texte
                        </div>
END;
                if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
                    printDeleteProfesseurForm($professeur->surnom);
                    printUpdateProfesseurForm($n,$professeur->surnom);
                    $n=$n+1;
                }
                echo '</div>';
            }
        }
    }
}




function generateEventsList(){
    $n=0;
    require_once('utilities/event.php');
    $tabEvenements=Evenement::getTousEvenements();
    if($tabEvenements==null){
        echo "Pas d'événement prévu pour le moment.";
    }
    else{
        foreach($tabEvenements as $evenement){
            echo '<div class = "expo">';
            echo <<<END
            <h2>
                $evenement->titre
            </h2>
            <h3>
                $evenement->sousTitre
            </h3>
END;
            if($evenement->permanent){
                echo '<div class="date">';
                echo 'Exposition permanente';
                echo '</div>';
            }
            else{
                echo <<<END
                <div class="date">
                    Du $evenement->dateDebut au $evenement->dateFin
                </div>
END;
            }
            echo <<<END
            <br><img src=images/evenements/$evenement->id.$evenement->extension alt=$evenement->titre title=$evenement->titre>
            <div class= "txt">
                $evenement->descriptif
            </div>
END;
            if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
                printDeleteEventForm($evenement->id);
                printUpdateEventForm($n,$evenement->id);
                $n=$n+1;
            }
            echo '</div>';
        }
    }
}


function generateAteliersList(){
    $n=0;
    require_once('utilities/atelier.php');
    $tabAteliers=Atelier::getTousAteliers();
    if($tabAteliers==null){
        echo "Pas d'atelier pour le moment.";
    }
    else{
        foreach($tabAteliers as $atelier){
            echo '<div class= "atelier">';
            echo <<<END
            <h2>
                $atelier->titre
            </h2>
            <h3>
                $atelier->sousTitre
            </h3>
END;
            if($atelier->extension!="vide"){
                echo "<img src=images/ateliers/$atelier->id.$atelier->extension alt=$atelier->titre title=$atelier->titre>";
            }   
            echo <<<END
                <div class= "txt">
                    $atelier->texte
                </div>
END;
            if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
                printDeleteAtelierForm($atelier->id);
                printUpdateAtelierForm($n,$atelier->id);
                $n=$n+1;
            }
            echo '</div>';
        }
    }
}



function generateFormatStandardList(){
    $tab=Format::getTousFormatsStandardsParLargeur();
    if($tab==null){
        echo "Prix pour les formats standards non référencés.";
    }
    else{
        echo '<table>';
        echo "<thead>";
        echo '<tr>';
        if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
            echo '<th>Figure</th>';
            echo '<th></th>';
            echo '<th>Paysage</th>';
            echo '<th></th>';
            echo '<th>Marine</th>';
            echo '<th></th>';
            echo '<th>Prix</th>';
            echo '<th></th>';
        }
        else{
            echo '<th>Figure</th>';
            echo '<th>Paysage</th>';
            echo '<th>Marine</th>';
            echo '<th>Prix</th>';
        }
        echo '</tr>';
        echo "</thead>";
        echo "<tbody>";
        echo '<tr>';
        $largeurPrecedente=$tab[0]->largeur;
        foreach($tab as $format){
            if($format->largeur==$largeurPrecedente){
                echo "<td>$format->largeur x $format->hauteur cm</td>";
                if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
                    echo '<td>';
                    printDeleteFormatForm($format->id);
                    echo '</td>';
                }
            }
            else{
                echo "<td>$format->prix €</td>";
                if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
                    echo '<td>';
                    printChangePrixForm($format->id);
                    echo '</td>';
                }
                echo <<<END
                </tr>
                <tr>
                <td>$format->largeur x $format->hauteur cm</td>
END;
                if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
                    echo '<td>';
                    printDeleteFormatForm($format->id);
                    echo '</td>';
                }
            }
            $largeurPrecedente=$format->largeur;
        }
        echo "<td>$format->prix €</td>";
        if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
            echo '<td>';
            printChangePrixForm($format->id);
            echo '</td>';
        }
        echo "</tr></tr>";
        echo "</thead></table>";
    }
}


function generateFormatCarreList(){
    $n=0;
    $tab=Format::getTousFormatsCarres();
    if($tab==null){
        echo "Prix pour les formats carrés non référencés.";
    }
    else{
        echo '<table>';
        echo "<thead>";
        echo '<tr>';
            echo '<th>Carré</th>';
            echo '<th>Prix</th>';
        echo '</tr>';
        echo "</thead>";
        echo "<tbody><tr>";
        foreach($tab as $format){
        echo <<<END
                <td>$format->largeur x $format->hauteur cm</td>
                <td>$format->prix €</td>
END;
            if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
                echo '<td>';
                printDeleteFormatForm($format->id);
                echo '</td>';
                echo '<td>';
                printChangePrixForm($n,$format->id);
                $n=$n+1;
                echo '</td>';
            }
            echo '</tr>';
            echo '</td>';
        }
        echo '</tr></tbody></table>';
    }
}


function generateHTMLHeader($title, $_SESSION, $messageRegister, $messageLogin){
    echo <<<CHAINE_DE_FIN
    <!DOCTYPE html>
    <html>
    <head>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/fonctions.js"></script>        
        <script type="text/javascript" src="js/lightbox/js/jquery.lightbox-0.5.js"></script>
        <link href="CSS/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS/style.css" />
        <meta charset="UTF-8"/>
        <meta name="author" content="Thibaut Chary & Jean-Baptiste Sibille"/>
        <meta name="keywords" content="Mots clefs relatifs à cette page"/>
        <meta name="description" content="Descriptif court"/>
        <link rel="icon" type="image/png" href="CSS/favicon.png" />
        <title>$title</title>

    </head>
        
    <body id = "cadre">
    <header id="entete">
        
CHAINE_DE_FIN;
    
        if(!$_SESSION['loggedIn']){
        echo "<a id = 'boutonRegister' href='index.php?page=register'>S'enregistrer</a>";
        printLoginForm();
        echo $messageLogin;
    }
    else{
        echo '<div id="bienvenue">';
        
        printLogoutForm();
        if(Utilisateur::getUtilisateur($_SESSION["login"])->admin==1){
        echo "<a class = 'admin' href='index.php?page=utilisateurs'>DIEU</a>";
        }
        
        echo "<a class = 'admin' href='index.php?page=administration'>Administration</a>";
        
        
        echo "<div id=txtbienvenue>";
        echo 'Bonjour '.$_SESSION['prenom']." ".$_SESSION['nom'];
        echo "</div>";
        echo "</div>";
    }    
    echo <<<CHAINE_DE_FIN
    </header>
CHAINE_DE_FIN;
    PHP_EOL;

}


function generateHTMLFooter(){
    echo <<<HAINE_DE_FIN
   
            <footer id="pied">
              <a href='index.php?page=contact'>Nous contacter</a>
              Copyright Thibaut Chary & Jean-Baptiste Sibille
        </footer>
        </body>
</html>
HAINE_DE_FIN;
}




function createMiniature($dossier,$image,$extensionImage,$referenceImage,$largeur,$hauteur){
    if($extensionImage=='jpg'){
        $imageSource = imagecreatefromjpeg($image);    
        $largeur_source = imagesx($imageSource);
        $hauteur_source = imagesy($imageSource);
        $ratio=$hauteur_source/$largeur_source;

        if($hauteur_source>=$largeur_source && $hauteur_source>$hauteur){//image de type portrait
            $imageDestination = imagecreatetruecolor($hauteur/$ratio, $hauteur); //image miniature vide crée
            $hauteur_destination = imagesy($imageDestination);        
            $largeur_destination = imagesx($imageDestination);
            // On crée la miniature
            imagecopyresampled($imageDestination, $imageSource, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

            // On enregistre la miniature dans le dossier
            imagejpeg($imageDestination, "images/$dossier/$referenceImage.jpg");
        }
        else{//image de type paysage
                $imageDestination = imagecreatetruecolor($largeur, $ratio*$largeur); //image miniature vide crée
                $hauteur_destination = imagesy($imageDestination);        
                $largeur_destination = imagesx($imageDestination);

                // On crée la miniature
                imagecopyresampled($imageDestination, $imageSource, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                // On enregistre la miniature dans le dossier 
                imagejpeg($imageDestination, "images/$dossier/$referenceImage.jpg");
            
            /*else{//image plus petite que la miniature
                $imageDestination = imagecreatetruecolor($largeur, $hauteur); //image miniature vide crée
                $hauteur_destination = imagesy($imageDestination);        
                $largeur_destination = imagesx($imageDestination);
                
                // On crée la miniature
                imagecopyresampled($imageDestination, $imageSource, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                // On enregistre la miniature dans le dossier 
                imagejpeg($imageDestination, "images/$dossier/$referenceImage.jpg");
            }*/
        }
    }
    
    elseif($extensionImage=='jpeg'){
        $imageSource = imagecreatefromjpeg($image);    
        $largeur_source = imagesx($imageSource);
        $hauteur_source = imagesy($imageSource);
        $ratio=$hauteur_source/$largeur_source;

        if($hauteur_source>=$largeur_source && $hauteur_source>$hauteur){//image de type portrait
            $imageDestination = imagecreatetruecolor($hauteur/$ratio, $hauteur); //image miniature vide crée
            $hauteur_destination = imagesy($imageDestination);        
            $largeur_destination = imagesx($imageDestination);
            // On crée la miniature
            imagecopyresampled($imageDestination, $imageSource, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

            // On enregistre la miniature dans le dossier
            imagejpeg($imageDestination, "images/$dossier/$referenceImage.jpeg");
        }
        else{//image de type paysage
                $imageDestination = imagecreatetruecolor($largeur, $ratio*$largeur); //image miniature vide crée
                $hauteur_destination = imagesy($imageDestination);        
                $largeur_destination = imagesx($imageDestination);

                // On crée la miniature
                imagecopyresampled($imageDestination, $imageSource, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                // On enregistre la miniature dans le dossier 
                imagejpeg($imageDestination, "images/$dossier/$referenceImage.jpeg");
            
            /*else{//image plus petite que la miniature
                $imageDestination = imagecreatetruecolor($largeur, $hauteur); //image miniature vide crée
                $hauteur_destination = imagesy($imageDestination);        
                $largeur_destination = imagesx($imageDestination);
                
                // On crée la miniature
                imagecopyresampled($imageDestination, $imageSource, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                // On enregistre la miniature dans le dossier 
                imagejpeg($imageDestination, "images/$dossier/$referenceImage.jpg");
            }*/
        }
        
        }
    
    
    elseif($extensionImage=='png'){
        //ça rajoute un fond noir à l'image...

        $imageSource = imagecreatefrompng($image);    
        $largeur_source = imagesx($imageSource);
        $hauteur_source = imagesy($imageSource);
        $ratio=$hauteur_source/$largeur_source;

        if($hauteur_source>=$largeur_source && $hauteur_source>$hauteur){//image de type portrait
            $imageDestination = imagecreatetruecolor($hauteur/$ratio, $hauteur); //image miniature vide crée
            imagecolortransparent($imageDestination); //transparence png les gif auront un fond blanc
            imagesavealpha($imageDestination, true); //imagesavealpha() définit l'option pour essayer de sauvegarder toutes les informations du canal alpha (en opposition à la transparence à couleur unique) lors de la sauvegarde d'images PNG
            $trans_color = imagecolorallocatealpha($imageDestination, 255, 255, 255, 127); //Cette fonction requiert la bibliothèque GD 2.0.1 ou supérieure (2.0.28 ou supérieure est recommandée). Une valeur entre 0 et 127. 0 indique une opacité complète tandis que 127 indique une transparence complète en ajoutant un fond blanc (255,255,255)
            imagefill($imageDestination, 0, 0, $trans_color); //Effectue un remplissage avec la couleur color, dans l'image image, à partir du point de coordonnées (x, y) (le coin supérieur gauche est l'origine (0,0))
            $hauteur_destination = imagesy($imageDestination);        
            $largeur_destination = imagesx($imageDestination);

            // On crée la miniature
            imagecopyresampled($imageDestination, $imageSource, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

            // On enregistre la miniature dans le dossier 
            imagepng($imageDestination, "images/$dossier/$referenceImage.png");
        }
        else{
            if($hauteur_source<$largeur_source && $largeur_source>$largeur){//image de type paysage
                $imageDestination = imagecreatetruecolor($largeur, $ratio*$largeur); //image miniature vide crée
                imagecolortransparent($imageDestination); //transparence png les gif auront un fond blanc
                imagesavealpha($imageDestination, true); //imagesavealpha() définit l'option pour essayer de sauvegarder toutes les informations du canal alpha (en opposition à la transparence à couleur unique) lors de la sauvegarde d'images PNG
                $trans_color = imagecolorallocatealpha($imageDestination, 255, 255, 255, 127); //Cette fonction requiert la bibliothèque GD 2.0.1 ou supérieure (2.0.28 ou supérieure est recommandée). Une valeur entre 0 et 127. 0 indique une opacité complète tandis que 127 indique une transparence complète en ajoutant un fond blanc (255,255,255)
                imagefill($imageDestination, 0, 0, $trans_color); //Effectue un remplissage avec la couleur color, dans l'image image, à partir du point de coordonnées (x, y) (le coin supérieur gauche est l'origine (0,0))
                $hauteur_destination = imagesy($imageDestination);        
                $largeur_destination = imagesx($imageDestination);

                // On crée la miniature
                imagecopyresampled($imageDestination, $imageSource, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                // On enregistre la miniature dans le dossier
                imagepng($imageDestination, "images/$dossier/$referenceImage.png");
            }
            else{//image plus petite que la miniature
                $imageDestination = imagecreatetruecolor($largeur, $hauteur); //image miniature vide crée
                $hauteur_destination = imagesy($imageDestination);        
                $largeur_destination = imagesx($imageDestination);
                
                // On crée la miniature
                imagecopyresampled($imageDestination, $imageSource, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                // On enregistre la miniature dans le dossier 
                imagepng($imageDestination, "images/$dossier/$referenceImage.png");
            }
        }   
    }
    elseif($extensionImage=='gif'){
        //ça rajoute un fond noir à l'image...
        $imageSource = imagecreatefromgif($image);    
        $largeur_source = imagesx($imageSource);
        $hauteur_source = imagesy($imageSource);
        $ratio=$hauteur_source/$largeur_source;

        if($hauteur_source>=$largeur_source && $hauteur_source>$hauteur){//image de type portrait
            $imageDestination = imagecreatetruecolor($hauteur/$ratio, $hauteur); //image miniature vide crée
            imagecolortransparent($imageDestination); //transparence png les gif auront un fond blanc
            imagealphablending($imageDestination, true); // si false le gif a un fond noir, n'affecte pas les png            
            $trans_color = imagecolorallocatealpha($imageDestination, 255, 255, 255, 127); //Cette fonction requiert la bibliothèque GD 2.0.1 ou supérieure (2.0.28 ou supérieure est recommandée). Une valeur entre 0 et 127. 0 indique une opacité complète tandis que 127 indique une transparence complète en ajoutant un fond blanc (255,255,255)
            imagefill($imageDestination, 0, 0, $trans_color); //Effectue un remplissage avec la couleur color, dans l'image image, à partir du point de coordonnées (x, y) (le coin supérieur gauche est l'origine (0,0))
            $hauteur_destination = imagesy($imageDestination);        
            $largeur_destination = imagesx($imageDestination);

            // On crée la miniature
            imagecopyresampled($imageDestination, $imageSource, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

            // On enregistre la miniature dans le dossier 
            imagegif($imageDestination, "images/$dossier/$referenceImage.gif");
        }
        else{
            if($hauteur_source<$largeur_source && $largeur_source>$largeur){//image de type paysage
                $imageDestination = imagecreatetruecolor($largeur, $ratio*$largeur); //image miniature vide crée
                imagecolortransparent($imageDestination); //transparence png les gif auront un fond blanc
                imagealphablending($imageDestination, true); // si false le gif a un fond noir, n'affecte pas les png            
                $trans_color = imagecolorallocatealpha($imageDestination, 255, 255, 255, 127); //Cette fonction requiert la bibliothèque GD 2.0.1 ou supérieure (2.0.28 ou supérieure est recommandée). Une valeur entre 0 et 127. 0 indique une opacité complète tandis que 127 indique une transparence complète en ajoutant un fond blanc (255,255,255)
                imagefill($imageDestination, 0, 0, $trans_color); //Effectue un remplissage avec la couleur color, dans l'image image, à partir du point de coordonnées (x, y) (le coin supérieur gauche est l'origine (0,0))
                $hauteur_destination = imagesy($imageDestination);        
                $largeur_destination = imagesx($imageDestination);

                // On crée la miniature
                imagecopyresampled($imageDestination, $imageSource, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                // On enregistre la miniature dans le dossier
                imagegif($imageDestination, "images/$dossier/$referenceImage.gif");
            }
            else{//image plus petite que la miniature
                $imageDestination = imagecreatetruecolor($largeur, $hauteur); //image miniature vide crée
                $hauteur_destination = imagesy($imageDestination);        
                $largeur_destination = imagesx($imageDestination);
                
                // On crée la miniature
                imagecopyresampled($imageDestination, $imageSource, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                // On enregistre la miniature dans le dossier 
                imagegif($imageDestination, "images/$dossier/$referenceImage.gif");
            }
        }
    }
}

function userIsValid($login){
    $user=Utilisateur::getUtilisateur($login);
    if($user->etat=='0'){
        return false;
    }
    else return true;
}

?>