<?php

function printLoginForm() {
    if(isset($_GET["page"]))
    $pageActuelle=$_GET["page"];
    else $pageActuelle=accueil;
    echo <<<CHAINE_DE_FIN
    <div class = "formulaireGlob">
    <div class = "clique"></div>
    <div class ="afficherMasquer">
    Connexion
    <div class="hidden">
    <form action="index.php?todo=login&page=$pageActuelle" method="post">
        <fieldset>
        <input type="text" name="login" placeholder="Login" required></input>
        <input type="password" name="password" placeholder="Mot de passe" required></input>
        <input type="submit" value="Valider" />
        </fieldset>
    </form>    
    </div>
    </div>
    </div>
CHAINE_DE_FIN;
}


function printLogoutForm() {
    echo <<<CHAINE_DE_FIN
    <form id = "boutonlogout" action="index.php?todo=logout" method="post">
        <fieldset>
        <input id = "logout" type="submit" value="Déconnexion" />
        </fieldset>
    </form>
CHAINE_DE_FIN;
}


function printUploadOeuvreForm($messageUploadOeuvre){
    if($messageUpload!="Upload réussi"){
        if (isset($_POST['titre']))
            $titre = $_POST['titre'];
        if (isset($_POST['artiste']))
            $artiste = $_POST['artiste'];
        if (isset($_POST['date']))
            $date = $_POST['date'];
        if (isset($_POST['commentaire']))
            $commentaire = $_POST['commentaire'];
        if (isset($_POST['theme']))
            $theme = $_POST['theme'];
    }
    echo <<<CHAINE_DE_FIN
    <div class ="upload afficherMasquer">
    <div class ="clique">Insérer une oeuvre</div>
    <div class="hidden">
    <form action="index.php?todo=uploadoeuvre&page=oeuvres"  method="post" enctype="multipart/form-data">
        <fieldset class="affiche">
            <label for="pic">Photo de l'œuvre :</label></br>
            <input type="file" id = "pic" name="photo" required /></br>
    
            <input type="text" name="titre" placeholder="Titre" value='$titre' required/> </br>
            <input type="text" name="artiste" placeholder="Artiste" value='$artiste' required/></br>
            <input type="number" name="date" placeholder="Année de création" value='$date' /></br>
            <input type="text" name="commentaire" placeholder="Commentaires" value='$commentaire' /></br>
            <input type="text" name="theme" placeholder="Thème" value='$theme' required/></br>
            <input type="submit" value="Envoyer" />
        </fieldset>
    </form>
    </div>
    </div>
CHAINE_DE_FIN;
}


function printEventForm($messageUploadEvent){
    if($messageUploadEvent!="Upload réussi"){
        if (isset($_POST['titre']))
            $titre = $_POST['titre'];
        if (isset($_POST['sousTitre']))
            $sousTitre = $_POST['sousTitre'];
        if (isset($_POST['descriptif']))
            $descriptif = $_POST['descriptif'];
        if($_POST["permanent"]==0){
            if (isset($_POST['dateDebut']))
                $dateDebut = $_POST['dateDebut'];
            if (isset($_POST['dateFin']))
                $dateFin = $_POST['dateFin'];
        }
    }
    echo <<<CHAINE_DE_FIN
    <div class ="upload afficherMasquer">
    <div class ="clique">Créer un événement</div>
    <div class="hidden">
    <form action="index.php?todo=createevent&page=expos"  method="post" enctype="multipart/form-data">
        <fieldset class= "affiche">
        <label for="pic">Photo de l'événement :</label></br>
        <input type="file" id="pic" name="photo" /></br>
        <input type="text" name="titre" placeholder="Titre de l'événement" value='$titre' required/><br/> 
        <input type="text" name="sousTitre" placeholder="Sous-titre" value='$sousTitre' /><br/> 
        <textarea id="descriptif" rows="20" cols="70" required name="descriptif" placeholder="Présentez votre événement ici" maxlength="10000">$descriptif</textarea></br>
        <div class="checkbox">
        Exposition permanente ?</br>
 
            <div class= "check"><label for ="isPerm">Oui </label><input type="radio" id="isPerm" name="permanent" value="1" /></div>
            <div class= "check"><label for ="isNotPerm">Non </label><input type="radio"id="isNotPerm" name="permanent" value="0" /></div>
        </div></br>
    
    
        <div class="date">
            <label for= "debut">Date de début : </label></br>
            <input class="datepicker" id = "debut" type="date" name="dateDebut" placeholder="Date de début (aaaa/mm/jj)" value='$dateDebut' /><br/> 
            <label for= "fin">Date de fin : </label></br>
            <input class="datepicker" id = "fin" type="date" name="dateFin" placeholder="Date de fin (aaaa/mm/jj)" value='$dateFin' /><br/> 
        </div>
            <input type="submit" value="Envoyer" />
        </div>
        </fieldset>
    </form>
    </div>
    </div>
CHAINE_DE_FIN;
}



function printArtistForm($messageUploadArtiste){
    if($messageUploadArtiste!="Upload réussi"){
        if (isset($_POST['surnom']))
            $surnom = $_POST['surnom'];
        if (isset($_POST['fonction']))
            $fonction = $_POST['fonction'];
        if (isset($_POST['texte']))
            $texte = $_POST['texte'];
    }
    echo <<<CHAINE_DE_FIN
    <div class ="upload afficherMasquer">
    <div class ="clique">Insérer un artiste</div>
    <div class="hidden">
    <form action="index.php?todo=registerartist&page=artistes"  method="post" enctype="multipart/form-data">
        <fieldset class="affiche">
            <label for="pic">Photo de l'artiste :</label>
            <input type="file" id="pic" name="photo" /></br>

            <input type="text" name="surnom" placeholder="Surnom" value='$surnom' required/></br>
            <input type="text" name="fonction" placeholder="Fonction" value='$fonction' /></br>
            <textarea id="texte" rows="20" cols="70" required name="texte" placeholder="Présentation de l'artiste" maxlength="10000">$texte</textarea></br>

            <input type="submit" value="Envoyer" />

        </fieldset>
    </form>
    </div>
    </div>
CHAINE_DE_FIN;
}


function printProfesseurForm($messageUploadProfesseur){
    if($messageUploadProfesseur!="Upload réussi"){
        if (isset($_POST['surnom']))
            $surnom = $_POST['surnom'];
        if (isset($_POST['fonction']))
            $fonction = $_POST['fonction'];
        if (isset($_POST['texte']))
            $texte = $_POST['texte'];
    }
    echo <<<CHAINE_DE_FIN
    <div class ="upload afficherMasquer">
    <div class ="clique">Insérer un professeur</div>
    <div class="hidden">
    <form action="index.php?todo=registerprofesseur&page=professeurs"  method="post" enctype="multipart/form-data">
        <fieldset class="affiche">        
        <label for="pic">Photo du professeur (jpg ou jpeg) :</label>
        <input type="file" id="pic" name="photo" /></br>
    
   
        <input type="text" name="surnom" placeholder="Surnom" value='$surnom' required/><br/> 

        <input type="text" name="fonction" placeholder="Fonction" value='$fonction' /><br/> 

        <textarea id="texte" rows="20" cols="70" required name="texte" placeholder="Présentation du professeur" maxlength="10000">$texte</textarea>

        <input type="submit" value="Envoyer" />

        </fieldset>
    </form>
    </div>
    </div>
CHAINE_DE_FIN;
}


function printAtelierForm($messageUploadAtelier){
    if($messageUploadAtelier!="Upload réussi"){
        if (isset($_POST['titre']))
            $titre = $_POST['titre'];
        if (isset($_POST['sousTitre']))
            $sousTitre = $_POST['sousTitre'];
        if (isset($_POST['texte']))
            $texte = $_POST['texte'];
    }
    echo <<<CHAINE_DE_FIN
    <div class ="upload afficherMasquer">
    <div class ="clique">Créer un atelier</div>
    <div class="hidden">
    <form action="index.php?todo=createatelier&page=ateliers"  method="post" enctype="multipart/form-data">
        <fieldset class="affiche">
        <label for="pic">Photo de l'atelier (jpg ou jpeg) :</label>
        <input type="file" id="pic" name="photo" /></br>
    
        <input type="text" name="titre" placeholder="Titre" value='$titre' required/><br/> 

        <input type="text" name="sousTitre" placeholder="Sous-titre" value='$sousTitre' /><br/> 

        <textarea id="texte" rows="20" cols="70" required name="texte" required placeholder="Descriptif de l'atelier" maxlength="10000">$texte</textarea>

        <input type="submit" value="Envoyer" />

        </fieldset>
    </form>
    </div>
    </div>
CHAINE_DE_FIN;
}


function printFormatForm($messageInsertFormat) {
    if($messageInsertFormat!="Insertion réussie"){
        if (isset($_POST['largeur']))
            $largeur = $_POST['largeur'];
        if (isset($_POST['hauteur']))
            $hauteur = $_POST['hauteur'];
        if (isset($_POST['prix']))
            $prix = $_POST['prix'];
    }
    
    echo <<<CHAINE_DE_FIN
    <div class ="upload afficherMasquer">
    <div class ="clique">Insérer un format</div>
    <div class="hidden">
        <form action="index.php?todo=registerformat&page=formats" method="post" >
            <fieldset class="affiche">
            Format ?
            <div class="checkbox">
            
                <div class= "check"><label for= "stand">Standart</label>Standard: <input type="radio" name="format" value="standard"></div>
                <div class= "check"><label for= "carre">Carré</label> <input id ="carre" type="radio" name="format" value="carre" /></div>
            </div>
            Type ?
            <div class="checkbox">
                <label for= "figure">Figure : </label> <input id="figure" type="radio" name="type" value="figure"><br/>
                <label for= "paysage">Paysage : </label><input id="paysage" type="radio" name="type" value="paysage" /><br/>
                <label for= "marine">Marine : </label><input id = "marine" type="radio" name="type" value="marine" /><br/>
            </div>
            <input name="largeur" type="number" value='$largeur' placeholder="Largeur" required>
            <input name="hauteur" type="number" value='$hauteur' placeholder="Hauteur" required>
            <input name="prix" type="number" value='$prix' placeholder="Prix" required>
            <input type=submit value="Insérer le format">
            </fieldset>
        </form>
        </div>
        </div>
CHAINE_DE_FIN;
}


function printChangePasswordForm() {
    echo <<<CHAINE_DE_FIN
        <h3>Changer mon mot de passe</h3>

        
<form action="index.php?todo=changepassword&page=administration" method=post
            oninput="up2.setCustomValidity(up2.value != up.value ? 'Les nouveaux mots de passe different.' : '')">
            <fieldset>
                <label for="password1"></label>
                <input id="password1" type=password placeholder="Ancien mot de passe" required name="password" >

                <label for="password2"></label>
                <input id="password2" type=password placeholder="Nouveau mot de passe" required name="up" >

                <label for="password3"></label>
                <input id="password3" type=password placeholder="Confirmer nouveau mot de passe" name="up2">

                <input type=submit value="Changer mon mot de passe">
            </fieldset>
        </form>
CHAINE_DE_FIN;
}


function printChangePrixForm($id) {
    $format=Format::getFormat($id);
    $prix=$format->prix;
    echo <<<CHAINE_DE_FIN
    <div class ="upload afficherMasquer">
    <div class ="clique">Modifier prix</div>
    <div class="hidden">
                <form action="index.php?todo=changeprix&page=formats" method=post >
                    <fieldset>
                    <input name="prix" type="number" value='$prix' required></br>
                    <input name="id" type=hidden value='$id' ></br>
                    <input type=submit value="Modifier le prix">
                    </fieldset>
                </form>
            </div>
        </div>
CHAINE_DE_FIN;
}


function printUpdateArtisteForm($num,$surnom){
    $artiste=Artiste::getArtiste($surnom);
    echo <<<CHAINE_DE_FIN
    <div class ="upload afficherMasquer">
    <div class ="clique">Modifier artiste</div>
    <div class="hidden">
        <form action="index.php?todo=updateartiste&page=artistes" method=post enctype="multipart/form-data">
            <fieldset class="affiche">    
CHAINE_DE_FIN;
    
            echo '<label for="photo'.$num.'">Photo de l\'artiste :</label></br><input type="file" id="photo'.$num.'"  name="photo" required/>';
echo <<<CHAINE_DE_FIN
            <inputtype=text value='$artiste->fonction' name="fonction" ></br>
            <textarea rows="20" cols="70" required name="texte" maxlength="10000">$artiste->texte</textarea>

            <input name="surnom" type=hidden value='$surnom' ></br>

            <input type=submit value="Modifier artiste">
            </fieldset>
        </form>
    </div>
    </div>
CHAINE_DE_FIN;
}

function printUpdateProfesseurForm($num,$surnom){
    $professeur=Professeur::getProfesseur($surnom);
    echo <<<CHAINE_DE_FIN
    <div class ="upload afficherMasquer">
    <div class ="clique">Modifier professeur</div>
    <div class="hidden">
        <form action="index.php?todo=updateprofesseur&page=professeurs" method=post enctype="multipart/form-data">
            <fieldset>
CHAINE_DE_FIN;
    
            echo '<label for="photo'.$num.'">Photo du professeur :</label></br><input type="file" id="photo'.$num.'"  name="photo" required/></br>';
echo <<<CHAINE_DE_FIN
            </br>
            <input  type=text value='$professeur->fonction' name="fonction" >
            </br>
            <textarea  rows="20" cols="70" required name="texte" maxlength="10000">$professeur->texte</textarea>
            </br>    
            <input name="surnom" type=hidden value='$surnom' >
            </br>
            <input type=submit value="Modifier professeur">
            </fieldset>
        </form>
    </div>
    </div>
CHAINE_DE_FIN;
}

function printUpdateEventForm($num,$id){
    $event=Evenement::getEvenement($id);
    echo <<<CHAINE_DE_FIN
    <div class ="upload afficherMasquer">
    <div class ="clique">Modifier cet événement</div>
    <div class="hidden">
    <form action="index.php?todo=updateevent&page=expos"  method="post" enctype="multipart/form-data">
        <fieldset>
CHAINE_DE_FIN;
    
            echo '<label for="photo'.$num.'">Photo de l\'événement :</label></br><input type="file" id="photo'.$num.'"  name="photo" required/></br>';
echo <<<CHAINE_DE_FIN
        <input type="text" name="titre" placeholder="Titre de l'événement" value="$event->titre" required/><br/> 
        <input type="text" name="sousTitre" placeholder="Sous-titre" value="$event->sousTitre" /><br/> 
        <textarea id="descriptif" rows="20" cols="70" required name="descriptif" placeholder="Présentez votre événement ici" maxlength="10000">$event->descriptif</textarea></br>
        <div class="checkbox">
        Exposition permanente?</br>
 
            <div class= "check"><label for ="permanent">Oui </label><input type="radio" name="permanent" value="1" /></div>
            <div class= "check"><label for ="permanent">Non </label><input type="radio" name="permanent" value="0" /></div>
        </div></br>
        <div class="dateDebut">
            <input class="datepicker" type="date" name="dateDebut" placeholder="Date de début (aaaa/mm/jj)" value="$event->dateDebut" /><br/> 
        </div>
        <div class="dateFin">
            <input class="datepicker" type="date" name="dateFin" placeholder="Date de fin (aaaa/mm/jj)" value="$event->dateFin" /><br/> 
        </div>
        <input name="id" type=hidden value='$id' >

        <div id="validation">
            <input type="submit" value="Envoyer" />
        </div>
        </fieldset>
    </form>
    </div>
    </div>
CHAINE_DE_FIN;
}

function printUpdateAtelierForm($num,$id){
    $atelier=Atelier::getAtelier($id);
    echo <<<CHAINE_DE_FIN
    <div class ="upload afficherMasquer">
    <div class ="clique">Modifier atelier</div>
    <div class="hidden">
        <form action="index.php?todo=updateatelier&page=ateliers" method=post enctype="multipart/form-data">
            <fieldset>
CHAINE_DE_FIN;
    
            echo '<label for="photo'.$num.'">Photo de l\'atelier (jpg ou jpeg) :</label></br><input type="file" id="photo'.$num.'"  name="photo" required/></br>';
echo <<<CHAINE_DE_FIN
    
            <input  type=text value='$atelier->titre' name="titre" >
            
            <input  type=text value='$atelier->sousTitre' name="sousTitre" >
            
            <textarea id="texte" rows="20" cols="70" required name="texte" maxlength="10000">$atelier->texte</textarea>
                
            <input name="id" type=hidden value='$id' >
                
            <input type=submit value="Modifier atelier">
            </fieldset>
        </form>
        </div>
        </div>
CHAINE_DE_FIN;
}


function printDeleteUserForm() {
    echo <<<CHAINE_DE_FIN
        <h3>Supprimer mon compte</h3>
        <form action="index.php?todo=deleteuser&page=accueil" method=post>
            <fieldset>
            <input id="password" type=password placeholder="Mot de passe" required name="password" >
            <input class = "delete" type=submit value="Supprimer mon compte">
            </fieldset>
        </form>
CHAINE_DE_FIN;
}


function printDeleteOeuvreForm($reference) {
    echo <<<CHAINE_DE_FIN
        <form class= "boutonDelete" action="index.php?todo=deleteoeuvre&page=oeuvres" method=post>
            <fieldset>
            <input name="reference" type=hidden value=$reference >
            <input class = "delete" type=submit value="Supprimer cette oeuvre">
            </fieldset>
        </form>
CHAINE_DE_FIN;
}

function printDeleteArtisteForm($surnom) {
    echo <<<CHAINE_DE_FIN
        <form action="index.php?todo=deleteartiste&page=artistes" method=post>
            <fieldset>
            <input name="surnom" type=hidden value='$surnom' >
            <input class = "delete" type=submit value="Supprimer cet artiste">
            </fieldset>
        </form>
CHAINE_DE_FIN;
}

function printDeleteProfesseurForm($surnom) {
    echo <<<CHAINE_DE_FIN
        <form action="index.php?todo=deleteprofesseur&page=professeurs" method=post>
            <fieldset>
            <input name="surnom" type=hidden value=$surnom >
            <input class = "delete" type=submit value="Supprimer ce professeur">
            </fieldset>
        </form>
CHAINE_DE_FIN;
}

function printDeleteEventForm($id) {
    echo <<<CHAINE_DE_FIN
        <form action="index.php?todo=deleteevent&page=expos" method=post>
            <fieldset>
            <input name="id" type=hidden value=$id >
            <input class="delete" type=submit value="Supprimer cet événement">
            </fieldset>
        </form>
CHAINE_DE_FIN;
}

function printDeleteAtelierForm($id) {
    echo <<<CHAINE_DE_FIN
        <form action="index.php?todo=deleteatelier&page=ateliers" method=post>
            <fieldset>
            <input name="id" type=hidden value=$id >
            <input class= "delete" type=submit value="Supprimer cet atelier">
            </fieldset>
        </form>
CHAINE_DE_FIN;
}

function printDeleteFormatForm($id) {
    echo <<<CHAINE_DE_FIN
        <form action="index.php?todo=deleteformat&page=formats" method=post>
            <fieldset>
            <input name="id" type=hidden value=$id >
            <input class = "delete" type=submit value="Supprimer">
            </fieldset>
        </form>
CHAINE_DE_FIN;
}


function printRequestingUsersForm(){
    $tabRequestingUsers=Utilisateur::getUtilisateursEnAttente();
    if($tabRequestingUsers==null){
        echo 'Aucune inscprition en attente de validation';
    }
    else{
        echo '<ul>';
        foreach($tabRequestingUsers as $requestingUser){
            echo <<<CHAINE_DE_FIN
            <li>
                <ul>
                    <li>$requestingUser->prenom</li>
                    <li>$requestingUser->nom</li>
                    <li>$requestingUser->email</li>
                    <li>
                        <form action="index.php?todo=acceptusers&page=utilisateurs"  method="post" >
                            <fieldset>
                                <input type="hidden" name ="login" value='$requestingUser->login' />
                                <input type="hidden" name ="email" value='$requestingUser->email' />
                                <input type="submit" name="accepter" value="Accepter" />
                                <input type="submit" name="refuser" value="Refuser" />
                            </fieldset>
                        </form>
                    </li>
                </ul>
            </li>
CHAINE_DE_FIN;
        }
        echo '</ul>';
    }
}
?>