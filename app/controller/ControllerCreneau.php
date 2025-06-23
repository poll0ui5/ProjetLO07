<?php

require_once '../model/ModelCreneau.php';

class ControllerCreneau {

    public static function creneauxExamList() {
        // Récupère l'ID de l'examinateur connecté
        $examinateur_id = $_SESSION['login_id'];

        // Va chercher tous ses créneaux
        $results = ModelCreneau::getCreneauxByExaminateur($examinateur_id);

        // Charge la vue
        include 'config.php';
        $vue = $root . '/app/view/creneau/viewUni.php';
        require($vue);
    }

    public static function creneauSelectProjet() {
        $examinateur_id = $_SESSION['login_id'];
        $projets = ModelCreneau::getProjetsByExaminateur($examinateur_id);

        include 'config.php';
        $vue = $root . '/app/view/creneau/viewSelectProjet.php';
        require($vue);
    }

    public static function creneauListByProjet() {
        $examinateur_id = $_SESSION['login_id'];
        $projet_id = isset($_POST['projet_id']) ? (int) $_POST['projet_id'] : null;
        if (!$projet_id) {
            header("Location: router1.php?action=selectProjet&error=1");
            exit();
        }

        $creneaux = ModelCreneau::getCreneauxByProjetAndExaminateur($projet_id, $examinateur_id);
        $results = $creneaux;
        include 'config.php';
        $vue = $root . '/app/view/creneau/viewUni.php';
        require($vue);
    }

    public static function creneauAdd() {
        $examinateur_id = $_SESSION['login_id'];
        $projets = ModelCreneau::getAllProjets();
        include 'config.php';
        $vue = $root . '/app/view/creneau/viewAddCreneau.php';
        require($vue);
    }

    public static function creneauAddSubmit() {
        $projet_id = $_POST['projet_id'] ?? null;
        $creneau_datetime = $_POST['creneau_datetime'] ?? null;
        $examinateur_id = $_SESSION['login_id'];

        if (!$projet_id || !$creneau_datetime) {
            header("Location: router1.php?action=addCreneauForm&error=1");
            exit();
        }

        $success = ModelCreneau::insertCreneau($projet_id, $examinateur_id, $creneau_datetime);

        if ($success) {
            header("Location: router1.php?action=creneauxExamList&success=1");
        } else {
            header("Location: router1.php?action=addCreneauForm&error=1");
        }
        exit();
    }

    public static function creneauAddConsec() {
        $projets = ModelCreneau::getAllProjets();
        include 'config.php';
        $vue = $root . '/app/view/creneau/viewAddMultipleCreneaux.php';
        require($vue);
    }

    /**
     * Traitement du formulaire de création de série de créneaux.
     */
    public static function creneauAddConsecSubmit() {
        $projet_id = $_POST['projet_id'] ?? null;
        $start_datetime = $_POST['start_datetime'] ?? null;
        $count = (int) ($_POST['count'] ?? 0);
        $examinateur_id = $_SESSION['login_id'];

        if (!$projet_id || !$start_datetime || $count < 1 || $count > 10) {
            header("Location: router1.php?action=addMultipleForm&error=1");
            exit();
        }

        $success = ModelCreneau::insertMultipleCreneaux(
                $projet_id, $examinateur_id, $start_datetime . ':00', $count
        );

        if ($success) {
            header("Location: router1.php?action=creneauxExamList&success=1");
        } else {
            header("Location: router1.php?action=addMultipleForm&error=2");
        }
        exit();
    }
}
