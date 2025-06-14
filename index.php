<?php
session_start();
$_SESSION['login_user']=0;
$_SESSION['utilisateur_user']="?";


header('Location: app/router/router1.php?action=projetAccueil');
//nouvelle version
//aok

?>

