
<!-- ----- début viewInserted Prod -->
<?php include ($root . 'app/view/fragment/fragmentHeader.html'); ?>

<body>
    <div class="container">
        <?php
        include ($root . 'app/view/fragment/fragmentMenu.php');
        include ($root . 'app/view/fragment/fragmentJumbotron.html');
        ?>
        <!-- ===================================================== -->
        <?php
        if ($results) {
            echo ("<h3>Inscription réussie </h3>");
            echo("<ul>");
            echo ("<li>id = " . $results . "</li>");
            echo ("<li>nom = " . $_POST['nom'] . "</li>");
            echo ("<li>prenom = " . $_POST['prenom'] . "</li>");
            echo ("<li>login = " . $_POST['login_user'] . "</li>");
            echo("</ul>");
        } else {
            echo ("<h3>Problème d'inscription:</h3>");
            echo ("id = " . $_GET['nom']);
        }
        ?>
        <a class="lead" href="router1.php?action=projetAccueil">Retour à l'accueil</a>
    </div>
    <?php
    include ($root . 'app/view/fragment/fragmentFooter.html');
    ?>
    <!-- ----- fin viewInserted -->    


