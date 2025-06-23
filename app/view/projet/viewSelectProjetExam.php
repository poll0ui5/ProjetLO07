<!-- ----- début viewAll Universelle -->
<?php include ($root . 'app/view/fragment/fragmentHeader.php'); ?>

<body>
    <div class="container mt-4">
        <?php
        include ($root . 'app/view/fragment/fragmentMenu.php');
        include ($root . 'app/view/fragment/fragmentJumbotron.html');
        ?>

        <h3 class="mb-4">Sélectionnez un projet</h3>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">Veuillez sélectionner un projet.</div>
        <?php endif; ?>

        <form method="post" action="router1.php?action=projetAvecExamList" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label for="projet_id" class="form-label">Projet :</label>
                <select name="projet_id" id="projet_id" class="form-select" required>
                    <option value="">-- Choisissez un projet --</option>
                    <?php foreach ($projets as $p): ?>
                        <option value="<?= htmlspecialchars($p['projet_id']) ?>">
                            <?= htmlspecialchars($p['projet_label']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Voir les examinateurs</button>
        </form>
    </div>

    <?php include ($root . 'app/view/fragment/fragmentFooter.html'); ?>
</body>
<!-- ----- fin viewAll Universelle -->
