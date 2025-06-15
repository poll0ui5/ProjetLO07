<?php include ($root . 'app/view/fragment/fragmentHeader.php'); ?>
<body>
    <div class="container">
        <?php
        include ($root . 'app/view/fragment/fragmentMenu.php');
        include ($root . 'app/view/fragment/fragmentJumbotron.html');
        ?>

        <div class="panel panel-primary">
            <div class="panel-heading">Création de votre compte</div>
            <div class="panel-body">
                <form role ="form" action="router1.php?action=persoRegistered" method="post">
                    <!-- Rôles -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="role_responsable" name="role_responsable">
                        <label class="form-check-label" for="responsable">Responsable</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="role_examinateur" name="role_examinateur">
                        <label class="form-check-label" for="examinateur">Examinateur</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="role_etudiant" name="role_etudiant" checked>
                        <label class="form-check-label" for="etudiant">Étudiant</label>
                    </div>

                    <!-- Nom -->
                    <div class="mb-3">
                        <label for="nom" class="form-label" >Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="Bob" placeholder="Entrez votre nom">
                    </div>

                    <!-- Prénom -->
                    <div class="mb-3">
                        <label for="prenom" class="form-label" >Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="Dylan" placeholder="Entrez votre prénom">
                    </div>

                    <!-- Login -->
                    <div class="mb-3">
                        <label for="login" class="form-label" >Login</label>
                        <input type="text" class="form-control" id="login_user" name="login_user" value="bobby" placeholder="Identifiant de connexion">
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label" Password</label>
                        <input type="password" class="form-control" id="password_user" name="password_user" value="secret" placeholder="Mot de passe">
                    </div>

                    <!-- Bouton -->
                    <button type="submit" class="btn btn-primary">Go</button>
                </form>
            </div>
        </div>
    </div>   

    <?php include ($root . 'app/view/fragment/fragmentFooter.html'); ?>
</body>
</html>

