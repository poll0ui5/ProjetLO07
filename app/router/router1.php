<!-- ----- debut Router1 -->
<?php
session_start();
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

//check pour connecté
$connected = isset($_SESSION['login_id']) && $_SESSION['login_id'] != 0;
$role_responsable = $_SESSION['login_role_responsable'] ?? false;
$role_examinateur = $_SESSION['login_role_examinateur'] ?? false;
$role_etudiant = $_SESSION['login_role_etudiant'] ?? false;

switch ($action) {
    // Actions accessibles à tout le monde (connecté ou non)
    case "persoLogin":
    case "persoRegister":
    case "persoRegistered":
    case "persoLogged":
        ControllerPersonne::$action($args);
        break;
    //---------------------------------------------------------
    //PERSONNE

    case "persoLogout":
        if ($connected) {
            ControllerPersonne::$action($args);
        } else {
            header("Location: router1.php?action=projetAccueil");
            exit();
        }
        break;
    //---------------------------------------------------------
    //PROJET
    case "projetAccueil":
        ControllerProjet::$action($args);
        break;
    case "projetRespoList":
    case "projetCreate":
        if ($connected && $role_responsable) {
            ControllerProjet::$action($args);
        } else {
            header("Location: router1.php?action=projetAccueil");
            exit();
        }
        break;
    //---------------------------------------------------------
    //RDV
    case "rdvEtuList":
    case "rdvEtuBook":
        if ($connected && $role_etudiant) {
            ControllerRdv::$action($args);
        } else {
            header("Location: router1.php?action=projetAccueil");
            exit();
        }
        break;
}
?>