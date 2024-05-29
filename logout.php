<?php
//Fichier supplémentaire qui permet d'arrêter une session ouverte par un utilisateur
session_start();
session_unset();
session_destroy();
header('Location: index.php');
exit();
?>