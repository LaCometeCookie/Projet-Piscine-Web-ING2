<!DOCTYPE html>  
<html lang="fr">  
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
    .nav-item-compte a {
        color: blue !important;
    }
    .container {
        text-align: center;
    }
    .larger-text {
        font-size: larger;
    }
    .section {
        margin-top: 20px;
    }
    .mt-4 {
        margin-top: 20px;
    }
    footer {
        margin-top: 20px;
    }
</style>

</head>  

<body>
  <!-- Script PHP de connexion à la BDD -->
  <?php
    session_start();
    sleep(1); // Temps de pause pour l'action (petit plus réaliste)
    // identifier le nom de base de données 
    $database = "pj web 2024"; 
    // connectez-vous dans votre BDD 
    // Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien) 
    $db_handle = mysqli_connect('localhost', 'root', '' ); 
    $db_found = mysqli_select_db($db_handle, $database);
    try // Test de connexion à la base de données (retorune une erreur en cas d'échec)
    {
        $bdd = new PDO('mysql:host=localhost;dbname=pj web 2024;charset=utf8', 'root', ''); // On y référence le nom d'utilisateur et le mot de passe, la base à utiliser et l'encodage
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

    if($ok)
    {
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
          <li class="nav-item-compte"><a href="profil.php"><?php echo htmlspecialchars($donnees['Nom']) . " " . htmlspecialchars($donnees['Prenom']); ?></a></li>
          <li class="nav-item-recherche"><a href="recherche.php"><span class="glyphicon glyphicon-search"></span> Recherche</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <?php
      if($donnees['compte'] == "medecin") { ?>
      <div class="form-group">
        <label for="choix" class="h4">Choix</label>
        <select name="choix" id="choix" class="form-control large-text">
          <optgroup label="Choix">
            <option value="infos" id='choix' onclick ="document.getElementById('infos').style.display = 'block' ; document.getElementById('rdv').style.display = 'none' ;">Infos personnelles</option>
            <option value = "rdv" id = 'choix' onclick ="document.getElementById('infos').style.display = 'none' ; document.getElementById('rdv').style.display = 'block' ;">Rendez-vous</option>
          </optgroup>
        </select>
      </div>
      
      <div id = "infos" class="section" style="display: none;">
        <p class="h3">Les infos personnelles</p>
        <?php 
        $reponse = $bdd->query('SELECT Nom, Prenom, specialite, Mail, telephone, CV FROM medecins WHERE ID = '.(int)$_SESSION['ID'].'');
        $donnees = $reponse->fetch();
        ?>
        <table class="table table-striped larger-text">
          <tr>
            <td><?php  echo htmlspecialchars($donnees['Nom']); ?></td>
            <td><?php  echo htmlspecialchars($donnees['Prenom']); ?></td>
            <td><?php  echo htmlspecialchars($donnees['specialite']); ?></td>
            <td><?php  echo htmlspecialchars($donnees['Mail']); ?></td>
            <td>+33<?php  echo htmlspecialchars($donnees['telephone']); ?></td>
            <td><?php  echo htmlspecialchars($donnees['CV']); ?></td>
          </tr>
        </table>
        <?php  
        $reponse->closeCursor();
        ?>
      </div>

      <div id = "rdv" class="section" style="display: none;">
        <p class="h3">Mes RDV</p>
        <?php // Afficher RDV avec SQL ?>
      </div>

      <form method="post" action="logout.php">
        <button type="submit" class="btn btn-link" onclick="return confirm('Êtes-vous sûr ?')">Se déconnecter</button>
      </form>

      <?php }
      elseif ($ok && $donnees['compte'] == "admin") { ?>
      <div class="form-group">
        <label for="choix" class="h4">Choix</label>
        <select name="choix" id="choix" class="form-control large-text">
          <optgroup label="Choix">
            <option value="infos">Infos personnelles</option>
            <option value="medecin_plus">Gérer le personnel</option>
            <option value="labos">Laboratoires</option>
          </optgroup>
        </select>
      </div>

      <div id="infos" class="section" style="display: none;">
        <p class="h3">Les infos personnelles</p>
        <?php 
        $reponse = $bdd->query('SELECT Nom, Prenom, Mail FROM administrateur WHERE ID = '.(int)$_SESSION['ID'].'');
        $donnees = $reponse->fetch();
        ?>
        <table class="table table-striped larger-text">
          <tr>
            <td><?php echo htmlspecialchars($donnees['Nom']); ?></td>
            <td><?php echo htmlspecialchars($donnees['Prenom']); ?></td>
            <td><?php echo htmlspecialchars($donnees['Mail']); ?></td>
          </tr>
        </table>
        <?php $reponse->closeCursor(); ?>
      </div>

      <div id="medecin_plus" class="section" style="display: none;">
        <p class="h3">Liste du personnel</p>
        <table class="table table-striped larger-text">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Spécialité</th>
              <th>Mail</th>
              <th>Téléphone</th>
              <th>CV</th>
              <th>Photo</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $reponse = $bdd->query('SELECT Nom, Prenom, specialite, Mail, telephone, CV, photo FROM medecins ORDER BY Nom');
            while ($donnees = $reponse->fetch()) {
            ?>
            <tr>
              <td><?php echo htmlspecialchars($donnees['Nom']); ?></td>
              <td><?php echo htmlspecialchars($donnees['Prenom']); ?></td>
              <td><?php echo htmlspecialchars($donnees['specialite']); ?></td>
              <td><?php echo htmlspecialchars($donnees['Mail']); ?></td>
              <td>+33<?php echo htmlspecialchars($donnees['telephone']); ?></td>
              <td><?php echo htmlspecialchars($donnees['CV']); ?></td>
              <td><?php echo htmlspecialchars($donnees['photo']); ?></td>
            </tr>
            <?php }
            $reponse->closeCursor();
            ?>
          </tbody>
        </table>
      </div>

      <div id="labos" class="section" style="display: none;">
        <p class="h3">Les laboratoires partenaires</p>
        <table class="table table-striped larger-text">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Adresse</th>
              <th>Mail</th>
              <th>Téléphone</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $reponse = $bdd->query('SELECT Nom, Adresse, Mail, telephone FROM laboratoire ORDER BY Nom');
            while ($donnees = $reponse->fetch()) {
            ?>
            <tr>
              <td><?php echo htmlspecialchars($donnees['Nom']); ?></td>
              <td><?php echo htmlspecialchars($donnees['Adresse']); ?></td>
              <td><?php echo htmlspecialchars($donnees['Mail']); ?></td>
              <td>+33<?php echo htmlspecialchars($donnees['telephone']); ?></td>
            </tr>
            <?php 
            }
            $reponse->closeCursor();
            ?>
          </tbody>
        </table>
      </div>

      <form method="post" action="logout.php">
        <button type="submit" class="btn btn-link" onclick="return confirm('Êtes-vous sûr ?')">Se déconnecter</button>
      </form>

      <?php } ?>

  </div>

  <?php
    }
    else
    { 
  ?>
  <div class="container mt-4">
    <p class="text-danger h3">Vous n'êtes pas connecté</p>
    <p class="h4">Redirection automatique dans 5 secondes</p>
    <?php header("refresh:5;url=connexion.php"); ?>
  </div>
  <?php
    }
  ?>
  
  <!-- Footer -->
  <footer class="footer navbar-fixed-bottom">
    <div class="container text-center">
      <span class="text-muted">2024 Medicare</span>
    </div>
  </footer>
</body>  
</html>
