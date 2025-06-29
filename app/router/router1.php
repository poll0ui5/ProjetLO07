<!-- ----- debut Router1 -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Si on vient de logout et qu'aucune variable de session n'est encore définie
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $_SESSION['login_user'] = 0;
    $_SESSION['utilisateur_user'] = "?";
    $_SESSION['connected'] = 0;
}
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
    // Actions publiques accessibles à tout le monde
    case "persoLogin":
    case "persoLogout":
    case "persoLogged":
    case "projetInnovationsValo":
    case "projetInnovationsAmelio":
    case "persoRegister":
    case "persoRegistered":
        ControllerPersonne::$action($args);
        break;
    case "projetInnovationsValo":
    case "projetInnovationsAmelio":
    case "projetAccueil":
        ControllerProjet::$action($args);
        break;

    // Actions examinateur
    case "listExaminateur":
    case "AddExaminateur":
    case "ExaminateurAdded":
        if ($connected && $role_examinateur) {
            ControllerPersonne::$action($args);
        } else {
            header("Location: router1.php?action=projetAccueil");
            exit();
        }
        break;

    // Actions responsable
    case "projetRespoList":
    case "projetCreate":
    case "projetCreated":
    case "projetSelectExam":
    case "projetAvecExamList":
    case "projetSelectPlanning":
    case "projetPlanning":
        if ($connected && $role_responsable) {
            ControllerProjet::$action($args);
        } else {
            header("Location: router1.php?action=projetAccueil");
            exit();
        }
        break;
    case "projetExamList":
        if ($connected && $role_examinateur) {
            ControllerProjet::$action($args);
        } else {
            header("Location: router1.php?action=projetAccueil");
            exit();
        }
        break;
        

    // Actions étudiant
    case "rdvEtuList":
    case "rdvEtuBook":
    case "rdvEtuBookWrite":
        if ($connected && $role_etudiant) {
            ControllerRdv::$action($args);
        } else {
            header("Location: router1.php?action=projetAccueil");
            exit();
        }
        break;

    case "creneauxExamList":
    case "creneauSelectProjet":
    case "creneauListByProjet":
    case "creneauAdd":
    case "creneauAddSubmit":
    case "creneauAddConsec":
    case "creneauAddConsecSubmit":
        if ($connected && $role_examinateur) {
            ControllerCreneau::$action($args);
        } else {
            header("Location: router1.php?action=projetAccueil");
            exit();
        }
        break;

    // Cas par défaut
    default:
        header("Location: router1.php?action=projetAccueil");
        exit();
}
?>