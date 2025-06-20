
<!-- ----- début viewAll -->
<?php include ($root . 'app/view/fragment/fragmentHeader.php'); ?>
?>

<body>
    <div class="container">
        <?php
        include ($root . 'app/view/fragment/fragmentMenu.php');
        ?>
        <div class="mt-4 p-5 bg-danger text-white rounded">
            <h1>Amélioration de MVC </h1>
        </div>

        <div class="mt-3">On devrait essayer de faire une vue globale ou du moins en avoir une qui couvre un maximum de cas de figure. Par exemple, j'ai du en créer une
            différente juste pour afficher le nombre de producteurs par région alors que c'est juste un tableau de 2 variables. On pourrait faire un tableau dynamique qui 
            affiche n'importe quel type de valeurs. Faire une view universelle quoi.</div>
    </div>
    <?php
    include ($root . 'app/view/fragment/fragmentFooter.html');
    ?>

    <!-- ----- fin viewAll -->


