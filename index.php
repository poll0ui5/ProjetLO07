<?php
session_start();
$_SESSION['login_id']=0;
$_SESSION['utilisateur']="?";

header('Location: app/router/router1.php?action=projetAccueil');
//nouvelle version
//aok

?>

