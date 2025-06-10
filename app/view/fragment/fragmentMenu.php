<?php
$connected = isset($_SESSION['login_id']) && $_SESSION['login_id'] != 0;

// Récupère les infos du user s'il est connecté
$nomAffiche = "";
if ($connected) {
    require_once 'config/Connexion.php'; // adapter le chemin si besoin
    $pdo = Connexion::getInstance();
    $query = "SELECT nom, prenom FROM personne WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->execute([':id' => $_SESSION['login_id']]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $nomAffiche = strtoupper($user['nom']) . " " . ucfirst(strtolower($user['prenom']));
    }
}
?>

<nav class="navbar navbar-expand-lg bg-danger fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="router1.php?action=projetAccueil">LEDOUX - BROWN | <?= htmlspecialchars($nomAffiche) ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <?php if ($connected): ?>
        <!-- Menu Étudiants : visible uniquement si connecté -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Étudiants</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router1.php?action=EtudiantReadAll">Liste des étudiants</a></li>
            <li><a class="dropdown-item" href="router1.php?action=EtudiantCreate">Ajouter un étudiant</a></li>
          </ul>
        </li>
        <?php endif; ?>

        <!-- Menu Innovations : toujours visible -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Innovations</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router1.php?action=InnovationListe">Liste des innovations</a></li>
            <li><a class="dropdown-item" href="router1.php?action=InnovationAjout">Ajouter une innovation</a></li>
          </ul>
        </li>

        <!-- Menu Connexion : toujours visible -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Se connecter</a>
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