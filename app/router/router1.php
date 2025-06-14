<!-- ----- debut Router1 -->
<?php

echo 'Current dir: ' . __DIR__;
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require ('../controller/ControllerCreneau.php');
require ('../controller/ControllerPersonne.php');
require ('../controller/ControllerProjet.php');
require ('../controller/ControllerRdv.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = isset($param["action"]) ? htmlspecialchars($param["action"]) : '';

// Remove action from parameters to create args array
unset($param['action']);
$args = $param;


switch ($action) {
 case "persoLogin" :
 case "persoLogged" :
 case "persoRegister" :
 case "persoRegistered" :
 case "persoLogout" :
  ControllerPersonne::$action($args);
  break;
}


switch ($action) {
 case "projetAccueil" :
 case "projetLogin" :
  ControllerProjet::$action($args);
  break;
}


?>