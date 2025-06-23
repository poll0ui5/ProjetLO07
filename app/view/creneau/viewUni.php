<!-- ----- début viewAll Universelle -->
<?php include ($root . 'app/view/fragment/fragmentHeader.php'); ?>

<body>
  <div class="container mt-4">
    <?php
    include ($root . 'app/view/fragment/fragmentMenu.php');
    include ($root . 'app/view/fragment/fragmentJumbotron.html');
    ?>

    <h3 class="mb-4">Créneaux de l'examinateur:</h3>

    <?php if (!empty($results)) : ?>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="table-primary">
            <tr>
              <?php
              // Afficher les noms de colonnes dynamiquement à partir du premier élément
              $firstRow = $results[0];
              if (is_object($firstRow)) {
                  foreach (get_object_vars($firstRow) as $key => $value) {
                      echo "<th scope='col'>" . htmlspecialchars($key) . "</th>";
                  }
              } elseif (is_array($firstRow)) {
                  foreach ($firstRow as $key => $value) {
                      echo "<th scope='col'>" . htmlspecialchars($key) . "</th>";
                  }
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($results as $row) : ?>
              <tr>
                <?php
                $values = is_object($row) ? get_object_vars($row) : $row;
                foreach ($values as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else : ?>
      <div class="alert alert-warning">Aucune donnée à afficher.</div>
    <?php endif; ?>
  </div>

  <?php include ($root . 'app/view/fragment/fragmentFooter.html'); ?>
</body>
<!-- ----- fin viewAll Universelle -->
