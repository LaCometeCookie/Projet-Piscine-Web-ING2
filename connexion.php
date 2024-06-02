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
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4">
            <h2 class="text-center">Se connecter</h2>
            <form method="post" action="index.php">
                <div class="form-group">
                    <label for="compte">Compte</label>
                    <select name="compte" id="compte" class="form-control">
                        <option value="client">Client</option>
                        <option value="medecin">Médecin</option>
                        <option value="admin">Administrateur</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mail">Mail</label>
                    <input type="text" class="form-control" name="mail" required>
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" class="form-control" name="mdp" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
            </form>
            <br>
            <div class="mt-3 text-center">
                <a href="mdp_o.php">Mot de passe oublié</a>
            </div>
            <br>
            <form action="inscription.php" method="post" class="mt-3">
                <div class="text-center">
                    <label for="compte">Pas encore de compte ?</label><br>
                    <input type="submit" value="S'inscrire" class="btn btn-secondary">
                </div>
            </form>
        </div> 
    </div>
</body>  
</html> 