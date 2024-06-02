<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Réinitialiser votre mot de passe</title>
	<link rel="stylesheet" href="recup.css">
 <!-- Dernier CSS compilé et minifié --> 
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
  
 <!-- Bibliothèque jQuery --> 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
 
 <!-- Dernier JavaScript compilé --> 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
</head>
<body>
<img src="logo.png" alt="Logo Medicare" class="image">
<?php sleep(1);//Temps de pause pour l'action (petit plus réaliste)
	$n = $_POST['nom'];
    $p = $_POST['prenom'];
	$q = $_POST['mail'];
	$compte = $_POST['compte'];
	try
	{
		$bdd=new PDO('mysql:host=localhost;dbname=pj web 2024;charset=utf8', 'root', '');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	if ($compte == "admin")
	{
		$reponse = $bdd->prepare('SELECT Nom, Prenom, Mail FROM administrateur WHERE Nom= :Nom AND Prenom= :Prenom AND Mail = :Mail');
		  $reponse->execute(array(
			'Nom' => $n,
			'Prenom' => $p,
			'Mail' => $q,
		  ));
		$donnees = $reponse->fetch();
		if (isset($donnees['Nom']) AND isset($donnees['Prenom']))
		{
		?>
			<form method="POST" action="change_mdp.php">
				<input type="text" name="nom" value="<?php echo $n ?>" id="nom" hidden>
				<input type="text" name="prenom" value="<?php echo $p ?>" id="prenom" hidden>
				<input type="text" name="mail" value="<?php echo $q ?>" id="mail" hidden>
				<input type="text" name="compte" value="<?php echo $compte ?>" id="compte" hidden>
				<div class="form-group">
				<label for="mdp">Votre nouveau mot de passe :</label>
				<input type="password" name="mdp" placeholder="Nouveau mot de passe" id="mdp" required>
				</div>
				<div class="form-group">
				<label for="mdp1">Confirmer votre mot de passe :</label>
				<input type="password" name="mdp" placeholder="Confirmez votre nouveau mot de passe" id="mdp" required>
				</div>
				<input type="submit" value="Changer les informations" class="change">
				
			</form>
		<?php
		}
		else
		{
		?>
			<h4>Erreur de saisie</h4>
			<form method="POST" action="mdp_o.php">
			  <input type="submit" value= "Revenir">
		<?php
		}
		
	}
	if ($compte == "client")
	{
		$reponse = $bdd->prepare('SELECT Nom, Prenom, Mail FROM administrateur WHERE Nom= :Nom AND Prenom= :Prenom AND Mail = :Mail');
		  $reponse->execute(array(
			'Nom' => $n,
			'Prenom' => $p,
			'Mail' => $q,
		  ));
		$donnees = $reponse->fetch();
		if (isset($donnees['Nom']) AND isset($donnees['Prenom']))
		{
		?>
			<form method="POST" action="change_mdp.php">
				<input type="text" name="nom" value="<?php echo $n ?>" id="nom" hidden>
				<input type="text" name="prenom" value="<?php echo $p ?>" id="prenom" hidden>
				<input type="text" name="mail" value="<?php echo $q ?>" id="mail" hidden>
				<input type="text" name="compte" value="<?php echo $compte ?>" id="compte" hidden>
				<div class="form-group">
				<label for="mdp">Votre nouveau mot de passe :</label>
				<input type="password" name="mdp" placeholder="Nouveau mot de passe" id="mdp" required>
				</div>
				<div class="form-group">
				<label for="mdp">Confirmer votre mot de passe :</label>
				<input type="password" name="mdp" placeholder="Confirmez votre nouveau mot de passe" id="mdp" required>
				</div>
				<input type="submit" value="Changer les informations" class="change">
				
			</form>
		<?php
		}
		else
		{
		?>
			<h4>Erreur de saisie</h4>
			<form method="POST" action="mdp_o.php">
			  <input type="submit" value= "Revenir">
		<?php
		}
		
	}
	if ($compte == "medecin")
	{
		$reponse = $bdd->prepare('SELECT Nom, Prenom, Mail FROM administrateur WHERE Nom= :Nom AND Prenom= :Prenom AND Mail = :Mail');
		  $reponse->execute(array(
			'Nom' => $n,
			'Prenom' => $p,
			'Mail' => $q,
		  ));
		$donnees = $reponse->fetch();
		if (isset($donnees['Nom']) AND isset($donnees['Prenom']))
		{
		?>
			<form method="POST" action="change_mdp.php">
				<input type="text" name="nom" value="<?php echo $n ?>" id="nom" hidden>
				<input type="text" name="prenom" value="<?php echo $p ?>" id="prenom" hidden>
				<input type="text" name="mail" value="<?php echo $q ?>" id="mail" hidden>
				<input type="text" name="compte" value="<?php echo $compte ?>" id="compte" hidden>
				<div class="form-group">
				<label for="mdp">Votre nouveau mot de passe :</label>
				<input type="password" name="mdp" placeholder="Nouveau mot de passe" id="mdp" required>
				</div>
				<div class="form-group">
				<label for="mdp">Confirmer votre mot de passe :</label>
				<input type="password" name="mdp" placeholder="Confirmez votre nouveau mot de passe" id="mdp" required>
				</div>
				<input type="submit" value="Changer les informations" class="change">
				
			</form>
		<?php
		}
		else
		{
		?>
			<h4>Erreur de saisie</h4>
			<form method="POST" action="mdp_o.php">
			  <input type="submit" value= "Revenir">
		<?php
		}		
	}
	?>
</body>
</html>