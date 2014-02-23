<?php


function printRegisterForm() {
    if (isset($_POST['prenom']))
        $prenom = $_POST['prenom'];
    if (isset($_POST['nom']))
        $nom = $_POST['nom'];
    if (isset($_POST['email']))
        $email = $_POST['email'];
    if (isset($_POST['naissance']))
        $naissance = $_POST['naissance'];
    
    echo <<<CHAINE_DE_FIN
        <div id ="register">
        <h1>S'enregistrer</h1>    
        
        <form action="index.php?todo=register&page=accueil" method="post" 
            oninput="up2.setCustomValidity(up2.value != up.value ? 'Les mots de passe different.' : '')">
            <fieldset>
            <input type="text" name="prenom" value="$prenom" placeholder="Prénom" required> 
            <input type="text" name="nom" value="$nom" placeholder="Nom" required> 
            <input type="email" name="email" value="$email" placeholder="E-mail" required>
            <input type="date" name="naissance" value="$naissance" placeholder="Date de naissance" required> 
            <input id="login" type=text placeholder="Login" required name=login>
            <input id="password1" type=password placeholder="Mot de passe" required name=up >
            <input id="password2" type=password placeholder="Confirmer mot de passe" name=up2>            
            <input type=submit value="Créer un compte">
           </fieldset>
        </form>
        </div>
CHAINE_DE_FIN;
}

?>