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

<!-- JavaScript --> 
 <script>
     $(document).ready(function() {
         $('#choix').change(function() {
             var selected = $(this).val();
             $('.section').hide();
             $('#' + selected).show();
         });
     });
 </script>
  
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
     .nav-item-parcourir a {
          color: blue !important;
     }
</style>
</head>  

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~ Script PHP du parcours des informations ~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
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
                       <li><a href="connexion.php">Compte</a></li>
                       <?php endif; ?>
		       <li class="nav-item-recherche"><a href="recherche.php"><span class="glyphicon glyphicon-search"></span> Recherche</a></li>
                   </ul>
               </div>
          </div>
     </nav>

    <!--Objectif recherché : garder la fenêtre en fonction du choix de l'utilisateur (utilisation de style.display pour gérer les blocs devant apparaitre ou non)-->
    <div class="parcours container">
          <div class="form-group">
               <label for="choix">Choix</label>
               <select name="choix" id="choix" class="form-control">
                    <option value="medecinsg">Médecins généralistes</option>
                    <option value="medecinsp">Médecins spécialistes</option>
                    <option value="labos">Laboratoires</option>
               </select>
          </div>
     </div>
     <div id="medecinsg" class="section" style="display: none"><!--Liste des médecins généralistes-->
          <p>Les médecins généralistes</p>
          <table class="table table-striped">
               <thead>
                    <tr>
                         <th>Nom</th>
                         <th>Prenom</th>
                         <th>Spécialité</th>
                         <th>Mail</th>
                         <th>Telephone</th>
                         <th>CV</th>
                         <th>Photo</th>
                    </tr>
               </thead>
               <tbody>
                    <?php 
                    $reponse = $bdd->query('SELECT Nom, Prenom, specialite, Mail, telephone, CV, photo FROM medecins WHERE specialite = "generaliste" ORDER BY Nom');
                    while ($donnees = $reponse->fetch())
                    {
                    ?>
                    <tr>
                         <td><?php echo htmlspecialchars($donnees['Nom']); ?></td>
                         <td><?php echo htmlspecialchars($donnees['Prenom']); ?></td>
                         <td><?php echo htmlspecialchars($donnees['specialite']); ?></td>
                         <td><?php echo htmlspecialchars($donnees['Mail']); ?></td>
                         <td>+33<?php echo htmlspecialchars($donnees['telephone']); ?></td>
                         <td><?php echo htmlspecialchars($donnees['CV']); ?></td>
                         <td><?php echo htmlspecialchars($donnees['photo']); ?></td>
                         <td><a href="rdv.php" class="btn btn-link">Prendre un RDV</a></td>
                         <td><a href="rdv.php" class="btn btn-link">Contacter</a></td>
                    </tr>
                    <?php  
                    }
                    $reponse->closeCursor();
                    ?>
               </tbody>
          </table>
     </div>
     <div id="medecinsp" class="section" style="display: none"><!--Liste des médecins spécialistes-->
          <p>Les médecins spécialistes</p>
          <table class="table table-striped">
               <thead>
                    <tr>
                         <th>Nom</th>
                         <th>Prenom</th>
                         <th>Spécialité</th>
                         <th>Mail</th>
                         <th>Telephone</th>
                         <th>CV</th>
                         <th>Photo</th>
                    </tr>
               </thead>
               <tbody>
                    <?php 
                    $reponse = $bdd->query('SELECT Nom, Prenom, specialite, Mail, telephone, CV, photo FROM medecins WHERE specialite != "generaliste" ORDER BY Nom');
                    while ($donnees = $reponse->fetch())
                    {
                    ?>
                    <tr>
                         <td><?php echo htmlspecialchars($donnees['Nom']); ?></td>
                         <td><?php echo htmlspecialchars($donnees['Prenom']); ?></td>
                         <td><?php echo htmlspecialchars($donnees['specialite']); ?></td>
                         <td><?php echo htmlspecialchars($donnees['Mail']); ?></td>
                         <td>+33<?php echo htmlspecialchars($donnees['telephone']); ?></td>
                         <td><?php echo htmlspecialchars($donnees['CV']); ?></td>
                         <td><?php echo htmlspecialchars($donnees['photo']); ?></td>
                         <td><a href="rdv.php" class="btn btn-link">Prendre un RDV</a></td>
                         <td><a href="rdv.php" class="btn btn-link">Contacter</a></td>
                    </tr>
                    <?php  
                    }
                    $reponse->closeCursor();
                    ?>
               </tbody>
          </table>
     </div>
     <div id="labos" class="section" style="display: none"><!--Affichage des informations du laboratoire puis de ses services en fonction du labo choisi-->
          <div id="labinfo" style="display: block">
               <p>Les labos</p>
               <table class="table table-striped">
                    <thead>
                         <tr>
                              <th>Nom</th>
                              <th>Adresse</th>
                              <th>Salle</th>
                              <th>Mail</th>
                              <th>Telephone</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php 
                         $reponse = $bdd->query('SELECT ID, Nom, Adresse, Salle, telephone, Mail FROM labos ORDER BY Nom');
                         while ($donnees = $reponse->fetch())
                         {
                         ?>
                         <tr>
                              <td><?php echo htmlspecialchars($donnees['Nom']); ?></td>
                              <td><?php echo htmlspecialchars($donnees['Adresse']); ?></td>
                              <td><?php echo htmlspecialchars($donnees['Salle']); ?></td>
                              <td><?php echo htmlspecialchars($donnees['Mail']); ?></td>
                              <td>+33<?php echo htmlspecialchars($donnees['telephone']); ?></td>
                              <td><a href="#" class="btn btn-link" onclick="document.getElementById('service').style.display = 'block'; document.getElementById('labinfo').style.display = 'none';"><input type="text" name="ID" value="<?php echo htmlspecialchars($donnees['ID']); ?>" hidden>Les services</a></td>
                         </tr>
                         <?php  
                         }
                         $reponse->closeCursor();
                         ?>
                    </tbody>
               </table>
          </div>
          <div id="service" style="display:none">
               <p>Les services</p>
               <table class="table table-striped">
                    <tbody>
                         <?php 
                         $ID = (int)$_POST['ID'];
                         $reponse = $bdd->prepare("SELECT Service1, Service2, Service3 FROM labos WHERE ID = :ID");
                         $reponse->bindParam(':ID', $ID, PDO::PARAM_INT);
                         $reponse->execute();
                         $donnees = $reponse->fetch();
                         ?>
                         <tr>
                              <td><?php echo htmlspecialchars($donnees['Service1']); ?></td>
                              <td><?php echo htmlspecialchars($donnees['Service2']); ?></td>
                              <td><?php echo htmlspecialchars($donnees['Service3']); ?></td>
                              <td><a href="#" class="btn btn-link" onclick="document.getElementById('service').style.display = 'none'; document.getElementById('labinfo').style.display = 'block';">Les labos</a></td>
                         </tr>
                         <?php  
                         $reponse->closeCursor();
                         ?>
                    </tbody>
               </table>
          </div>
     </div>
  
 
     <?php
          mysqli_close($db_handle); 
     ?>
    <!-- Fin de la communication serveur -->
  
  
     <!-- Footer -->
    <footer class="text-center mt-4">
        <p>&copy; 2024 Medicare. Tous droits réservés.</p>
        <p>Adresse: 1234 Rue de la Santé, 75000 Paris, France</p>
        <p>Mail: medicare@ece.fr</p>
    </footer>
</body>  
</html>
