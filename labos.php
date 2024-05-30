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
                    document.getElementById('modifier').style.display = 'none' ;">Ajouter un laboratoire</option>
                    <option value = "modifier" id = 'choix' onclick ="document.getElementById('ajout').style.display = 'none' ;
                    document.getElementById('modifier').style.display = 'block' ;">Modifier un laboratoire (en construction)</option>
                    </optgroup>
               </select>
        </div>
        <div id ="ajout" style="display: none">
            <h4> Veuillez renseigner les informations</h4>
            <form method="POST" action="new_labo.php">
                <input type="text" name="choix" value = "ajout" hidden>
                <table>
                <tr> 
                    <td>Nom</td> 
                    <td><input type="text" name="nom" required></td>
                </tr> 
                <tr> 
                    <td>Adresse</td>
                    <td><input type="text" name="adresse" required></td>
                </tr>
                <tr> 
                    <td>Salle</td>
                    <td><input type="text" name="salle" required></td>
                </tr>
                <tr> 
                    <td>Telephone</td> 
                    <td><input type="number" name="telephone" required></td>
                </tr>
                <tr>
                    <td>Mail</td> 
                    <td><input type="text" name="mail" required></td>
                </tr>
                <tr> 
                    <!--Optgroup permet de choisir un item parmi ceux proposés, le même ID est utilisé ensuite dans le traitement des données-->
                    <td>Quels services attribuer (maximum 3) ?</td> 
                    <td>
                        <input type = "checkbox" name = "service[]" id = "service" value = "covid">
                        <label for="covid">COVID</label><br>
                        <input type = "checkbox" name = "service[]" id = "service" value = "biologie_prev">
                        <label for="biologie_prev">Biologie préventive</label><br>
                        <input type = "checkbox" name = "service[]" id = "service" value = "biologie_femme">
                        <label for="biologie_femme">Biologie de la femme enceinte</label><br>
                        <input type = "checkbox" name = "service[]" id = "service" value = "biologie_route">
                        <label for="biologie_route">Biologie de routine</label><br>
                        <input type = "checkbox" name = "service[]" id = "service" value = "cencerologie">
                        <label for="cencerologie">Cancérologie</label><br>
                        <input type = "checkbox" name = "service[]" id = "service" value = "gynecologie">
                        <label for="gynecologie">Gynécologie</label><br>
                    </td>
                </tr>
            </table>
                <!--onclick permet d'afficher un message avant de confirmer une action-->
                <p>
                    <input type="submit" value="Enregistrer et ajouter" class="inscrit" onclick="return window.confirm('Voulez-vous continuer ?')">
                    <input type="reset" value="Réinitialiser" class="zero" onclick="return window.confirm('Êtes-vous sûr ?')">
                </p>
            
            </form> 
        </div>
        <!--<div id = "modification" style="display: none">
            <form method="POST" action="new_labo.php">
            <input type="text" name="choix" value = "modifier" hidden>
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
                <input type="submit" value="Enregistrer et modifier" class="inscrit" onclick="return window.confirm('Voulez-vous continuer ?')">
            </form>
        </div>-->
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
