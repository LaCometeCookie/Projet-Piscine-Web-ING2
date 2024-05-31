<!--Connexion à son compte
 Pour éviter de multiplier les conditions de connexion, le choix a été fait d'utiliser le mail et le mot de passe de chaque utilisateur, peu importe leur statut-->
<!DOCTYPE html>  
<head>  
<title>Medicare | Connexion</title>  
<meta charset="utf-8"/>  
<link href="connexion.css" rel="stylesheet" type="text/css" />  
 <!-- Dernier CSS compilé et minifié --> 
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
  
 <!-- Bibliothèque jQuery --> 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
 
 <!-- Dernier JavaScript compilé --> 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
</head>  
<body>
    <?php sleep(1);//Temps de pause pour l'action (petit plus réaliste)?>
    <form method="post" action="index.php">
        <table>
        <tr> 
            <!--Optgroup permet de choisir un item parmi ceux proposés, le même ID est utilisé ensuite dans le traitement des données-->
            <td>Compte</td> 
            <td><select name="compte" id="compte">
                <optgroup label="compte">
                    <option value="client" id='compte'>Client</option>
                    <option value="medecin" id='compte'>Médecin</option>
                    <option value="admin" id='compte'>Administrateur</option>
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
        <tr><td><input type="submit" value= "Se connecter" class="connecter"></td></tr>
    </table>
    </form>
    <br><br>
    <a href="mdp_o.php">Mot de passe oublié</a><br/>
    <form action="inscription.php" method="post"><br>
        <label for="compte">Pas encore de compte ?</label><br><br>
        <input type="submit" value="S'inscrire" class="inscrit">
    </form>
</body>  
</html> 