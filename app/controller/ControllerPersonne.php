
<!-- ----- debut ControllerVin -->
<?php
require_once '../model/ModelPersonne.php';

class ControllerPersonne {

    public static function persoLogin() {
        include 'config.php';
        if (isset($_GET['error'])){
           $error=$_GET['error']; 
        }
        
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
        if (!empty($_POST['login'])) {
            if (isset($_POST['login']) && isset($_POST['password'])) {
                $results = ModelPersonne::connect(
                        htmlspecialchars($_POST['login']),
                        htmlspecialchars($_POST['password'])
                );

                if (!empty($results)) {
                    $user = $results[0];
                    // Stocker les infos dans la session
                    $_SESSION['login_id'] = $user->getId();
                    $_SESSION['login_nom'] = $user->getNom();
                    $_SESSION['login_prenom'] = $user->getPrenom();
                    $_SESSION['login_role_responsable'] = $user->getRole_responsable();
                    $_SESSION['login_role_examinateur'] = $user->getRole_examinateur();
                    $_SESSION['login_role_etudiant'] = $user->getRole_etudiant();
                    $_SESSION['login_user'] = $user->getLogin();
                    $_SESSION['password_user'] = $user->getPassword();
                    $_SESSION['connected'] = '1';
                } else {
                    // Si erreur, on remet à zéro
                    $_SESSION['login_id'] = 0;
                    $_SESSION['login_nom'] = '';
                    $_SESSION['login_prenom'] = '';
                    header("Location: router1.php?action=persoLogin&error=1");
                    exit();
                }
            }
            include 'config.php';
            $vue = $root . '/app/view/perso/viewpersoLogged.php'; // Vue de confirmation de login
            require($vue);
        } 
    }

    public static function persoLogout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // On vide et on détruit
        session_unset();
        session_destroy();

        // Redirection : la nouvelle session sera démarrée par ton routeur
        header('Location: router1.php?action=projetAccueil&logout=1');
        exit();
    }

    public static function persoRegister() {
        include 'config.php';
        $vue = $root . '/app/view/perso/viewpersoRegister.php'; // le formulaire
        require($vue);
    }

    public static function persoRegistered() {
// Récupération des données du formulaire avec vérification
        if (!empty($_POST['login_user'])) {
            // L'utilisateur a bien rempli le champ "login_user" => on continue

            $role_responsable = isset($_POST['role_responsable']) ? 1 : 0;
            $role_examinateur = isset($_POST['role_examinateur']) ? 1 : 0;
            $role_etudiant = isset($_POST['role_etudiant']) ? 1 : 0;
            $nom = htmlspecialchars($_POST['nom'] ?? '');
            $prenom = htmlspecialchars($_POST['prenom'] ?? '');
            $login_user = htmlspecialchars($_POST['login_user']);
            $password_user = htmlspecialchars($_POST['password_user'] ?? '');

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
            $vue = $root . '/app/view/perso/viewpersoRegistered.php';
            require($vue);
        } else {
            // login_user est vide => on redirige
            header("Location: router1.php?action=projetAccueil");
            exit();
        }
    }

    public static function listExaminateur() {
        $results = ModelPersonne::getAllExam();
        include 'config.php';
        $vue = $root . '/app/view/perso/viewpersoExam.php';
        require($vue);
    }

    public static function AddExaminateur() {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/perso/viewpersoAddExam.php';
        require ($vue);
    }

    public static function ExaminateurAdded() {
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $role_examinateur = 1;
        $role_etudiant = 0;
        $role_responsable = 0;

        $results = ModelPersonne::insertExam($prenom, $nom, $role_examinateur, $role_etudiant, $role_responsable);
        include 'config.php';
        $vue = $root . '/app/view/perso/viewpersoExamAdded.php';
        require ($vue);
    }
}
?>