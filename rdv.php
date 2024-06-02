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
sleep(1); //Temps de pause pour l'action (petit plus réaliste)

// Connexion à la base de données
$database = "pj web 2024";
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);

// Vérification de la connexion de l'utilisateur
if (isset($_SESSION['ID_session']) && isset($_SESSION['ID'])) {
    $donnees['ID'] = $_SESSION['ID'];
    $donnees['Nom'] = $_SESSION['Nom'];
    $donnees['Prenom'] = $_SESSION['Prenom'];
    $donnees['compte'] = $_SESSION['compte'];
    $ok = TRUE;
} else {
    $ok = FALSE;
}

// Chargement des entités depuis la base de données
$medecins = [];
$labos = [];
if ($db_found) {
    $result = mysqli_query($db_handle, 'SELECT ID, Nom, Prenom FROM medecins ORDER BY Nom');
    while ($row = mysqli_fetch_assoc($result)) {
        $medecins[] = $row;
    }

    $result = mysqli_query($db_handle, 'SELECT ID, Nom FROM labos ORDER BY Nom');
    while ($row = mysqli_fetch_assoc($result)) {
        $labos[] = $row;
    }
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
        <br>
        <label for="choix">Votre demande de RDV</label>
        <select class="form-control" name="choix" id="choix" onchange="toggleSections()">
            <option value="">Sélectionnez</option>
            <option value="medecin">Médecin</option>
            <option value="labo">Laboratoire</option>
        </select>
    </div>

    <div id="medecin" class="section-hidden">
        <h3>Liste des médecins</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($medecins as $medecin): ?>
                <tr>
                    <td><?php echo htmlspecialchars($medecin['Nom']); ?></td>
                    <td><?php echo htmlspecialchars($medecin['Prenom']); ?></td>
                    <td><a href="prendre_rdv.php?type=medecin&id=<?php echo $medecin['ID']; ?>" class="btn btn-primary">Prendre rendez-vous</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="labo" class="section-hidden">
        <h3>Liste des laboratoires</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($labos as $labo): ?>
                <tr>
                    <td><?php echo htmlspecialchars($labo['Nom']); ?></td>
                    <td><a href="prendre_rdv.php?type=labo&id=<?php echo $labo['ID']; ?>" class="btn btn-primary">Prendre rendez-vous</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleSections() {
        var choix = document.getElementById('choix').value;
        document.getElementById('medecin').style.display = (choix === 'medecin') ? 'block' : 'none';
        document.getElementById('labo').style.display = (choix === 'labo') ? 'block' : 'none';
    }
</script>

<!-- Footer -->
<br>
<br>
<footer class="text-center mt-4">
    <p>&copy; 2024 Medicare. Tous droits réservés.</p>
    <p>Adresse: 1234 Rue de la Santé, 75000 Paris, France</p>
    <p>Mail: medicare@ece.fr</p>
</footer>

<?php
mysqli_close($db_handle);
?>
</body>
</html>
