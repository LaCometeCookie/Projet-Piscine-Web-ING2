<!--Paiement d'un service (uniquement pour le client)-->
<!DOCTYPE html> 
<html> 
<head> 
  <meta charset="utf-8">
  <title>Medicare | Paiement</title>
  <link href="piaement.css" rel="stylesheet" type="text/css" />  
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
          
        ?><!-- Boutons communs à toutes les fenêtres (sauf connexion) -->
        <button type="button" class="btn btn-link">
            <a href = "index.php">Accueil</a></button> 
        <button type="button" class="btn btn-link">
            <a href = "parcourir.php">Parcourir</a>
        </button>
        <button type="button" class="btn btn-link">
            <a href = "rdv.php">Rendez-vous</a>
        </button>
        <button type="button" class="btn btn-link">
            <a href = "profil.php"><?php echo htmlspecialchars($donnees['Nom']) ." ". htmlspecialchars($donnees['Prenom']);?></a></button>
        <button type="button" class="btn btn-info"> 
            <a href = "recherche.php"><span class="glyphicon glyphicon-search"></span> Recherche </a>
        </button> <?php
    }
    else
    {
        ?>
    <!-- Boutons communs à toutes les fenêtres (sauf connexion) -->
    <button type="button" class="btn btn-link">
        <a href = "index.php">Accueil</a></button> 
    <button type="button" class="btn btn-link">
        <a href = "parcourir.php">Parcourir</a>
    </button>
    <button type="button" class="btn btn-link">
        <a href = "rdv.php">Rendez-vous</a>
    </button>
    <button type="button" class="btn btn-link">
        <a href = "connexion.php">Compte</a></button>
    <button type="button" class="btn btn-info"> 
        <a href = "recherche.php"><span class="glyphicon glyphicon-search"></span> Recherche </a>
        <input type="text" name="compte" id="compte" value="<?php echo $compte;?>" hidden>
    </button> 
    <?php
    }
    mysqli_close($db_handle); 
    ?> 
    <!--required permet de bloquer l'envoi si des champs ne sont pas remplis-->
    <form action="recu.php" method="post">
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
            <td>Pays</td> 
            <td><input type="text" name="pays" required></td>
        </tr>
        <tr> 
            <td>Mail</td> 
            <td><input type="text" name="mail" required></td>
        </tr>
        <tr> 
            <td>Telephone</td> 
            <td> <input type="number" name="telephone" required></td>
        </tr>
        <tr> 
            <td>Carte Vitale</td> 
            <td><input type="number" name="vitale" required title="Saisissez les 15 chiffres de votre carte vitale"></td>
        </tr>
        <tr> 
            <!--Optgroup permet de choisir un item parmi ceux proposés, le même ID est utilisé ensuite dans le traitement des données-->
            <td>Moyen de paiement</td> 
            <td><select name="carte" id="carte">
                <optgroup label="Carte">
                    <option value="visa" id='carte'>Visa</option>
                    <option value="masterCard" id='carte'>MasterCard</option>
                    <option value="american" id='carte'>American Express</option>
                    <option value="paypal" id='carte'>PayPal</option>
                </optgroup>
            </select></td>
        </tr>
        <tr> 
            <td>Numéro de la carte</td> 
            <td><input type="number" name="numcarte" required></td>
        </tr>
        <tr> 
            <td>Date d'expiration</td> 
            <td><input type="text" name="datecarte" required title="en mm/aa"></td>
        </tr>
        <tr> 
            <td>CVV</td> 
            <td><input type="number" name="cvv" required title="Saisissez les chiffres de sécurité inscrit au dos de votre carte (3 ou 4)"></td>
        </tr>
        <tr><td><input type = "submit" name="Valider les informations" onclick="return window.confirm('Voulez-vous continuer ?')"></td>
            <td><input type="reset" value="Réinitialiser" class="zero" onclick="return window.confirm('Êtes-vous sûr ?')"></td>
        </tr>
    </table>
    </form>
</body> 
</html> 