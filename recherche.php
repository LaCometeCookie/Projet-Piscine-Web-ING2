<!--Recherche de médecins/personnels et labos
 Raccourci de chaque fenêtre avec redirection automatique en fonction de la recherche-->
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
  
<!-- CSS -->  
<style>
     .navbar-nav {
          display: flex;
          justify-content: center;
          width: 100%;
     }
     .navbar-nav > li {
          float: none;
     }
     .navbar-brand {
          display: flex;
          align-items: center;
     }
     .navbar-brand img {
          max-height: 80px; /* A ajuster*/
          margin-right: 10px;
          margin-top: 40px;
     }
     .nav-item-recherche a {
          color: blue !important;
     }
     h2 {
          display: flex;
          justify-content: center;
     }
</style>
  
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
	
	mysqli_close($db_handle);
    ?>

    <!-- Navigation -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <img src="logo.png" alt="Logo"> Medicare
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item-accueil"><a href="index.php">Accueil</a></li>
                    <li class="nav-item-parcourir"><a href="parcourir.php">Parcourir</a></li>
                    <li class="nav-item-rdv"><a href="rdv.php">Rendez-vous</a></li>
                    <?php if ($ok): ?>
                    <li class="nav-item-compte"><a href="profil.php"><?php echo htmlspecialchars($donnees['Nom']) . " " . htmlspecialchars($donnees['Prenom']); ?></a></li>
                    <?php else: ?>
                    <li class="nav-item-compte"><a href="connexion.php">Compte</a></li>
                    <?php endif; ?>
		    <li class="nav-item-recherche"><a href="recherche.php"><span class="glyphicon glyphicon-search"></span> Recherche</a></li>
                </ul>
            </div>
        </div>
    </nav> 

    <div class="container">
    <h2>Formulaire de Recherche</h2>
    <form method="post" action="rechercher.php">
        <div class="form-group row">
            <label for="recherche" class="col-sm-2 col-form-label">Votre recherche</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="recherche" name="recherche">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </div>
    </form>
    </div>
        <!-- Footer -->
        <footer class="text-center mt-4">
        <p>&copy; 2024 Medicare. Tous droits réservés.</p>
        <p>Adresse: 1234 Rue de la Santé, 75000 Paris, France</p>
        <p>Mail: medicare@ece.fr</p>
    </footer>
</body>  
</html> 
