
<?php include ($root . 'app/view/fragment/fragmentHeader.php'); ?>

<body>
    <div class="container mt-4">
        <?php
        include ($root . 'app/view/fragment/fragmentMenu.php');
        include ($root . 'app/view/fragment/fragmentJumbotron.html');
        ?>


        <?php if (!empty($results)) : ?>
            <form method="post" action="router1.php?action=rdvEtuBookWrite" class="card p-4 shadow-sm">
                <div class="mb-3">
                    <label for="creneau_id" class="form-label">Choisissez un créneau :</label>
                    <select name="creneau_id" id="creneau_id" class="form-select" required>
                        <?php
                        if (empty($results)) {
                            echo "<option disabled selected>Aucun créneau disponible</option>";
                        } else {
                            foreach ($results as $creneau) {
                                echo "<option value='" . htmlspecialchars($creneau['creneau_id']) . "'>"
                                . htmlspecialchars($creneau['creneau']) . " - "
                                . htmlspecialchars($creneau['projet_label']) . " "
                                . "(places prises: " . htmlspecialchars($creneau['nb_rdv_pris']) . "/"
                                . htmlspecialchars($creneau['groupe_max']) . ")"
                                . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Valider le rendez-vous</button>
            </form>

        <?php else : ?>
            <div class="alert alert-warning">Aucune créneau disponible.</div>
        <?php endif; ?>
    </div>

    <?php include ($root . 'app/view/fragment/fragmentFooter.html'); ?>
</body>
