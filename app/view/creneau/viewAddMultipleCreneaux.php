<!-- ----- début viewAll Universelle -->
<?php include ($root . 'app/view/fragment/fragmentHeader.php'); ?>

<body>
    <div class="container mt-4">
        <?php
        include ($root . 'app/view/fragment/fragmentMenu.php');
        include ($root . 'app/view/fragment/fragmentJumbotron.html');
        ?>

        <div class="container mt-5">
            <h3 class="mb-4">Ajouter plusieurs créneaux</h3>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    <?php if ($_GET['error'] == 1): ?>
                        Tous les champs sont requis et le nombre doit être entre 1 et 10.
                    <?php else: ?>
                        Une erreur s'est produite lors de l'insertion.
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="router1.php?action=creneauAddConsecSubmit" class="card p-4 shadow-sm">
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
                    <label for="start_datetime" class="form-label">Date & heure de début :</label>
                    <input type="datetime-local"
                           id="start_datetime"
                           name="start_datetime"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label for="count" class="form-label">Nombre de créneaux (1–10) :</label>
                    <input type="number"
                           id="count"
                           name="count"
                           class="form-control"
                           min="1" max="10"
                           value="1"
                           required>
                </div>

                <button type="submit" class="btn btn-primary">Créer les créneaux</button>
            </form>
        </div>

    </div>

    <?php include ($root . 'app/view/fragment/fragmentFooter.html'); ?>
</body>
<!-- ----- fin viewAll Universelle -->
