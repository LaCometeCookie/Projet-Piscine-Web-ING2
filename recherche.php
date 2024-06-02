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
            max-height: 40px; /* A ajuster*/
            margin-right: 10px;
        }
        .nav-item-accueil a {
            color: blue !important;
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
                    <li><a href="parcourir.php">Parcourir</a></li>
                    <li><a href="rdv.php">Rendez-vous</a></li>
                    <?php if ($ok): ?>
                        <li><a href="profil.php"><?php echo htmlspecialchars($donnees['Nom']) . " " . htmlspecialchars($donnees['Prenom']); ?></a></li>
                    <?php else: ?>
                        <li><a href="connexion.php">Compte</a></li>
                    <?php endif; ?>
                    <li><a href="recherche.php"><span class="glyphicon glyphicon-search"></span> Recherche</a></li>
                </ul>
            </div>
        </div>
    </nav> 
     <form method="post" action="rechercher.php">
     <table>
        <tr>
            <td>Votre recherche</td> 
            <td><input type="text" name="recherche"></td>
            <td><input type="submit" name= "rechercher" value="rechercher"></td>
        </tr>
     </table>
    </form>
        <!-- Footer -->
        <footer class="text-center mt-4">
        <p>&copy; 2024 Medicare. Tous droits réservés.</p>
        <p>Adresse: 1234 Rue de la Santé, 75000 Paris, France</p>
    </footer>
</body>  
</html> 