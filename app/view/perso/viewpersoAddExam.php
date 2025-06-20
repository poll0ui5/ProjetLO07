<!-- ----- début viewpersoAddExam.php ----- -->
<?php
require($root . '/app/view/fragment/fragmentHeader.php');
?>

<body>
  <div class="container">
    <?php
    require($root . '/app/view/fragment/fragmentMenu.php');
    require($root . '/app/view/fragment/fragmentJumbotron.html');
    ?>

    <h3>Ajout d'un nouvel examinateur</h3>

    <form role="form" method="post" action="router1.php?action=ExaminateurAdded">
      <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" class="form-control" id="nom" name="nom" required>
      </div>

      <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="text" class="form-control" id="prenom" name="prenom" required>
      </div>

      <input type="hidden" name="role_examinateur" value="1">
      <input type="hidden" name="role_responsable" value="0">
      <input type="hidden" name="role_etudiant" value="0">

      <br>
      <button class="btn btn-success" type="submit">Ajouter</button>
    </form>
  </div>

  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>
<!-- ----- fin viewpersoAddExam.php ----- -->
