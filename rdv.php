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
     .nav-item-rdv a {
          color: blue !important;
     }
     .center-content {
          display: flex;
          justify-content: center;
          align-items: center;
          flex-direction: column;
     }
     .section-hidden {
          display: none;
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
  
    <div class="container center-content mt-5">
    <h2 class="text-center">Sélectionnez votre type de RDV puis un médecin ou un laboratoire avant de sélectionner votre créneau</h2>
    <div class="form-group">
        <label for="choix">Votre demande de RDV</label>
        <select class="form-control" name="choix" id="choix" onchange="toggleSections()">
            <option value="">Sélectionnez</option>
            <option value="medecin">Médecin</option>
            <option value="labo">Laboratoire</option>
        </select>
    </div>

    <div id="medecin" class="section-hidden">
        <div class="form-group">
            <label for="choix-medecin">Votre médecin</label>
            <select class="form-control" name="choix-medecin" id="choix-medecin" onchange="showMedecinCreneaux()">
                <option value="">Sélectionnez un médecin</option>
                <?php
                $indice = 0;
                $reponse = $bdd->query('SELECT Nom, Prenom FROM medecins ORDER BY Nom');
                while ($donnees = $reponse->fetch()) {
                    $Nom[$indice] = $donnees['Nom'];
                    $Prenom[$indice] = $donnees['Prenom'];
                    $indice++;
                }
                $reponse->closeCursor();
                for ($i = 0; $i < $indice; $i++) {
                    echo "<option value='{$Nom[$i]}{$Prenom[$i]}'>{$Nom[$i]} {$Prenom[$i]}</option>";
                }
                ?>
            </select>
        </div>
        <?php
        for ($i = 0; $i < $indice; $i++) {
            echo "<div id='{$Nom[$i]}{$Prenom[$i]}' class='section-hidden'>";
            echo "<p>Afficher le tableau des créneaux (ou autre ça dépend)</p>";
            echo "</div>";
        }
        ?>
    </div>

    <div id="labo" class="section-hidden">
        <div class="form-group">
            <label for="choix-labo">Votre labo</label>
            <select class="form-control" name="choix-labo" id="choix-labo" onchange="showLaboServices()">
                <option value="">Sélectionnez un laboratoire</option>
                <?php
                $indicel = 0;
                $reponse = $bdd->query('SELECT ID, Nom FROM labos ORDER BY Nom');
                while ($donnees = $reponse->fetch()) {
                    $Noml[$indicel] = $donnees['Nom'];
                    $indicel++;
                }
                $reponse->closeCursor();
                for ($i = 0; $i < $indicel; $i++) {
                    echo "<option value='{$Noml[$i]}'>{$Noml[$i]}</option>";
                }
                ?>
            </select>
        </div>
        <?php
        for ($i = 0; $i < $indicel; $i++) {
            echo "<div id='{$Noml[$i]}' class='section-hidden'>";
            echo "<div class='form-group'>";
            echo "<label for='choixs'>Votre service</label>";
            echo "<select class='form-control' name='choixs' id='choixs' onchange='showServiceCreneaux()'>";
            echo "<option value=''>Sélectionnez un service</option>";

            $ID = (int)$_POST['ID'];
            $reponse = $bdd->query("SELECT Service1, Service2, Service3 FROM labos WHERE ID = $ID");
            $donnees = $reponse->fetch();
            $services = [$donnees['Service1'], $donnees['Service2'], $donnees['Service3']];
            $reponse->closeCursor();

            foreach ($services as $service) {
                echo "<option value='{$service}'>{$service}</option>";
            }

            echo "</select>";
            echo "</div>";
            echo "<p>Afficher le tableau des créneaux (ou autre ça dépend)</p>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<script>
    function toggleSections() {
        var choix = document.getElementById('choix').value;
        document.getElementById('medecin').style.display = (choix === 'medecin') ? 'block' : 'none';
        document.getElementById('labo').style.display = (choix === 'labo') ? 'block' : 'none';
    }

    function showMedecinCreneaux() {
        var medecin = document.getElementById('choix-medecin').value;
        <?php
        for ($i = 0; $i < $indice; $i++) {
            echo "document.getElementById('{$Nom[$i]}{$Prenom[$i]}').style.display = (medecin === '{$Nom[$i]}{$Prenom[$i]}') ? 'block' : 'none';";
        }
        ?>
    }

    function showLaboServices() {
        var labo = document.getElementById('choix-labo').value;
        <?php
        for ($i = 0; $i < $indicel; $i++) {
            echo "document.getElementById('{$Noml[$i]}').style.display = (labo === '{$Noml[$i]}') ? 'block' : 'none';";
        }
        ?>
    }

    function showServiceCreneaux() {
        var service = document.getElementById('choixs').value;
        <?php
        foreach ($services as $service) {
            echo "document.getElementById('{$service}').style.display = (service === '{$service}') ? 'block' : 'none';";
        }
        ?>
    }
</script>
  
  
         <!-- Footer -->
    <footer class="text-center mt-4">
        <p>&copy; 2024 Medicare. Tous droits réservés.</p>
        <p>Adresse: 1234 Rue de la Santé, 75000 Paris, France</p>
        <p>Mail: medicare@ece.fr</p>
    </footer> 
        
        <!-- Fermeture de la communication serveur -->
     <?php
     mysqli_close($db_handle); 
     ?> 
</body>
</html> 
