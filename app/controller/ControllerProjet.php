
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

    public static function projetInnovationsValo() {
        include 'config.php';
        $vue = $root . '/app/view/innovation/viewValo.php';
        require ($vue);
    }

    public static function projetInnovationsAmelio() {
        include 'config.php';
        $vue = $root . '/app/view/innovation/viewAmelio.php';
        require ($vue);
    }

    public static function projetRespoList() {
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
        $responsable = htmlspecialchars($_POST['responsable']);
        $label = htmlspecialchars($_POST['label']);
        $groupe = htmlspecialchars($_POST['groupe']);

        $id = ModelProjet::insert($label, $responsable, $groupe);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/projet/viewprojetInserted.php';
        require ($vue);
    }

    public static function projetExamList() {
        // Récupérer l’ID de l’examinateur connecté
        $examinateur_id = $_SESSION['login_id'];

        // Charger les projets via le modèle
        $results = ModelProjet::getProjetsByExaminateur($examinateur_id);

        // Affichage
        include 'config.php';
        $vue = $root . '/app/view/projet/viewUni.php';
        require($vue);
    }

    public static function projetSelectExam() {
        $responsable_id = $_SESSION['login_id'];
        // On récupère ses projets
        $projets = ModelProjet::getProjetsByResponsable($responsable_id);
        include 'config.php';
        $vue = $root . '/app/view/projet/viewSelectProjetExam.php';
        require($vue);
    }

    /**
     * Après soumission, liste les examinateurs liés au projet sélectionné.
     */
    public static function projetAvecExamList() {
        $responsable_id = $_SESSION['login_id'];
        $projet_id = isset($_POST['projet_id']) ? (int) $_POST['projet_id'] : null;

        if (!$projet_id) {
            header("Location: router1.php?action=selectProjetExam&error=1");
            exit();
        }

        $examinateurs = ModelProjet::getExaminateursByProjet($projet_id);

        include 'config.php';
        $vue = $root . '/app/view/projet/viewListExaminateurs.php';
        require($vue);
    }

    public static function projetSelectPlanning() {
        $responsable_id = $_SESSION['login_id'];
        $projets = ModelProjet::getProjetsByResponsable($responsable_id);
        include 'config.php';
        $vue = $root . '/app/view/projet/viewSelectProjetPlanning.php';
        require($vue);
    }
    public static function projetPlanning() {
        $projet_id = isset($_POST['projet_id']) ? (int)$_POST['projet_id'] : null;
        if (!$projet_id) {
            header("Location: router1.php?action=selectProjetPlanning&error=1");
            exit();
        }

        $results = ModelProjet::getPlanningByProjet($projet_id);
        include 'config.php';
        $vue = $root . '/app/view/projet/viewUni.php';
        require($vue);
    }
}
?>
<!-- ----- fin ControllerVin -->


