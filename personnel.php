<!DOCTYPE html>
<html>
<head>
<title>Medicare | Gestion Personnel</title>
    <meta charset="utf-8">
    <link href="traitement_inscription.css" rel="stylesheet" type="text/css" />  
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
    $choix = isset($_POST["choix"])? $_POST["choix"] : "";
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
        try // Test de connexion à la base de données (retorune une erreur en cas d'échec)
        {
            $bdd=new PDO('mysql:host=localhost;dbname=pj web 2024;charset=utf8', 'root', ''); //On y référence le nom d'utilisateur et le mot de passe, la base à utiliser et l'encodage
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage()); // En cas d'erreur de connexion, un message est affiché
        }
        if ($choix == "ajouter") // Ajout d'un personnel (les lignes utilisés ci-dessous sont extraits d'anciens codes réalisés en Terminale pour des projets similaires)
        {
            if(isset($_POST['mdp']))
            {
                if(preg_match("#^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$#",$_POST['mdp']))//Vérifie si le mot de passe respecte les conditions indiquées (ici dans l'ordre, lettre, caractère spécial puis chiffre)
                {
                    $reponse = $bdd->prepare('INSERT INTO medecins(Nom, Prenom, specialite, Mail, mdp, telephone, CV)
                    VALUES (:Nom, :Prenom, :specialite, :Mail, :mdp, :telephone, :CV)'); // Permet de préparer la table à accueillir de nouvelles données (on y référence tous les attributs sauf l'ID qui est automatique)
                    $reponse->execute(array(
                    'Nom' => $_POST['nom'],
                    'Prenom' => $_POST['prenom'],
                    'specialite' => $_POST['specialite'],
                    'Mail' => $_POST['mail'],
                    'mdp' => $_POST['mdp'],
                    'telephone' => $_POST['telephone'],
                    'CV' => $_POST['cv'],
                    )); //(Enfin, on ajoute toutes les valeurs non automatiques)
                    ?>
                    <h3>Un membre a été ajouté</h3>
                    <a href="profil.php">Retour au profil</a>
                    <?php
                }
                else
                {
                    ?>
                    <h4>Erreur de saisie du mot de passe</h4>
                    <br><a href="medecins.php">Retour</a>
                    <?php
                }
            }
        }
        else if ($choix == "supprimer")
        {
            // Cette fois, on cherche l'information à supprimer
            $my_query = $bdd->prepare('SELECT * FROM medecins WHERE Nom = :Nom AND Prenom = :Prenom');
            $my_query->execute(array(
                'Nom' => $_POST['nom'],
                'Prenom' => $_POST['prenom'],
                ));
                $data = $my_query->fetch();
            if(!(isset($data['Nom']))) // Si l'information à supprimer n'existe pas
            {
                ?><h2>Aucun employé correspond à la recherche&nbsp;</h2><?php
            }
            else if (isset($data['Nom']))
            {
                $reponse = $bdd->prepare('DELETE FROM medecins WHERE Nom = :Nom AND Prenom = :Prenom ');
                $reponse->execute(array(
                    'Nom' => $_POST['nom'],
                    'Prenom' => $_POST['prenom'],
            ));
            }
            ?>
            <h3>Un membre a été supprimé</h3>
            <a href="profil.php">Retour au profil</a>
            <?php
        }
    } 
    else
    {
        echo "Vous n'êtes pas connecté";
        ?><input type="text" name="compte" id="compte" value="<?php echo $compte;?>"><form method = "post" action = "index.php"><input type="submit" name= "accueil" value="accueil"></form><?php
    }  
    mysqli_close($db_handle); 
    ?>
</body>
</html>