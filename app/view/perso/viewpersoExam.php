
<!-- ----- début viewpersoExam -->
<?php
require($root . '/app/view/fragment/fragmentHeader.php');
?>

<body>
  <div class="container">
    <?php
    require($root . '/app/view/fragment/fragmentMenu.php');
    require($root . '/app/view/fragment/fragmentJumbotron.html');
    ?>

    <h3>Liste des examinateurs</h3>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">Prénom</th>
          <th scope="col">Nom</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($results as $examinateur) {
          echo "<tr><td>" . htmlspecialchars($examinateur->getPrenom()) . "</td><td>" . htmlspecialchars($examinateur->getNom()) . "</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
<!-- ----- fin viewpersoExam -->
