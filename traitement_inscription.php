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
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien) 
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
if(isset($_POST['mdp']))
{
    if(preg_match("#^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$#",$_POST['mdp']))//Vérifie si le mot de passe respecte les conditions indiquées (ici dans l'ordre, lettre, caractère spécial puis chiffre)
    {
        if ($compte == "admin") // Ajout d'un livre (les lignes utilisés ci-dessous sont extraits d'anciens codes réalisés en Terminale pour des projets similaires)
        {
            $reponse = $bdd->prepare('INSERT INTO administrateur(Nom, Prenom, Mail, mdp) 
            VALUES (:Nom, :Prenom, :Mail, :mdp)'); // Permet de préparer la table à accueillir de nouvelles données (on y référence tous les attributs sauf l'ID qui est automatique)
            $reponse->execute(array(
            'Nom' => $_POST['nom'],
            'Prenom' => $_POST['prenom'],
            'Mail' => $_POST['mail'],
            'mdp' => $_POST['mdp'],
            )); //(Enfin, on ajoute toutes les valeurs non automatiques)
        }
        else if ($compte == "client")
        {
            $reponse = $bdd->prepare('INSERT INTO client(Nom, Prenom, Mail, mdp, Adresse, Paiement) 
            VALUES (:Nom, :Prenom, :Mail, :mdp, :Adresse, :Paiement)'); // Permet de préparer la table à accueillir de nouvelles données (on y référence tous les attributs sauf l'ID qui est automatique)
            $reponse->execute(array(
            'Nom' => $_POST['nom'],
            'Prenom' => $_POST['prenom'],
            'Mail' => $_POST['mail'],
            'mdp' => $_POST['mdp'],
            'Adresse' => $_POST['adresse'],
            'Paiement' => $_POST['paiement'],
            )); //(Enfin, on ajoute toutes les valeurs non automatiques)
        }
        ?>
        <h3>Votre compte a été créé</h3>
        <a href="index.php">Retour à l'accueil</a>
        <?php
    }
    else
    {
        ?>
        <h4>Erreur de saisie du mot de passe</h4>
        <br><a href="inscription.html">Retour</a>
        <?php
    }
}    
mysqli_close($db_handle); 
?>
</body>
</html>