<!--Page d'accueil du site
 Contient les boutons de navigations (comme le reste des fenêtres sauf pour la connexion et le paiement pour le moment)
 Affiche l'actualité en menu défilant (voir Boostrap)
 En bas de page, copyright/infos importantes type adresse (comme le reste des fenêtres sauf pour la connexion et le paiement pour le moment)-->
<!DOCTYPE html>  
<head>  
<title>Medicare | Accueil</title>  
<meta charset="utf-8"/>  
<link href="index.css" rel="stylesheet" type="text/css" />  
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
				$query = $bdd->prepare('UPDATE administrateur SET ID_connexion = :ID_connexion WHERE ID = :ID');
				$query->execute(array(
					'ID_connexion' => $ID_session,
					'ID' => $donnees['ID']
				));
				// Stocker les informations de l'utilisateur dans la session
				$_SESSION['ID_session'] = $ID_session;
				$_SESSION['ID'] = $donnees['ID'];
				$_SESSION['Nom'] = $donnees['Nom'];
				$_SESSION['Prenom'] = $donnees['Prenom'];
				$_SESSION['compte'] = $compte;
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
				// Stocker les informations de l'utilisateur dans la session
				$_SESSION['ID_session'] = $ID_session;
				$_SESSION['ID'] = $donnees['ID'];
				$_SESSION['Nom'] = $donnees['Nom'];
				$_SESSION['Prenom'] = $donnees['Prenom'];
				$_SESSION['compte'] = $compte;
				$ok=TRUE;
			}
			$reponse->closeCursor();
		}
    }
	else if ($compte == "medecin")
    {
		if(isset($_POST['ID_connexion']))
		{
			$ID_session = $_POST['ID_connexion'];
			$reponse = $bdd->prepare('SELECT ID, Prenom FROM medecins WHERE ID_connexion = :ID_connexion');
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
			$reponse = $bdd->prepare('SELECT ID, Mail, mdp, Nom, Prenom FROM medecins WHERE Mail= :Mail AND mdp= :mdp');
			$reponse->execute(array(
			'Mail' => $i,
			'mdp' => $m
			));
			$donnees = $reponse->fetch();
			if (isset($donnees['Mail']) AND isset($donnees['mdp']))
			{
				$ID_session = random_int(1000000, 1000000000);
				$query = $bdd->prepare('UPDATE medecins SET ID_connexion = :ID_connexion WHERE ID = :ID');
				$query->execute(array(
					'ID_connexion' => $ID_session,
					'ID' => $donnees['ID']
				));
				// Stocker les informations de l'utilisateur dans la session
				$_SESSION['ID_session'] = $ID_session;
				$_SESSION['ID'] = $donnees['ID'];
				$_SESSION['Nom'] = $donnees['Nom'];
				$_SESSION['Prenom'] = $donnees['Prenom'];
				$_SESSION['compte'] = $compte;
				$ok=TRUE;
			}
			$reponse->closeCursor();
		}
    }
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
		</button> 
		<?php 
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
		</button> 
		<?php
		}
	mysqli_close($db_handle); 
	?>
</body>  
</html> 