<!-- ----- début viewAll Universelle -->
<?php include ($root . 'app/view/fragment/fragmentHeader.php'); ?>

<body>
    <div class="container mt-4">
        <?php
        include ($root . 'app/view/fragment/fragmentMenu.php');
        include ($root . 'app/view/fragment/fragmentJumbotron.html');
        ?>

        <h3 class="mb-4">Examinateurs pour le projet sélectionné</h3>

        <?php if (!empty($examinateurs)): ?>
            <ul class="list-group">
                <?php foreach ($examinateurs as $e): ?>
                    <li class="list-group-item">
                        <?= htmlspecialchars($e['nom']) ?> <?= htmlspecialchars($e['prenom']) ?>
                        <span class="badge bg-secondary float-end">
                            ID <?= htmlspecialchars($e['examinateur_id']) ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-info">Aucun examinateur n'est affecté à ce projet.</div>
        <?php endif; ?>
    </div>

    <?php include ($root . 'app/view/fragment/fragmentFooter.html'); ?>
</body>
<!-- ----- fin viewAll Universelle -->
