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


    <!-- Caroussel -->
    <div class="container text-center">
        <h2>Medicare : un service professionnel !</h2>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper pour les images -->
            <div class="carousel-inner">

                <div class="item active">

                    <img src="Images/Caroussel1.jpg" alt="Paris" style="width:100%; height: 600px;">
                    <div class="carousel-caption">
                        <h2>Les medecins</h2>
                        <p>Nos medecins sont à votre écoute pour répondre au mieux à vos interrogations</p>
                    </div>
                </div>
                <div class="item">
                    <img src="Images/Caroussel2.jpeg" alt="Berlin" style="width:100%; height: 600px;">
                    <div class="carousel-caption">
                        <h2>Les laboratoires</h2>
                        <p>Nos différents laboratoires sont présents pour vous apporter un traitement de qualité
                            ainsi qu'un suivi médical professionnel</p>
                    </div>
                </div>
                <div class="item">
                    <img src="images/Caroussel3.jpg" alt="Prague" style="width:100%; height: 600px;">
                    <div class="carousel-caption">
                        <h2>Les spécialistes</h2>
                        <p>Nos nombreux spécialistes sont formés pour vous apporter les meilleurs soins
                        possibles et s'assurer que vous retrouviez la santé en toute sérénité</p>
                    </div>
                </div>
                <div class="item">
                    <img src="images/Caroussel4.jpg" alt="Rome" style="width:100%; height: 600px;">
                    <div class="carousel-caption">
                        <h2>Medicare</h2>
                        <p>Nous mettons en relation clients et professionnel pour des soins de qualité</p>
                    </div>
                </div>


            </div>
            <!-- Controles à gauche et à droite -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Précédent</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Suivant</span>
            </a>
        </div>
    </div>


    <!-- Actualités -->
      <div class="container text-center">
          <br>
          <br>
          <h1>Dernières Actualités</h1>
          <br>
          <div class="row">
              <div class="col-md-6">
                  <h3>Nouveau variant du Coronavirus</h3>
                  <p style="text-align: left;">En ce 25 Mai 2054, un enième nouveau variant du Coronavirus a été découvert. Voici nos conseils pour vous protéger :
                  <br>
                  <br>
                  Lavez-vous les mains régulièrement avec de l'eau.<br>
                  Utilisez un désinfectant pour les mains à base d'alcool (au moins 60%).<br>
                  Portez un masque en public.<br>
                  Changez de masque régulièrement.<br>
                  Maintenez une distance d'au moins 1 mètre <br>
                  Nettoyez et désinfectez régulièrement les surfaces fréquemment touchées.<br>
                  Consultez un médecin si vous développez des signes de fièvres.<br>
                  Enfin restez informé des directives sanitaires locales.<br>
                  </p>
              </div>
              <div class="col-md-6">
                  <img src="Images/Blog1.jpeg" class="img-responsive center-block" alt="Image 1">
              </div>
          </div>
          <br>
          <div class="row">
              <div class="col-md-6">
                  <h3>Greffe de bras Robotique</h3>
                  <p style="text-align: left;">La greffe de bras robotisé représente une avancée spectaculaire dans le domaine de la médecine et de la technologie. Cette intervention innovante combine les principes de la chirurgie reconstructive et les technologies de pointe en robotique pour offrir une solution fonctionnelle aux patients ayant perdu un ou deux bras.<br>

                  Un bras robotisé est implanté chirurgicalement et relié aux nerfs et muscles restants du patient, permettant un contrôle précis et naturel des mouvements grâce à des interfaces neuronales et des algorithmes avancés. Les patients peuvent ainsi réaliser des gestes quotidiens avec une grande précision, améliorant beaucoup leur qualité de vie.<br>

                  Cette technologie est encore en phase de développement et de perfectionnement, mais elle offre déjà un aperçu prometteur de l'avenir des prothèses et des solutions de réhabilitation pour les amputés. Les défis demeurent, notamment en termes de miniaturisation des composants, de durabilité des matériaux et d'intégration harmonieuse avec le corps humain, mais les progrès rapides dans ce domaine laissent espérer des résultats de plus en plus impressionnants.
                  </p>
              </div>
              <div class="col-md-6">
                  <img src="Images/Blog2.jpg" class="img-responsive center-block" alt="Image 2">
              </div>
          </div>

          <!-- En mettre autant que necessaire pour reculer le footer -->
          <br>
      </div>

    <!-- Footer -->
    <footer class="text-center mt-4">
        <p>&copy; 2024 Medicare. Tous droits réservés.</p>
        <p>Adresse: 1234 Rue de la Santé, 75000 Paris, France</p>
    </footer>
</body>  
</html>
