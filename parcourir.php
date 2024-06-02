<!-- Fenêtre qui affiche en fonction du choix de l'utilisateur : 
 1. Un menu pour effectuer son choix (par défaut)
 2. La liste des médecins avec sélection possible
 3. La liste des services avec sélection possible (depuis les laboratoires)
 4. La liste des laboratoires avec sélection possible-->
<!DOCTYPE html>  
<head>  
<title>Medicare | Parcourir</title>  
<meta charset="utf-8"/>  
<link href="index.css" rel="stylesheet" type="text/css" />  
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
     try // Test de connexion à la base de données (retorune une erreur en cas d'échec)
     {
     $bdd=new PDO('mysql:host=localhost;dbname=pj web 2024;charset=utf8', 'root', ''); //On y référence le nom d'utilisateur et le mot de passe, la base à utiliser et l'encodage
     }
     catch (Exception $e)
     {
     die('Erreur : ' . $e->getMessage()); // En cas d'erreur de connexion, un message est affiché
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
     <!--Objectif recherché : garder la fenêtre en focntion du choix de l'utilisateur (utilisation de style.display pour gérer les blocs devant apparaitre ou non)-->
     <div class="parcours">
          <select name="choix" id="choix">
               <optgroup label="choix">
               <option value="medecinsg" id='choix' onclick ="document.getElementById('medecinsg').style.display = 'block' ;
               document.getElementById('medecinsp').style.display = 'none';
               document.getElementById('labos').style.display = 'none' ;">Médecins généralistes</option>
               <option value="medecinsp" id='choix' onclick ="document.getElementById('medecinsg').style.display = 'none' ;
               document.getElementById('medecinsp').style.display = 'block' ;
               document.getElementById('labos').style.display = 'none' ;">Médecins spécialistes</option>
               <option value = "labos" id = 'choix' onclick ="document.getElementById('medecinsg').style.display = 'none' ;
               document.getElementById('medecinsp').style.display = 'none' ;
               document.getElementById('labos').style.display = 'block' ;">Laboratoires</option>
               </optgroup>
          </select>
     </div>
     <div id = "medecinsg" style="display: none"><!--Liste des médecins généralistes-->
     <p>Les médecins généralistes</p>
		<table class="centre">
		<tr>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Spécialité</th>
			<th>Mail</th>
               <th>Telephone</th>
               <th>CV</th>
               <th>Photo</th>
		</tr>
          <?php //A bien agencer
          $reponse = $bdd->query('SELECT Nom, Prenom, specialite, Mail, telephone, CV, photo FROM medecins WHERE specialite = "generaliste" ORDER BY Nom');
          while ($donnees = $reponse->fetch())
          {
          ?>
          
               <tr>
                    <td><?php  echo $donnees['Nom']; ?></td>
                    <td><?php  echo $donnees['Prenom']; ?></td>
                    <td><?php  echo $donnees['specialite']; ?></td>
                    <td><?php  echo $donnees['Mail']; ?></td>
                    <td>+33<?php  echo $donnees['telephone']; ?></td>
                    <td><?php  echo $donnees['CV']; ?></td>
                    <td><?php  echo $donnees['photo']; ?></td>
                    <td><form method = "post" action = "rdv.php"><button type="button" class="btn btn-link">
                    <a href = "rdv.php">Prendre un RDV</a></form></td>
                    <td><form method = "post" action = "rdv.php"><button type="button" class="btn btn-link">
                    <a href = "rdv.php">Contacter</a></form></td>
               </tr>

          <?php  
          }
          $reponse->closeCursor();
          ?>
          </table>
     </div>
     <div id = "medecinsp" style="display: none"><!--Liste des médecins spécialistes-->
          <p>Les médecins spécialistes</p>
          <table class="centre">
		<tr>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Spécialité</th>
			<th>Mail</th>
               <th>Telephone</th>
               <th>CV</th>
               <th>Photo</th>
		</tr>
          <?php //A bien agencer
          $reponse = $bdd->query('SELECT Nom, Prenom, specialite, Mail, telephone, CV, photo FROM medecins WHERE specialite != "generaliste" ORDER BY Nom');
          while ($donnees = $reponse->fetch())
          {
          ?>
          
               <tr>
                    <td><?php  echo $donnees['Nom']; ?></td>
                    <td><?php  echo $donnees['Prenom']; ?></td>
                    <td><?php  echo $donnees['specialite']; ?></td>
                    <td><?php  echo $donnees['Mail']; ?></td>
                    <td>+33<?php  echo $donnees['telephone']; ?></td>
                    <td><?php  echo $donnees['CV']; ?></td>
                    <td><?php  echo $donnees['photo']; ?></td>
                    <td><form method = "post" action = "rdv.php"><button type="button" class="btn btn-link">
                    <a href = "rdv.php">Prendre un RDV</a></form></td>
                    <td><form method = "post" action = "rdv.php"><button type="button" class="btn btn-link">
                    <a href = "rdv.php">Contacter</a></form></td>
               </tr>

          <?php  
          }
          $reponse->closeCursor();
          ?>
          </table>
     </div>
     <div id = "labos" style="display: none"><!--Affichage des informations du laboratoire puis de ses services en fonction du labo choisi-->
          <div id = "labinfo" style="display: block">
               <p>Les labos</p>
               <table>
                    <tr>
                         <th>Nom</th>
                         <th>Adresse</th>
                         <th>Salle</th>
                         <th>Mail</th>
                         <th>Telephone</th>
                    </tr>
               <?php //A bien agencer
               $reponse = $bdd->query('SELECT ID, Nom, Adresse, Salle, telephone, Mail FROM labos ORDER BY Nom');
               while ($donnees = $reponse->fetch())
               {
               ?>
               
                    <tr>
                         <td><?php  echo $donnees['Nom']; ?></td>
                         <td><?php  echo $donnees['Adresse']; ?></td>
                         <td><?php  echo $donnees['Salle']; ?></td>
                         <td><?php  echo $donnees['Mail']; ?></td>
                         <td>+33<?php  echo $donnees['telephone']; ?></td>
                         <td><form method = "post" action = "#"><button type="button" class="btn btn-link">
                         <a href = "#" onclick="document.getElementById('service').style.display = 'block';
                         document.getElementById('labinfo').style.display = 'none'"><input type = "text" name = "ID" value = "<?php  echo $donnees['ID']; ?>" hidden>Les services</a>
                         </button></form></td>
                         <!--Infos services à gérer (apparition/disparition)-->
                    </tr>
                    
                    <?php  
               }
               $reponse->closeCursor();
               ?>
               </table>
          </div>
          <div id = "service" style = "display:none">
          <p>Les labos</p>
               <table>
               <?php //A bien agencer
               $ID = (int)$_POST['ID'];
               $reponse = $bdd->query("SELECT Service1, Service2, Service3 FROM labos WHERE ID = $ID");
               
               $donnees = $reponse->fetch();
               ?>
                    <tr>
                         <td><?php  echo htmlspecialchars($donnees['Service1']); ?></td>
                         <td><?php  echo htmlspecialchars($donnees['Service2']); ?></td>
                         <td><?php  echo htmlspecialchars($donnees['Service3']); ?></td>
                         <td><button type="button" class="btn btn-link">
                         <a href = "#" onclick="document.getElementById('service').style.display = 'none';
                         document.getElementById('labinfo').style.display = 'block'">Les labos</a></button></td>
                         <!--Infos services à gérer (apparition/disparition)-->
                    </tr>       
                    <?php  
               
               $reponse->closeCursor();
               ?>
          </div>
     </div>
         <!-- Footer -->
    <footer class="text-center mt-4">
        <p>&copy; 2024 Medicare. Tous droits réservés.</p>
        <p>Adresse: 1234 Rue de la Santé, 75000 Paris, France</p>
    </footer>
</body>  
</html> 