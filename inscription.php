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
<?php sleep(1);//Temps de pause pour l'action (petit plus réaliste)?>
<h4> Veuillez renseigner les informations</h4>
    <form method="POST" action="traitement_inscription.php" name="form1">
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
            <td>Mail</td> 
            <td><input type="text" name="mail" required></td>
        </tr>
        <tr> 
            <td>Mot de passe</td> 
            <td><input type="password" name="mdp" required></td>
        </tr>
        <tr> 
            <!--Optgroup permet de choisir un item parmi ceux proposés, le même ID est utilisé ensuite dans le traitement des données-->
            <td>Compte</td> 
            <td><select name="compte" id="compte">
                <optgroup label="compte">
                    <option value="client" id='compte' onclick ="document.getElementById('clientplus').style.display = 'block' ;">Client</option>
                    <option value="admin" id='compte' onclick ="document.getElementById('clientplus').style.display = 'none' ;">Administrateur</option>
                </optgroup>
            </select></td>
        </tr>
        </table>
        <!--But recherché : afficher les deux derniers champs uniquement dans le cas d'un compte client (utilisation de style display juste au dessus pour le choix du compte)-->
        <div id = "clientplus">
            <table>
                <tr>
                    <td>Adresse</td> 
                    <td><input type="text" name="adresse"></td>
                </tr>
                <tr>
                    <td>Carte vitale</td> 
                    <td><input type="number" name="vitale"></td>
                </tr>
                <tr> 
                    <!--Optgroup permet de choisir un item parmi ceux proposés, le même ID est utilisé ensuite dans le traitement des données-->
                    <td>Moyen de paiement</td> 
                    <td><select name="paiement" id="paiement">
                        <optgroup label="paiement">
                            <option value="visa" id='paiement'>Visa</option>
                            <option value="masterCard" id='paiement'>MasterCard</option>
                            <option value="american" id='paiement'>American Express</option>
                            <option value="paypal" id='paiement'>PayPal</option>
                        </optgroup>
                    </select></td>
                </tr>
            </table>
        </div>
        <!--onclick permet d'afficher un message avant de confirmer une action-->
        <p>
            <input type="submit" value="S'inscrire" class="inscrit" onclick="return window.confirm('Voulez-vous continuer ?')">
            <input type="reset" value="Réinitialiser" class="zero" onclick="return window.confirm('Êtes-vous sûr ?')">
        </p>
    
    </form> 
    <form method="post" action="index.php">
		<input type="submit" value="Retour à l'accueil" class="menu">
	</form>
</body>
</html>
