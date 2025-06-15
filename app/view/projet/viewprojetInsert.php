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

                    <!-- Groupe -->
                    <div class="mb-3">
                        <label for="groupe" class="form-label">Groupe</label>
                        <input type="text" class="form-control" id="groupe" name="groupe" placeholder="Entrez le groupe" required>
                    </div>

                    <!-- Responsable (select dynamique) -->
                    <div class="mb-3">
                        <label for="responsable" class="form-label">Responsable</label>
                        <select class="form-select" id="responsable" name="responsable" required>
                            <option value="" disabled selected>Choisissez un responsable</option>
                            <?php
                            // $responsables est un tableau d'objets ou tableaux fournis par le contrôleur
                            if (!empty($responsables)) {
                                foreach ($responsables as $resp) {
                                    // Exemple si $resp est un objet avec getId() et getNom() / getPrenom()
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
