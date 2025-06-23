<!-- ----- début viewAll Universelle -->
<?php include ($root . 'app/view/fragment/fragmentHeader.php'); ?>

<body>
    <div class="container mt-4">
        <?php
        include ($root . 'app/view/fragment/fragmentMenu.php');
        include ($root . 'app/view/fragment/fragmentJumbotron.html');
        ?>

        <h3 class="mb-4">Selectionner un projet:</h3>

        <form method="post" action="router1.php?action=creneauListByProjet" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label for="projet_id" class="form-label">Projet :</label>
                <select name="projet_id" id="projet_id" class="form-select" required>
                    <?php if (empty($projets)): ?>
                        <option disabled>Aucun projet trouvé</option>
                    <?php else: ?>
                        <?php foreach ($projets as $p): ?>
                            <option value="<?= htmlspecialchars($p['projet_id']) ?>">
                                <?= htmlspecialchars($p['projet_label']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Voir mes créneaux</button>
        </form>
    </div>

    <?php include ($root . 'app/view/fragment/fragmentFooter.html'); ?>
</body>
<!-- ----- fin viewAll Universelle -->
