
<!-- ----- debut ControllerVin -->
<?php
require_once '../model/ModelProjet.php';
require_once '../model/ModelPersonne.php';

class ControllerProjet {

    // --- Liste des vins
    public static function projetAccueil() {
        include 'config.php';
        $vue = $root . '/app/view/viewprojetAccueil.php';
        require ($vue);
    }
    
    public static function ResponsableProjetList() {
        // ajouter une validation des informations du formulaire
        $respo_id = $_SESSION['login_id'];
        $results = ModelProjet::getProjetResponsable($respo_id);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/projet/viewprojetRespo.php';
        require ($vue);
    }
    
    public static function projetCreate() {
        // ----- Construction chemin de la vue
        $results = ModelPersonne::getAllResponsable();
        include 'config.php';
        $vue = $root . '/app/view/projet/viewprojetInsert.php';
        require ($vue);
    }
    
    public static function projetCreated() {
        // ajouter une validation des informations du formulaire
        $results = ModelProjet::insert(
                htmlspecialchars($_POST['responsable']), htmlspecialchars($_POST['label']), htmlspecialchars($_POST['groupe'])
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/prod/viewprojetInserted.php';
        require ($vue);
    }
}
?>
<!-- ----- fin ControllerVin -->


