<!-- ----- début viewExaminateurInserted -->
<?php include ($root . 'app/view/fragment/fragmentHeader.php'); ?>

<body>
    <div class="container">
        <?php
        include ($root . 'app/view/fragment/fragmentMenu.php');
        include ($root . 'app/view/fragment/fragmentJumbotron.html');
        ?>
        <!-- ===================================================== -->
        <?php
        if ($results && $results > 0) {
            echo ("<h3>Ajout d'un examinateur réussi</h3>");
            echo("<ul>");
            echo ("<li><strong>id</strong> = " . htmlspecialchars($results) . "</li>");
            echo ("<li><strong>nom</strong> = " . htmlspecialchars($nom) . "</li>");
            echo ("<li><strong>prenom</strong> = " . htmlspecialchars($prenom) . "</li>");
            echo("</ul>");
        } else {
            echo ("<h3>Problème lors de l'ajout de l'examinateur</h3>");
            echo ("<p>Veuillez vérifier les données fournies.</p>");
        }
        ?>
        <a class="lead" href="router1.php?action=projetAccueil">Retour à l'accueil</a>
    </div>

    <?php include ($root . 'app/view/fragment/fragmentFooter.html'); ?>
</body>
<!-- ----- fin viewExaminateurInserted -->
