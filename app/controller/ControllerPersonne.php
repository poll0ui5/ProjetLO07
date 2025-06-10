
<!-- ----- debut ControllerVin -->
<?php
require_once '../model/ModelPersonne.php';

class ControllerPersonne {

    public static function persoLogin() {
        include 'config.php';
        $vue = $root . '/app/view/perso/viewpersoLogin.php'; // le formulaire
        // traitement du POST uniquement si les champs existent
        if (isset($_POST['login_user']) && isset($_POST['password_user'])) {
            $results = ModelPersonne::connect(
                    htmlspecialchars($_POST['login_user']),
                    htmlspecialchars($_POST['password_user'])
            );

            // tu peux rediriger ou afficher une vue de résultat ici
        }

        require($vue);
    }

    public static function persoLogged() {
        include 'config.php';
        $vue = $root . '/app/view/perso/viewpersoLogged.php'; // le formulaire
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

    public static function persoRegister() {
        include 'config.php';
        $vue = $root . '/app/view/perso/viewpersoRegister.php'; // le formulaire
        require($vue);
    }

    public static function persoRegistered() {
// Récupération des données du formulaire avec vérification
        $role_responsable = isset($_POST['role_responsable']) ? 1 : 0;
        $role_examinateur = isset($_POST['role_examinateur']) ? 1 : 0;
        $role_etudiant = isset($_POST['role_etudiant']) ? 1 : 0;
        $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
        $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '';
        $login_user = isset($_POST['login_user']) ? htmlspecialchars($_POST['login_user']) : '';
        $password_user = isset($_POST['password_user']) ? htmlspecialchars($_POST['password_user']) : '';

        $results = ModelPersonne::insert(
                $role_responsable,
                $role_examinateur,
                $role_etudiant,
                $nom,
                $prenom,
                $login_user,
                $password_user
        );

        include 'config.php';
        $vue = $root . '/app/view/perso/viewpersoRegistered.php'; // le formulaire
        require($vue);
    }
}
?>

