<?php
//Fichier supplémentaire qui permet d'arrêter une session ouverte par un utilisateur
session_start();
session_unset();
session_destroy();
sleep(1);//Temps de pause pour l'action (petit plus réaliste)
header('Location: index.php');
exit();
?>