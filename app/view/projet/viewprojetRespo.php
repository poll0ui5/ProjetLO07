<?php include ($root . 'app/view/fragment/fragmentHeader.php'); ?>

<body>
  <div class="container">
    <?php
      include ($root . 'app/view/fragment/fragmentMenu.php');
      include ($root . 'app/view/fragment/fragmentJumbotron.html');
    ?>

    <h3>Liste des projets dont vous êtes responsable</h3>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th scope="col">Label</th>
            <th scope="col">Responsable</th>
            <th scope="col">Groupe</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($results)): ?>
            <?php foreach ($results as $projet): ?>
              <tr>
                <td><?= htmlspecialchars($projet->getLabel()) ?></td>
                <td><?= htmlspecialchars($projet->getResponsable()) ?></td>
                <td><?= htmlspecialchars($projet->getGroupe()) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3">Aucun projet trouvé pour ce responsable.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php include ($root . 'app/view/fragment/fragmentFooter.html'); ?>
</body>
</html>
