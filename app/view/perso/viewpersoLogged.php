<?php include($root . 'app/view/fragment/fragmentHeader.php'); ?>
<body>
  <div class="container">
    <?php
    include($root . 'app/view/fragment/fragmentMenu.php');
    include($root . 'app/view/fragment/fragmentJumbotron.html');
    ?>

    <?php if (!empty($message)): ?>
      <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($message) ?>
      </div>
      <a class="btn btn-secondary" href="router1.php?action=persoLogin">Retour</a>
    <?php else: ?>
      <div class="alert alert-success" role="alert">
        ✅ Connexion réussie.
      </div>
      <p>
        Bienvenue <?= htmlspecialchars($_SESSION['login_prenom'] . ' ' . $_SESSION['login_nom']) ?>.<br>
        <a class="btn btn-primary mt-3" href="router1.php?action=projetAccueil">Aller à l'accueil</a>
      </p>
    <?php endif; ?>
  </div>

  <?php include($root . 'app/view/fragment/fragmentFooter.html'); ?>
</body>
</html>
