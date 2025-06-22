
<?php

require_once '../model/ModelProjet.php';
require_once '../model/ModelRdv.php';

class ControllerRdv {

    public static function rdvEtuList() {
        $etu_id = $_SESSION['login_id'];
        $results = ModelRdv::getRdvEtu($etu_id);
        include 'config.php';
        $vue = $root . '/app/view/rdv/viewUni.php';
        require ($vue);
    }

    public static function rdvEtuBook() {
        $results = ModelRdv::getCreneauxDisponibles();

        include 'config.php';
        $vue = $root . '/app/view/rdv/viewEtuBook.php';
        require($vue);
    }

    public static function rdvEtuBookWrite() {
        $creneau_id = $_POST['creneau_id'] ?? null;
        $etudiant_id = $_SESSION['login_id'] ?? null;

        if (!$creneau_id || !$etudiant_id) {
            header("Location: router1.php?action=rdvEtuBook&error=1");
            exit();
        }

        $success = ModelRdv::insertRdv($creneau_id, $etudiant_id);

        if ($success) {
            header("Location: router1.php?action=rdvEtuList&success=1");
        } else {
            header("Location: router1.php?action=rdvEtuBook&error=1");
        }
        exit();
    }
}
?>


