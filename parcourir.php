<!-- Fenêtre qui affiche en fonction du choix de l'utilisateur : 
 1. Un menu pour effectuer son choix (par défaut)
 2. La liste des médecins avec sélection possible
 3. La liste des services avec sélection possible
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
</head>  
<body>
     <?php $choix = isset($_POST["choix"])? $_POST["choix"] : ""?>
     <!-- Boutons communs à toutes les fenêtres (sauf connexion) -->
     <button type="button" class="btn btn-link">
          <a href = "index.html">Accueil</a></button> 
     <button type="button" class="btn btn-link">
          <a href ="parcourir.php">Parcourir</a>
     </button>
     <button type="button" class="btn btn-link">
          <a href = "rdv.html">Rendez-vous</a>
     </button>
     <button type="button" class="btn btn-link">
          <a href = "connexion.html">Compte</a></button>
     <button type="button" class="btn btn-info"> 
          <a href = "recherche.html"><span class="glyphicon glyphicon-search"></span> Recherche </a>
     </button>
     <!--Objectif recherché : garder la fenêtre en focntion du choix de l'utilisateur-->
     <div class="parcours">
        <div class="dropdown" name = "choix" > 
            <button class="btn btn-success" class="btn btn-default dropdown-toggle" type="button"  
                                  data-toggle="dropdown">Sélectionnez un service
            <span class="caret"></span></button>
        <ul class="dropdown-menu"> 
            <li><a href ="parcourir.php" value = "medecin">Médecins</a></li> 
            <li><a href ="parcourir.php" value = "service">Services</a></li> 
            <li><a href ="parcourir.php" value = "labo">Laboratoires</a></li>
        </ul> 
     </div>
     <?php echo $choix?>
</body>  
</html> 