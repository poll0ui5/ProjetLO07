
<!-- ----- debut ControllerVin -->
<?php
require_once '../model/ModelProjet.php';

class ControllerProjet {

    // --- Liste des vins
    public static function projetAccueil() {
        include 'config.php';
        $vue = $root . '/app/view/projetAccueil.php';
        require ($vue);
    }
    
    public static function ProjectLogin() {
        // ajouter une validation des informations du formulaire
        $results = ModelProjet::connect(
            htmlspecialchars($_POST['login']), htmlspecialchars($_POST['password'])
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/projet_login.php';
        require ($vue);
       }
}
?>
<!-- ----- fin ControllerVin -->


