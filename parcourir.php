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
          <select name="compte" id="compte">
               <optgroup label="choix">
               <option value="medecins" id='choix' onclick ="document.getElementById('medecins').style.display = 'block' ;
               document.getElementById('services').style.display = 'none';
               document.getElementById('labos').style.display = 'none' ;">Médecins</option>
               <option value="services" id='choix' onclick ="document.getElementById('medecins').style.display = 'none' ;
               document.getElementById('services').style.display = 'block' ;
               document.getElementById('labos').style.display = 'none' ;">Servcies</option>
               <option value = "labos" id = 'choix' onclick ="document.getElementById('medecins').style.display = 'none' ;
               document.getElementById('services').style.display = 'none' ;
               document.getElementById('labos').style.display = 'block' ;">Laboratoires</option>
               </optgroup>
          </select>
     </div>
     <div id = "medecins">
          <p>Les médecins</p>
     </div>
     <div id = "services">
          <p>Les services</p>
     </div>
     <div id = "labos">
          <p>Les labos</p>
     </div>
</body>  
</html> 