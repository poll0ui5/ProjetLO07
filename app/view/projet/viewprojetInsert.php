<?php include ($root . 'app/view/fragment/fragmentHeader.php'); ?>
<body>
    <div class="container">
        <?php
        include ($root . 'app/view/fragment/fragmentMenu.php');
        include ($root . 'app/view/fragment/fragmentJumbotron.html');
        ?>

        <div class="panel panel-primary">
            <div class="panel-heading">Ajout d'un nouveau projet</div>
            <div class="panel-body">
                <form role="form" action="router1.php?action=projetCreated" method="post">
                    
                    <!-- Label du projet -->
                    <div class="mb-3">
                        <label for="label" class="form-label">Label du projet</label>
                        <input type="text" class="form-control" id="label" name="label" placeholder="Entrez le nom du projet" required>
                    </div>

                    <!-- Taille du groupe -->
                    <div class="mb-3">
                        <label for="groupe" class="form-label">Nombre d'étudiants dans le groupe</label>
                        <select class="form-select" id="groupe" name="groupe" required>
                            <option value="" disabled selected>Choisissez une taille de groupe</option>
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                echo "<option value=\"$i\">$i étudiant" . ($i > 1 ? 's' : '') . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Responsable (select dynamique) -->
                    <div class="mb-3">
                        <label for="responsable" class="form-label">Responsable</label>
                        <select class="form-select" id="responsable" name="responsable" required>
                            <option value="" disabled selected>Choisissez un responsable</option>
                            <?php
                            if (!empty($results)) {
                                foreach ($results as $resp) {
                                    $id = $resp->getId();
                                    $nomPrenom = htmlspecialchars($resp->getNom() . ' ' . $resp->getPrenom());
                                    echo "<option value=\"$id\">$nomPrenom</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Bouton -->
                    <button type="submit" class="btn btn-primary">Ajouter le projet</button>
                </form>
            </div>
        </div>
    </div>   

    <?php include ($root . 'app/view/fragment/fragmentFooter.html'); ?>
</body>
</html>
