<!--Création d'un compte (uniquement client ou admin)-->
<!DOCTYPE html>
<html>
<head>
    <title>Medicare | Inscription</title>
    <meta charset="utf-8">
    <link href="traitement_inscription.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
//identifier le nom de base de données
$database = "pj web 2024";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de passe = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
$compte = isset($_POST["compte"])? $_POST["compte"] : "";
try // Test de connexion à la base de données (retorune une erreur en cas d'échec)
{
    $bdd=new PDO('mysql:host=localhost;dbname=pj web 2024;charset=utf8', 'root', ''); //On y référence le nom d'utilisateur et le mot de passe, la base à utiliser et l'encodage
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage()); // En cas d'erreur de connexion, un message est affiché
}

// Vérifier si les données POST existent
if (isset($_POST['date'], $_POST['time'], $_POST['type'], $_POST['id'])) {
    // Connexion à la base de données
    $reponse = $bdd->prepare('INSERT INTO rdv(Date, Patient, Docteur) 
            VALUES (:Date, :Patient, :Docteur)'); // Permet de préparer la table à accueillir de nouvelles données (on y référence tous les attributs sauf l'ID qui est automatique)
    $reponse->execute(array(
        'Date' => $_POST['Date'],
        'Patient' => $_POST['Patient'],
        'Docteur' => $_POST['Docteur'],
    )); //(Enfin, on ajoute toutes les valeurs non automatiques)
}
mysqli_close($db_handle);
?>
</body>
</html>
