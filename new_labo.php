<!--Ajout/modification des infos des labos (uniquement pour l'admin)-->
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
        if(empty($_POST['service']))
        {
            echo "<p class ='reponses'>Vous n'avez rentré aucun service </p>";
        }
        else
        {
            for ($indice = 0; $indice < 3; $indice++) //Comme il existe plusieurs services (ici 3), on utilise des indices pour les différencier
            {
                
                $_POST['service'][$indice] . '<br />';
            }
        }
        if ($choix == "ajout") // Ajout d'un laboratoire (les lignes utilisés ci-dessous sont extraits d'anciens codes réalisés en Terminale pour des projets similaires)
        {
            if($indice == 3)
            {
            $reponse = $bdd->prepare('INSERT INTO labos(Nom, Adresse, Salle, telephone, Mail, Service1, Service2, Service3)
                VALUES (:Nom, :Adresse, :Salle, :telephone, :Mail, :Service1, :Service2, :Service3)');
            $reponse->execute(array(
                'Nom' => $_POST['nom'],
                'Adresse' => $_POST['adresse'],
                'Salle' => $_POST['salle'],
                'telephone' => $_POST['telephone'],
                'Mail' => $_POST['mail'],
                'Service1' => $_POST['service'][0],
                'Service2' => $_POST['service'][1],
                'Service3' => $_POST['service'][2],
            ));
            ?>
            <h3>Un laboratoire a été ajouté</h3>
            <a href="profil.php">Retour au profil</a>
            <?php
            }	
            elseif($indice > 3 OR $indice < 2)	
            {
                echo "Vous avez choisi plus ou moins de 2 spécialités";
                ?><a href="profil.php">Retour au profil</a><?php
            }
        }
        /*else if ($choix == "supprimer")
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
        }*/
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