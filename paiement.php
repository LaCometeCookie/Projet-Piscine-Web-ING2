<!--Paiement d'un service (uniquement pour le client)-->
<!DOCTYPE html> 
<html> 
<head> 
  <meta charset="utf-8">
  <title>Medicare | Paiement</title>
  <link href="piaement.css" rel="stylesheet" type="text/css" />  
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
    <?php
    mysqli_close($db_handle); 
    ?> 
    <!--required permet de bloquer l'envoi si des champs ne sont pas remplis-->
    <form action="recu.php" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="nom" class="col-sm-2 control-label">Nom</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
            </div>
            <div class="form-group">
                <label for="prenom" class="col-sm-2 control-label">Prénom</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>
            </div>
            <div class="form-group">
                <label for="pays" class="col-sm-2 control-label">Pays</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="pays" name="pays" required>
                </div>
            </div>
            <div class="form-group">
                <label for="mail" class="col-sm-2 control-label">Mail</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="mail" name="mail" required>
                </div>
            </div>
            <div class="form-group">
                <label for="telephone" class="col-sm-2 control-label">Téléphone</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="telephone" name="telephone" required>
                </div>
            </div>
            <div class="form-group">
                <label for="vitale" class="col-sm-2 control-label">Carte Vitale</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="vitale" name="vitale" required title="Saisissez les 15 chiffres de votre carte vitale">
                </div>
            </div>
            <div class="form-group">
                <label for="carte" class="col-sm-2 control-label">Moyen de paiement</label>
                <div class="col-sm-9">
                    <select name="carte" id="carte" class="form-control">
                        <optgroup label="Carte">
                            <option value="visa" id='carte'>Visa</option>
                            <option value="masterCard" id='carte'>MasterCard</option>
                            <option value="american" id='carte'>American Express</option>
                            <option value="paypal" id='carte'>PayPal</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="numcarte" class="col-sm-2 control-label">Numéro de la carte</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="numcarte" name="numcarte" required>
                </div>
            </div>
            <div class="form-group">
                <label for="datecarte" class="col-sm-2 control-label">Date d'expiration</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="datecarte" name="datecarte" required title="en mm/aa">
                </div>
            </div>
            <div class="form-group">
                <label for="cvv" class="col-sm-2 control-label">CVV</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="cvv" name="cvv" required title="Saisissez les chiffres de sécurité inscrits au dos de votre carte (3 ou 4)">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                    <button type="submit" class="btn btn-primary" onclick="return window.confirm('Voulez-vous continuer ?')">Valider les informations</button>
                    <button type="reset" class="btn btn-warning" onclick="return window.confirm('Êtes-vous sûr ?')">Réinitialiser</button>
                </div>
            </div>
        </form>
</body> 
</html> 