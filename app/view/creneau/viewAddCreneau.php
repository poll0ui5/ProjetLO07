<!-- ----- début viewAll Universelle -->
<?php include ($root . 'app/view/fragment/fragmentHeader.php'); ?>

<body>
    <div class="container mt-4">
        <?php
        include ($root . 'app/view/fragment/fragmentMenu.php');
        include ($root . 'app/view/fragment/fragmentJumbotron.html');
        ?>

        <div class="container mt-5">
            <h3 class="mb-4">Proposer un nouveau créneau</h3>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">Veuillez remplir tous les champs.</div>
            <?php endif; ?>

            <form method="post" action="router1.php?action=creneauAddSubmit" class="card p-4 shadow-sm">
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

                <div class="mb-3">
                    <label for="creneau_datetime" class="form-label">Date & heure :</label>
                    <input type="datetime-local" 
                           id="creneau_datetime" 
                           name="creneau_datetime" 
                           class="form-control" 
                           required>
                </div>

                <button type="submit" class="btn btn-primary">Ajouter le créneau</button>
            </form>
        </div>

    </div>

    <?php include ($root . 'app/view/fragment/fragmentFooter.html'); ?>
</body>
<!-- ----- fin viewAll Universelle -->
