<?php include 'fragment/fragmentHeader.html'; ?>
<body>
  <div class="container">
    <?php
    include 'fragment/fragmentMenu.php';
    include 'fragment/fragmentJumbotron.html';
    ?>
    
    <div class="panel panel-primary">
      <div class="panel-heading">Connexion à votre compte</div>
      <div class="panel-body">
        <form role="form" method="post" action="router.php?action=login">
          <div class="form-group">
            <label for="login">Login :</label>
            <input type="text" class="form-control" id="login" name="login" required>
          </div>
          <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
      </div>
    </div>
  </div>   

  <?php include 'fragment/fragmentFooter.html'; ?>
</body>
</html>

