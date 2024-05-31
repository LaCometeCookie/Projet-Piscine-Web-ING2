<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medicare | Inscription</title>
    <link rel="stylesheet" href="inscription.css" />
    <!-- Dernier CSS compilé et minifié -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
    <!-- Bibliothèque jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
    <!-- Dernier JavaScript compilé -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
</head>
<body>
    <?php sleep(1); // Temps de pause pour l'action (petit plus réaliste) ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4">
            <h4 class="text-center">Veuillez renseigner les informations</h4>
            <form method="POST" action="traitement_inscription.php" name="form1">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="mail">Mail</label>
                    <input type="text" class="form-control" name="mail" required>
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" class="form-control" name="mdp" required>
                </div>
                <div class="form-group">
                    <label for="compte">Compte</label>
                    <select name="compte" id="compte" class="form-control" onchange="toggleClientFields()">
                        <option value="client">Client</option>
                        <option value="admin">Administrateur</option>
                    </select>
                </div>
                <div id="clientplus" style="display:none;">
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" name="adresse">
                    </div>
                    <div class="form-group">
                        <label for="vitale">Carte vitale</label>
                        <input type="number" class="form-control" name="vitale">
                    </div>
                    <div class="form-group">
                        <label for="paiement">Moyen de paiement</label>
                        <select name="paiement" id="paiement" class="form-control">
                            <option value="visa">Visa</option>
                            <option value="masterCard">MasterCard</option>
                            <option value="american">American Express</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" onclick="return window.confirm('Voulez-vous continuer ?')">S'inscrire</button>
                    <button type="reset" class="btn btn-secondary" onclick="return window.confirm('Êtes-vous sûr ?')">Réinitialiser</button>
                </div>
            </form>
            <form method="post" action="index.php" class="mt-3 text-center">
                <button type="submit" class="btn btn-link">Retour à l'accueil</button>
            </form>
        </div>
    </div>

    <script>
        function toggleClientFields() {
            var compte = document.getElementById('compte').value;
            var clientFields = document.getElementById('clientplus');
            if (compte === 'client') {
                clientFields.style.display = 'block';
            } else {
                clientFields.style.display = 'none';
            }
        }
        document.addEventListener('DOMContentLoaded', (event) => {
            toggleClientFields();
        });
    </script>
</body>
</html>
