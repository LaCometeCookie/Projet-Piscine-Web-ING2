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
          if($donnees['compte'] == "medecin")
          {?>
          <div class="parcours">
               <select name="choix" id="choix">
                    <optgroup label="choix">
                    <option value="infos" id='choix' onclick ="document.getElementById('infos').style.display = 'block' ;
                    document.getElementById('labos').style.display = 'none' ;">Infos personnelles</option>
                    <option value = "labos" id = 'choix' onclick ="document.getElementById('infos').style.display = 'none' ;
                    document.getElementById('labos').style.display = 'block' ;">Laboratoires</option>
                    </optgroup>
               </select>
               </div>
               <div id = "infos" style="display: none">
                    <p>Les infos personnelles</p>
               </div>
               <div id = "labos" style="display: none">
                    <p>Les labos</p>
               </div>
               <form method = "post" action = "logout.php"><button type="button" class="btn btn-link">
            <a href = "logout.php" onclick="return window.confirm('Êtes-vous sûr ?')">Se déconnecter</a>
          </button></form></form><?php
          }
          if($donnees['compte'] == "admin")
          {?>
          <div class="parcours">
               <select name="choix" id="choix">
                    <optgroup label="choix">
                    <option value="infos" id='choix' onclick ="document.getElementById('infos').style.display = 'block' ;
                    document.getElementById('medecin_plus').style.display = 'none';
                    document.getElementById('labos').style.display = 'none' ;">Infos personnelles</option>
                    <option value="medecin_plus" id='choix' onclick ="document.getElementById('infos').style.display = 'none' ;
                    document.getElementById('medecin_plus').style.display = 'block' ;
                    document.getElementById('labos').style.display = 'none' ;">Gérer le personnel</option>
                    <option value = "labos" id = 'choix' onclick ="document.getElementById('infos').style.display = 'none' ;
                    document.getElementById('medecin_plus').style.display = 'none' ;
                    document.getElementById('labos').style.display = 'block' ;">Laboratoires</option>
                    </optgroup>
               </select>
               </div>
               <div id = "infos" style="display: none">
                    <p>Les infos personnelles</p>
               </div>
               <div id = "medecin_plus" style="display: none">
                    <form method = "post" action = "medecins.php"><input type = "submit" value="Gérer le personnel"></form>
               </div>
               <div id = "labos" style="display: none">
                    <p>Les labos</p>
               </div>
          <form method = "post" action = "logout.php"><button type="button" class="btn btn-link">
            <a href = "logout.php" onclick="return window.confirm('Êtes-vous sûr ?')">Se déconnecter</a>
          </button></form><?php
          }
          if($donnees['compte'] == "client")
          {?>
          <div class="parcours">
               <select name="choix" id="choix">
                    <optgroup label="choix">
                    <option value="infos" id='choix' onclick ="document.getElementById('infos').style.display = 'block' ;
                    document.getElementById('rdv').style.display = 'none';">Infos personnelles</option>
                    <option value="rdv" id='choix' onclick ="document.getElementById('infos').style.display = 'none' ;
                    document.getElementById('rdv').style.display = 'block' ;">Mes RDV</option>
                    </optgroup>
               </select>
               </div>
               <div id = "infos" style="display: none">
                    <p>Les infos personnelles</p>
               </div>
               <div id = "rdv" style="display: none">
                    <?php // Afficher RDV avec SQL?>
                    <form method = "post" action = "rdv.php"><input type = "submit" value="Prendre un RDV"> 
               </div>
               <form method = "post" action = "logout.php"><button type="button" class="btn btn-link">
            <a href = "logout.php" onclick="return window.confirm('Êtes-vous sûr ?')">Se déconnecter</a>
          </button></form><?php
          }
	}
     else
     {
        echo "Vous n'êtes pas connecté";
        ?><input type="text" name="compte" id="compte" value="<?php echo $compte;?>"><form method = "post" action = "index.php"><input type="submit" name= "accueil" value="accueil"></form><?php
     }
     mysqli_close($db_handle); 
     ?>
</body>  
</html> 