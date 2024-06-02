<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mot de passe oublié</title>
    <link rel="stylesheet" href="mdp_o_style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
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
            <h2 class="text-center">Mot de passe oublié</h2>
            <form method="post" action="mdp_recup.php">
                <div class="form-group">
                    <label for="compte">Compte</label>
                    <select name="compte" id="compte" class="form-control">
                        <option value="client">Client</option>
                        <option value="medecin">Médecin</option>
                        <option value="admin">Administrateur</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prenom</label>
                    <input type="text" class="form-control" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="mail">Mail</label>
                    <input type="text" class="form-control" name="mail" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
            </form>
            <br>
            <form action="index.php" method="post" class="mt-3">
                <div class="text-center">
                    <input type="submit" value="Retour à l'accueil" class="btn btn-secondary">
                </div>
            </form>
        </div> 
    </div>
</body>
</html>