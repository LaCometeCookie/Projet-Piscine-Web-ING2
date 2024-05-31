<!--Ajout/modification du personnel (uniquement pour l'admin)-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Medicare | Inscription</title>
	<link rel="stylesheet" href="inscription.css" />
     <!-- Dernier CSS compilé et minifié --> 
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
  
 <!-- Bibliothèque jQuery --> 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
 
 <!-- Dernier JavaScript compilé --> 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
</head>
<body>
<?php
     session_start();
     sleep(1);//Temps de pause pour l'action (petit plus réaliste)
	//identifier le nom de base de données 
	$database = "pj web 2024"; 
	//connectez-vous dans votre BDD 
	//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien) 
	$db_handle = mysqli_connect('localhost', 'root', '' ); 
	$db_found = mysqli_select_db($db_handle, $database);
     if (isset($_SESSION['ID_session']) && isset($_SESSION['ID'])) 
     {
          // L'utilisateur est connecté
          $donnees['ID'] = $_SESSION['ID'];
          $donnees['Nom'] = $_SESSION['Nom'];
          $donnees['Prenom'] = $_SESSION['Prenom'];
          $donnees['compte'] = $_SESSION['compte'];
          $ok = TRUE;
     } 
     else 
     {
          // L'utilisateur n'est pas connecté
          $ok = FALSE;
     }
     if($ok)
     {
        ?>
        <div class="parcours">
               <select name="choix" id="choix">
                    <optgroup label="choix">
                    <option value="ajout" id='choix' onclick ="document.getElementById('ajout').style.display = 'block' ;
                    document.getElementById('supprime').style.display = 'none' ;">Ajouter un personnel</option>
                    <option value = "supprime" id = 'choix' onclick ="document.getElementById('ajout').style.display = 'none' ;
                    document.getElementById('supprime').style.display = 'block' ;">Retirer un membre</option>
                    </optgroup>
               </select>
        </div>
        <div id ="ajout" style="display: none">
            <h4> Veuillez renseigner les informations</h4>
            <form method="POST" action="personnel.php">
                <input type="text" name="choix" value = "ajouter" hidden>
                <table>
                <tr> 
                    <td>Nom</td> 
                    <td><input type="text" name="nom" required></td>
                </tr> 
                <tr> 
                    <td>Prenom</td>
                    <td><input type="text" name="prenom" required></td>
                </tr>
                <tr> 
                    <!--Optgroup permet de choisir un item parmi ceux proposés, le même ID est utilisé ensuite dans le traitement des données-->
                    <td>Spécialité</td> 
                    <td><select name="specialite" id="specialite">
                        <optgroup label="specialite">
                            <option value="generaliste" id='specialite'>Généraliste</option>
                            <option value="addictologie" id='specialite'>Addictologie</option>
                            <option value="andrologie" id='specialite'>Andrologie</option>
                            <option value="cardiologue" id='specialite'>Cardiologue</option>
                            <option value="dermatologue" id='specialite'>Dermatologue</option>
                            <option value="gastroenterologue" id='specialite'>Gastroenterologue</option>
                            <option value="gynecologue" id='specialite'>Gynécologue</option>
                            <option value="ist" id='specialite'>IST</option>
                            <option value="osteopathie" id='specialite'>Osteopathie</option>
                        </optgroup>
                    </select></td>
                </tr>
                <tr>
                    <td>Mail</td> 
                    <td><input type="text" name="mail" required></td>
                </tr>
                <tr> 
                    <td>Mot de passe</td> 
                    <td><input type="password" name="mdp" required></td>
                </tr>
                <tr> 
                    <td>Telephone</td> 
                    <td><input type="number" name="telephone" required></td>
                </tr> 
                <tr> 
                    <td>CV</td>
                    <td><input type="text" name="cv" required></td>
                </tr>
                <tr> 
                    <td>Lien de la photo</td>
                    <td><input type="text" name="photo" required></td>
                </tr>
            </table>
                <!--return window.confirm permet d'afficher un message avant de confirmer une action-->
                <p>
                    <input type="submit" value="Enregistrer et ajouter" class="inscrit" onclick="return window.confirm('Voulez-vous continuer ?')">
                    <input type="reset" value="Réinitialiser" class="zero" onclick="return window.confirm('Êtes-vous sûr ?')">
                </p>
            
            </form> 
        </div>
        <div id = "supprime" style="display: none">
            <form method="POST" action="personnel.php">
            <input type="text" name="choix" value = "supprimer" hidden>
                <table>
                        <tr> 
                            <td>Nom</td> 
                            <td><input type="text" name="nom" required></td>
                        </tr> 
                        <tr> 
                            <td>Prenom</td>
                            <td><input type="text" name="prenom" required></td>
                        </tr>
                </table>
                <input type="submit" value="Enregistrer et supprimer" class="inscrit" onclick="return window.confirm('Voulez-vous continuer ?')">
            </form>
        </div>
    <?php
    }
    else
    {
       echo "Vous n'êtes pas connecté";
       ?><input type="text" name="compte" id="compte" value="<?php echo $compte;?>"><form method = "post" action = "index.php"><input type="submit" name= "accueil" value="accueil"></form><?php
    }
    mysqli_close($db_handle); 
    ?>
    <form method="post" action="profil.php">
    <input type="submit" value="Retour au profil" class="menu">
    </form>
</body>
</html>
