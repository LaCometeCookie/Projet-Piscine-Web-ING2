<!DOCTYPE html>  
<head>  
<title>Medicare | Recherche</title>  
<meta charset="utf-8"/>  
<link href="recherche.css" rel="stylesheet" type="text/css" />  
 <!-- Dernier CSS compilé et minifié --> 
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
  
 <!-- Bibliothèque jQuery --> 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
 
 <!-- Dernier JavaScript compilé --> 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
</head>  
<body>
	<?php
	//identifier le nom de base de données 
	$database = "pj web 2024"; 
	//connectez-vous dans votre BDD 
	//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien) 
	$db_handle = mysqli_connect('localhost', 'root', '' ); 
	$db_found = mysqli_select_db($db_handle, $database);
	$compte = isset($_POST["compte"])? $_POST["compte"] : "";
	$ID_session = NULL;
	$ok=FALSE;
	$bdd= NULL;
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
     if(isset($_POST['ID_connexion']))
	{
		$ID_session = $_POST['ID_connexion'];
		$reponse = $bdd->prepare('SELECT ID, Prenom FROM administrateur WHERE ID_connexion = :ID_connexion');
		$reponse->execute(array(
		'ID_connexion' => $ID_session
		));
		$donnees = $reponse->fetch();
		$ok = TRUE;
	}
	elseif(isset($_POST['mail']) AND isset($_POST['mdp']))
	{
		$i = $_POST['mail'];
		$m = $_POST['mdp'];
		$reponse = $bdd->prepare('SELECT ID, Mail, mdp, Nom, Prenom FROM administrateur WHERE Mail= :Mail AND mdp= :mdp');
		$reponse->execute(array(
		'Mail' => $i,
		'mdp' => $m
		));
		$donnees = $reponse->fetch();
		if (isset($donnees['Mail']) AND isset($donnees['mdp']))
		{
			$ID_session = random_int(1000000, 1000000000);
			$query = $bdd->prepare('UPDATE admnistrateur SET ID_connexion = :ID_connexion WHERE ID = :ID');
			$query->execute(array(
				'ID_connexion' => $ID_session,
				'ID' => $donnees['ID']
			));
			$ok=TRUE;
		}
		$reponse->closeCursor();
	}
    }
    else if ($compte == "client")
    {
     if(isset($_POST['ID_connexion']))
	{
		$ID_session = $_POST['ID_connexion'];
		$reponse = $bdd->prepare('SELECT ID, Prenom FROM client WHERE ID_connexion = :ID_connexion');
		$reponse->execute(array(
		'ID_connexion' => $ID_session
		));
		$donnees = $reponse->fetch();
		$ok = TRUE;
	}
	elseif(isset($_POST['mail']) AND isset($_POST['mdp']))
	{
		$i = $_POST['mail'];
		$m = $_POST['mdp'];
		$reponse = $bdd->prepare('SELECT ID, Mail, mdp, Nom, Prenom FROM client WHERE Mail= :Mail AND mdp= :mdp');
		$reponse->execute(array(
		'Mail' => $i,
		'mdp' => $m
		));
		$donnees = $reponse->fetch();
		if (isset($donnees['Mail']) AND isset($donnees['mdp']))
		{
			$ID_session = random_int(1000000, 1000000000);
			$query = $bdd->prepare('UPDATE client SET ID_connexion = :ID_connexion WHERE ID = :ID');
			$query->execute(array(
				'ID_connexion' => $ID_session,
				'ID' => $donnees['ID']
			));
			$ok=TRUE;
		}
		$reponse->closeCursor();
	}
    }
	
	if($ok)
	{
          
  	?><!-- Boutons communs à toutes les fenêtres (sauf connexion) -->
       <button type="button" class="btn btn-link">
            <a href = "index.html">Accueil</a></button> 
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
          <a href = "index.html">Accueil</a></button> 
     <button type="button" class="btn btn-link">
          <a href = "parcourir.php">Parcourir</a>
     </button>
     <button type="button" class="btn btn-link">
          <a href = "rdv.php">Rendez-vous</a>
     </button>
     <button type="button" class="btn btn-link">
          <a href = "connexion.html">Compte</a></button>
     <button type="button" class="btn btn-info"> 
          <a href = "recherche.php"><span class="glyphicon glyphicon-search"></span> Recherche </a>
     </button> 
     <?php
     }
     mysqli_close($db_handle); 
     ?>
     <form method="post" action="rechercher.php">
     <table>
        <tr>
            <td>Votre recherche</td> 
            <td><input type="text" name="recherche"></td>
            <td><input type="submit" name= "rechercher" value="rechercher"></td>
        </tr>
     </table>
    </form> 
</body>  
</html> 