
<!-- ----- début viewInserted Prod -->
<?php include ($root . 'app/view/fragment/fragmentHeader.php'); ?>

<body>
    <div class="container">
        <?php
        include ($root . 'app/view/fragment/fragmentMenu.php');
        include ($root . 'app/view/fragment/fragmentJumbotron.html');
        ?>
        <!-- ===================================================== -->
        <?php if ($results && $results !== -1): ?>
            <!-- Inscription réussie -->
            <div class="alert alert-success mt-4" role="alert">
                <h4 class="alert-heading">Inscription réussie !</h4>
            </div>

            <div class="card mt-3 shadow-sm">
                <div class="card-header bg-primary text-white">
                    Détails de l'utilisateur
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>ID:</strong> <?= htmlspecialchars($results) ?></li>
                    <li class="list-group-item"><strong>Nom:</strong> <?= htmlspecialchars($_POST['nom']) ?></li>
                    <li class="list-group-item"><strong>Prénom:</strong> <?= htmlspecialchars($_POST['prenom']) ?></li>
                    <li class="list-group-item"><strong>Login:</strong> <?= htmlspecialchars($_POST['login_user']) ?></li>
                </ul>
            </div>

        <?php elseif ($results === false): ?>
            <!-- Login déjà existant -->
            <div class="alert alert-warning mt-4" role="alert">
                <h4 class="alert-heading">Login déjà utilisé</h4>
                <p>Le login <strong><?= htmlspecialchars($_POST['login_user']) ?></strong> existe déjà. Veuillez en choisir un autre.</p>
            </div>

        <?php else: ?>
            <!-- Erreur technique -->
            <div class="alert alert-danger mt-4" role="alert">
                <h4 class="alert-heading">Erreur lors de l'inscription</h4>
                <p>Un problème technique est survenu. Veuillez réessayer plus tard.</p>
                <p>Nom fourni : <strong><?= htmlspecialchars($_POST['nom'] ?? 'Inconnu') ?></strong></p>
            </div>
        <?php endif; ?>


        <a class="lead" href="router1.php?action=persoLogin">Connexion</a>
    </div>
    <?php
    include ($root . 'app/view/fragment/fragmentFooter.html');
    ?>
    <!-- ----- fin viewInserted -->    


