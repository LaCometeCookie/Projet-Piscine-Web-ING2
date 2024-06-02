<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medicare | Accueil</title>
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
          max-height: 80px; /* A ajuster*/
          margin-right: 10px;
          margin-top: 40px;
     }
     .nav-item-accueil a {
          color: blue !important;
     }
    </style>
</head>  
<body>
    <?php
    session_start();
    sleep(1); // Temps de pause pour l'action (petit plus réaliste)

    $database = "pj web 2024"; 
    $db_handle = mysqli_connect('localhost', 'root', '' ); 
    $db_found = mysqli_select_db($db_handle, $database);
    $compte = isset($_POST["compte"]) ? $_POST["compte"] : "";
    $ID_session = NULL;
    $ok = FALSE;
    $tentative = FALSE;
    $bdd = NULL;
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=pj web 2024;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    if ($compte == "admin") {
        // Gestion de la connexion pour l'administrateur
        if (isset($_POST['ID_connexion'])) {
            $ID_session = $_POST['ID_connexion'];
            $reponse = $bdd->prepare('SELECT ID, Prenom FROM administrateur WHERE ID_connexion = :ID_connexion');
            $reponse->execute(array('ID_connexion' => $ID_session));
            $donnees = $reponse->fetch();
            $ok = TRUE;
        } elseif (isset($_POST['mail']) && isset($_POST['mdp'])) {
            $i = $_POST['mail'];
            $m = $_POST['mdp'];
            $reponse = $bdd->prepare('SELECT ID, Mail, mdp, Nom, Prenom FROM administrateur WHERE Mail= :Mail AND mdp= :mdp');
            $reponse->execute(array('Mail' => $i, 'mdp' => $m));
            $donnees = $reponse->fetch();
            if (isset($donnees['Mail']) && isset($donnees['mdp'])) {
                $ID_session = random_int(1000000, 1000000000);
                $query = $bdd->prepare('UPDATE administrateur SET ID_connexion = :ID_connexion WHERE ID = :ID');
                $query->execute(array('ID_connexion' => $ID_session, 'ID' => $donnees['ID']));
                // Stocker les informations de l'utilisateur dans la session
                $_SESSION['ID_session'] = $ID_session;
                $_SESSION['ID'] = $donnees['ID'];
                $_SESSION['Nom'] = $donnees['Nom'];
                $_SESSION['Prenom'] = $donnees['Prenom'];
                $_SESSION['compte'] = $compte;
                $ok = TRUE;
            }
            $reponse->closeCursor();
        } else {
            $tentative = TRUE;
        }
    } elseif ($compte == "client") {
        // Gestion de la connexion pour le client
        if (isset($_POST['ID_connexion'])) {
            $ID_session = $_POST['ID_connexion'];
            $reponse = $bdd->prepare('SELECT ID, Prenom FROM client WHERE ID_connexion = :ID_connexion');
            $reponse->execute(array('ID_connexion' => $ID_session));
            $donnees = $reponse->fetch();
            $ok = TRUE;
        } elseif (isset($_POST['mail']) && isset($_POST['mdp'])) {
            $i = $_POST['mail'];
            $m = $_POST['mdp'];
            $reponse = $bdd->prepare('SELECT ID, Mail, mdp, Nom, Prenom FROM client WHERE Mail= :Mail AND mdp= :mdp');
            $reponse->execute(array('Mail' => $i, 'mdp' => $m));
            $donnees = $reponse->fetch();
            if (isset($donnees['Mail']) && isset($donnees['mdp'])) {
                $ID_session = random_int(1000000, 1000000000);
                $query = $bdd->prepare('UPDATE client SET ID_connexion = :ID_connexion WHERE ID = :ID');
                $query->execute(array('ID_connexion' => $ID_session, 'ID' => $donnees['ID']));
                // Stocker les informations de l'utilisateur dans la session
                $_SESSION['ID_session'] = $ID_session;
                $_SESSION['ID'] = $donnees['ID'];
                $_SESSION['Nom'] = $donnees['Nom'];
                $_SESSION['Prenom'] = $donnees['Prenom'];
                $_SESSION['compte'] = $compte;
                $ok = TRUE;
            }
            $reponse->closeCursor();
        } else {
            $tentative = TRUE;
        }
    } elseif ($compte == "medecin") {
        // Gestion de la connexion pour le médecin
        if (isset($_POST['ID_connexion'])) {
            $ID_session = $_POST['ID_connexion'];
            $reponse = $bdd->prepare('SELECT ID, Prenom FROM medecins WHERE ID_connexion = :ID_connexion');
            $reponse->execute(array('ID_connexion' => $ID_session));
            $donnees = $reponse->fetch();
            $ok = TRUE;
        } elseif (isset($_POST['mail']) && isset($_POST['mdp'])) {
            $i = $_POST['mail'];
            $m = $_POST['mdp'];
            $reponse = $bdd->prepare('SELECT ID, Mail, mdp, Nom, Prenom FROM medecins WHERE Mail= :Mail AND mdp= :mdp');
            $reponse->execute(array('Mail' => $i, 'mdp' => $m));
            $donnees = $reponse->fetch();
            if (isset($donnees['Mail']) && isset($donnees['mdp'])) {
                $ID_session = random_int(1000000, 1000000000);
                $query = $bdd->prepare('UPDATE medecins SET ID_connexion = :ID_connexion WHERE ID = :ID');
                $query->execute(array('ID_connexion' => $ID_session, 'ID' => $donnees['ID']));
                // Stocker les informations de l'utilisateur dans la session
                $_SESSION['ID_session'] = $ID_session;
                $_SESSION['ID'] = $donnees['ID'];
                $_SESSION['Nom'] = $donnees['Nom'];
                $_SESSION['Prenom'] = $donnees['Prenom'];
                $_SESSION['compte'] = $compte;
                $ok = TRUE;
            }
            $reponse->closeCursor();
        } else {
            $tentative = TRUE;
        }
    }

    if (isset($_SESSION['ID_session']) && isset($_SESSION['ID'])) {
        // L'utilisateur est connecté
        $donnees['ID'] = $_SESSION['ID'];
        $donnees['Nom'] = $_SESSION['Nom'];
        $donnees['Prenom'] = $_SESSION['Prenom'];
        $donnees['compte'] = $_SESSION['compte'];
        $ok = TRUE;
    } else {
        $ok = FALSE;
    }

    mysqli_close($db_handle);
    ?>

    <!-- Navigation -->
    <!-- Search bar v2 -->
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
                       <li class="nav-item-recherche"><a href="recherche.php"><span class="glyphicon glyphicon-search"></span> Recherche</a></li>
                            <?php if ($ok): ?>
                           <li class="nav-item-compte"><a href="profil.php"><?php echo htmlspecialchars($donnees['Nom']) . " " . htmlspecialchars($donnees['Prenom']); ?></a></li>
                       <?php else: ?>
                           <li><a href="connexion.php">Compte</a></li>
                       <?php endif; ?>
                   </ul>
               </div>
          </div>
     </nav>
    <!-- Fin searchbar -->

    <div class="container text-center">
        <!-- Actualités -->
        <h2>Actualités</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Titre de l'actualité 1</h3>
                <p>Ceci est le paragraphe de l'actualité 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
            </div>
            <div class="col-md-6">
                <img src="image1.jpg" class="img-responsive center-block" alt="Image 1">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3>Titre de l'actualité 2</h3>
                <p>Ceci est le paragraphe de l'actualité 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
            </div>
            <div class="col-md-6">
                <img src="image2.jpg" class="img-responsive center-block" alt="Image 2">
            </div>
        </div>
        <!-- Ajouter plus d'actualités ici -->
        <!-- Sous le format ci dessous -->
        <div class="row">
            <div class="col-md-6">
                <h3></h3>
                <p></p>
            </div>  
        </div>  
      
    <!-- Fin des actus -->
    </div>

    <!-- Footer -->
    <footer class="text-center mt-4">
        <p>&copy; 2024 Medicare. Tous droits réservés.</p>
        <p>Adresse: 1234 Rue de la Santé, 75000 Paris, France</p>
    </footer>
</body>  
</html>
