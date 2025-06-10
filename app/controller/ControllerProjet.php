
<!-- ----- debut ControllerVin -->
<?php
require_once '../model/ModelProjet.php';

class ControllerProjet {

    // --- Liste des vins
    public static function projetAccueil() {
        include 'config.php';
        $vue = $root . '/app/view/viewprojetAccueil.php';
        require ($vue);
    }
    
    public static function projetLogin() {
        // ajouter une validation des informations du formulaire
        $results = ModelProjet::connect(
            htmlspecialchars($_POST['login']), htmlspecialchars($_POST['password'])
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/projet/viewprojetlogin.php';
        require ($vue);
       }
}
?>
<!-- ----- fin ControllerVin -->


