
<!-- ----- debut ControllerVin -->
<?php
require_once '../model/ModelProjet.php';
require_once '../model/ModelRdv.php';

class ControllerRdv {

    // --- Liste des vins
    public static function rdvEtuList() {
        $etu_id = $_SESSION['login_id'];
        $results = ModelRdv::getRdvEtu($etu_id);
        include 'config.php';
        $vue = $root . '/app/view/rdv/viewUni.php';
        require ($vue);
    }
    
    public static function rdvEtuBook() {
    $projet_id = $_GET['projet_id'] ?? null;
    $creneaux = ModelRdv::getCreneauxDispo($projet_id);
    include 'config.php';
    $vue = $root . '/app/view/rdv/viewRdvForm.php';
    require ($vue);
}

    
}
?>
<!-- ----- fin ControllerVin -->


