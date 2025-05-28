
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
}
?>
<!-- ----- fin ControllerVin -->


