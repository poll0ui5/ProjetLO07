<?php include ($root . 'app/view/fragment/fragmentHeader.php');?> ?>
<body>
  <div class="container">
    <?php
    include ($root . 'app/view/fragment/fragmentMenu.php');
    include ($root . 'app/view/fragment/fragmentJumbotron.html');
    ?>
    
    <div class="panel panel-primary">
      <div class="panel-heading">Connexion à votre compte</div>
      <div class="panel-body">
        <form role="form" method="post" action="router1.php?action=persoLogged">
          <div class="form-group">
            <label for="login">Login : (adjani pour etu, sokolova pour examinateur, lemercier pour exam et respo)</label>
            <input type="text" class="form-control" id="login_user" name="login" value="boss" required>
          </div>
          <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password_user" name="password" value="secret" required>
          </div>
            <br>
          <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
      </div>
    </div>
  </div>   

  <?php include ($root . 'app/view/fragment/fragmentFooter.html'); ?>
</body>
</html>

