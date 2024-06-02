<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mot de passe modifié</title>
	<link rel="stylesheet" href="change.css">
	 <!-- Dernier CSS compilé et minifié --> 
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
  
  <!-- Bibliothèque jQuery --> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
  
  <!-- Dernier JavaScript compilé --> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
</head>
<body>
<img src="logo.png" alt="Logo medicare" class="image">
	<?php sleep(1);//Temps de pause pour l'action (petit plus réaliste)
	$compte = $_POST['compte'];
	try
	{
		$bdd=new PDO('mysql:host=localhost;dbname=pj web 2024;charset=utf8', 'root', '');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	if($compte == "admin")
	{
		$reponse = $bdd->prepare('UPDATE administrateur SET ID = :ID, Nom= :Nom, Prenom= :Prenom, Mail = :Mail, mdp = :mdp, ID_connexion = :ID_connexion WHERE Nom = :Nom AND Prenom= :Prenom');
		$reponse->execute(array(
			'Nom' => $_POST['nom'],
			'Prenom' => $_POST['prenom'],
			'Mail' => $_POST['mail'],
			'mdp'=> $_POST['mdp'],
		));
	}
	if($compte == "client")
	{
		$reponse = $bdd->prepare('UPDATE client SET Nom= :Nom, Prenom= :Prenom, Mail = :Mail, mdp = :mdp WHERE Nom = :Nom AND Prenom= :Prenom');
		$reponse->execute(array(
			'Nom' => $_POST['nom'],
			'Prenom' => $_POST['prenom'],
			'Mail' => $_POST['mail'],
			'mdp'=> $_POST['mdp'],
		));
	}
	if($compte == "medecin")
	{
		$reponse = $bdd->prepare('UPDATE medecins SET Nom= :Nom, Prenom= :Prenom, Mail = :Mail, mdp = :mdp WHERE Nom = :Nom AND Prenom= :Prenom');
		$reponse->execute(array(
			'Nom' => $_POST['nom'],
			'Prenom' => $_POST['prenom'],
			'Mail' => $_POST['mail'],
			'mdp'=> $_POST['mdp'],
		));
	}
	?>
		<h2>Votre mot de passe a été modifié avec succès</h2>
		<a href="index.php">Accueil</a>
</body>
</html>