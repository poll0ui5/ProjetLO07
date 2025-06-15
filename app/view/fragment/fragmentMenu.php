<?php


$connected = isset($_SESSION['login_id']) && $_SESSION['login_id'] != 0;

$nomAffiche = "";
if ($connected && isset($_SESSION['login_nom']) && isset($_SESSION['login_prenom'])) {
    $nomAffiche = strtoupper($_SESSION['login_nom']) . " " . ucfirst(strtolower($_SESSION['login_prenom']));
}

// Initialisation des rôles
$role_responsable = $_SESSION['login_role_responsable'] ?? false;
$role_examinateur = $_SESSION['login_role_examinateur'] ?? false;
$role_etudiant = $_SESSION['login_role_etudiant'] ?? false;
?>

<nav class="navbar navbar-expand-lg bg-danger fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="router1.php?action=projetAccueil">
            LEDOUX - BROWN<?= $connected ? " | " . htmlspecialchars($nomAffiche) : "" ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php if ($connected && $role_responsable): ?>
                    <!-- Menu Responsable -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Responsable</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="router1.php?action=projetRespoList">Liste de mes projets</a></li>
                            <li><a class="dropdown-item" href="router1.php?action=projetCreate">Ajout d'un projet</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="router1.php?action=">Liste des examinateurs</a></li>
                            <li><a class="dropdown-item" href="router1.php?action=ResponsableCreneaux">Ajout d'un examinateur</a></li>
                            <li><a class="dropdown-item" href="router1.php?action=ResponsableCreneaux">Liste des examinateurs d'un projet</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="router1.php?action=ResponsableCreneaux">Planning d'un projet</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ($connected && ($role_examinateur || $role_responsable)): ?>
                    <!-- Menu Examinateur -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Examinateur</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="router1.php?action=ExaminateurMesCreneaux">Mes créneaux</a></li>
                            <li><a class="dropdown-item" href="router1.php?action=ExaminateurNotes">Notes</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if ($connected && $role_etudiant): ?>
                    <!-- Menu Étudiant -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Etudiant</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="router1.php?action=rdvEtuList">Liste de mes rendez-vous</a></li>
                            <li><a class="dropdown-item" href="router1.php?action=rdvEtuBook">Prendre rdv pour un projet</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Menu Innovations (toujours visible) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Innovations</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="router1.php?action=InnovationListe">Utilisation des données stockées</a></li>
                        <li><a class="dropdown-item" href="router1.php?action=InnovationAjout">Amélioration du code MVC</a></li>
                    </ul>
                </li>

                <!-- Menu Compte (toujours visible) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Compte</a>
                    <ul class="dropdown-menu">
                        <?php if (!$connected): ?>
                            <li><a class="dropdown-item" href="router1.php?action=persoLogin">Connexion</a></li>
                            <li><a class="dropdown-item" href="router1.php?action=persoRegister">Inscription</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="router1.php?action=persoLogout">Déconnexion</a></li>
                        <?php endif; ?>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
