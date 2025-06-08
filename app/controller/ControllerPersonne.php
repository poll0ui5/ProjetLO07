
<!-- ----- debut ControllerVin -->
<?php
require_once '../model/ModelPersonne.php';

class ControllerPersonne{

    public static function ProjectLogin() {
    include 'config.php';
    $vue = $root . '/app/view/projet_login.php'; // le formulaire

    // traitement du POST uniquement si les champs existent
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $results = ModelPersonne::connect(
            htmlspecialchars($_POST['login']),
            htmlspecialchars($_POST['password'])
        );

        // tu peux rediriger ou afficher une vue de résultat ici
    }

    require($vue);
}

}
?>

