<?php
require_once $root . '/app/view/fragment/fragmentHeader.php';
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <div class="panel panel-success mt-4">
      <div class="panel-heading">
        <h3 class="panel-title">Confirmation de l'ajout d'un projet</h3>
      </div>
      <div class="panel-body">
        <p><strong>Le projet a été ajouté avec succès dans la base de données.</strong></p>
        <ul>
          <li><strong>ID :</strong> <?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?></li>
          <li><strong>Label :</strong> <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></li>
          <li><strong>Groupe :</strong> <?= htmlspecialchars($groupe, ENT_QUOTES, 'UTF-8') ?></li>
          <li><strong>ID du Responsable :</strong> <?= htmlspecialchars($responsable, ENT_QUOTES, 'UTF-8') ?></li>
        </ul>
        <a href="router1.php?action=projetAccueil" class="btn btn-secondary">Retour à l'accueil</a>
      </div>
    </div>
  </div>

  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>
</html>
