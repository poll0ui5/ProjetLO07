<!-- ----- debut de la page cave_acceuil -->
<?php
include ($root . 'app/view/fragment/fragmentHeader.html');?>
<body>
  <div class="container">
    <?php
    include ($root . 'app/view/fragment/fragmentMenu.php');
    include ($root . 'app/view/fragment/fragmentJumbotron.html');
    ?>
    <img src="tick_vert.png" alt="Connexion réussie" style="max-width: 300px;">

    <p>Connexion réussie. <a class="lead" href="router1.php?action=projetAccueil">Retour à l'accueil</a></p>
  </div>   
  
  
  <?php
  include ($root . 'app/view/fragment/fragmentFooter.html');
  ?>

  <!-- ----- fin de la page cave_acceuil -->

</body>
</html>