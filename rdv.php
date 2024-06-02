<!--Prise de RDV (uniquement pour le client)
 Forme d'un tableau en fonction des médecins et de ses disponibilités
 Enregistre le RDV pris dans une base dédiée puis le fait rediriger vers le paiement si nécessaire (seulement certains servcices prédéfinis)-->
 <!DOCTYPE html>  
<head>  
<title>Medicare | RDV</title>  
<meta charset="utf-8"/>  
<link href="rdv.css" rel="stylesheet" type="text/css" />  
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
     .nav-item-parcourir a {
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
       </button><?php
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
     }?>
  
     <!--Section RDV-->
     <h2>Sélectionnez votre type de RDV puis un médecin ou un laboratoire avant de sélectionner votre créneau</h2>
     <select name="choix" id="choix">
          <optgroup label="Votre demande de RDV">
          <option value="medecin" id='choix' onclick ="document.getElementById('medecin').style.display = 'block' ;
          document.getElementById('labo').style.display = 'none' ;">Médecin</option>
          <option value = "labo" id = 'choix' onclick ="document.getElementById('medecin').style.display = 'none' ;
          document.getElementById('labo').style.display = 'block' ;">Laboratoires</option>
          </optgroup>
     </select>
     <div id ="medecin" style = "display: none">
          <select name="choix medecin" id="choix medecin">
          <optgroup label="Votre medecin">
          <?php //A mettre en XML
               $indice = 0;
               $reponse = $bdd->query('SELECT Nom, Prenom FROM medecins ORDER BY Nom');
               while ($donnees = $reponse->fetch())
               {    
                    $Nom[$indice] = $donnees['Nom'];
                    $Prenom[$indice] = $donnees['Prenom'];
                    $indice++;
               }
               $reponse->closeCursor();
               for($i = 0 ; $i < $indice ; $i++)
               {
                    ?>
                    <option value= "<?php echo $Nom[$i] . $Prenom[$i];?>" 
                    id="choix medecin" onclick ="document.getElementById('<?php echo $Nom[$i] . $Prenom[$i]?>').style.display = 'block' ;"><?php echo $Nom[$i] ." ". $Prenom[$i];?></option>
                    <?php     
               }
          ?>
          </optgroup>               
          </select>
          <?php
          for($i = 0 ; $i < $indice ; $i++)
               {
                    ?>
                    <div id = "<?php echo $Nom[$i].$Prenom[$i];?>" style = "display : none">
                         <!--Afficher le tableau des créneaux (ou autre ça dépend)-->
                         <p>Afficher le tableau des créneaux (ou autre ça dépend)</p>
                    </div>
                    <?php     
               }
          ?>
     </div>
     <div id ="labo" style = "display: none">
          <select name="choix labo" id="choix labo">
          <optgroup label="Votre labo">
          <?php //A mettre en XML
               $indicel = 0;
               $reponse = $bdd->query('SELECT ID, Nom FROM labos ORDER BY Nom');
               while ($donnees = $reponse->fetch())
               {    
                    $Noml[$indicel] = $donnees['Nom'];
                    $indicel++;
               }
               $reponse->closeCursor();
               for($i = 0 ; $i < $indicel ; $i++)
               {
                    ?>
                    <option value= "<?php echo $Noml[$i];?>" 
                    id="choix labo" onclick ="document.getElementById('<?php echo $Noml[$i]?>').style.display = 'block' ;"><?php echo $Noml[$i];?></option>
                    <?php     
               }
          ?>
          </optgroup>               
          </select>
          <?php
          for($i = 0 ; $i < $indicel ; $i++)
          {
               ?>
               <div id = "<?php echo $Noml[$i];?>" style = "display : none">
               <?php
               $ID = (int)$_POST['ID'];
               $reponse = $bdd->query("SELECT Service1, Service2, Service3 FROM labos WHERE ID = $ID");
               $donnees = $reponse->fetch();
               $se1 = $donnees['Service1'];
               $se2 = $donnees['Service2'];
               $se3 = $donnees['Service3'];
               $reponse->closeCursor();
               ?>
               <!--Choix du service du labo sélectionné-->
               <select name="choixs" id="choixs">
                    <optgroup label="Votre service">
                    <option value="<?php echo $se1?>" id='choixs' onclick ="document.getElementById('<?php echo $se1?>').style.display = 'block' ;
                    document.getElementById('<?php echo $se2?>').style.display = 'none' ;
                    document.getElementById('<?php echo $se3?>').style.display = 'none' ;"><?php echo htmlspecialchars($se1)?></option>
                    <option value="<?php echo $se2?>" id='choixs' onclick ="document.getElementById('<?php echo $se1?>').style.display = 'none' ;
                    document.getElementById('<?php echo $se2?>').style.display = 'block' ;
                    document.getElementById('<?php echo $se3?>').style.display = 'none' ;"><?php echo htmlspecialchars($se2)?></option>
                    <option value="<?php echo $se3?>" id='choixs' onclick ="document.getElementById('<?php echo $se1?>').style.display = 'none' ;
                    document.getElementById('<?php echo $se2?>').style.display = 'none' ;
                    document.getElementById('<?php echo $se3?>').style.display = 'block' ;"><?php echo htmlspecialchars($se3)?></option>
                    </optgroup>
               </select>
               <!--Afficher le tableau des créneaux (ou autre ça dépend).-->
               <!--Choisir 2 services payants pour la page paiement-->
               </div>
               <?php     
          }
          ?>
     </div>
  
  
         <!-- Footer -->
    <footer class="text-center mt-4">
        <p>&copy; 2024 Medicare. Tous droits réservés.</p>
        <p>Adresse: 1234 Rue de la Santé, 75000 Paris, France</p>
    </footer> 
        
        <!-- Fermeture de la communication serveur -->
     <?php
     mysqli_close($db_handle); 
     ?> 
</body>
</html> 