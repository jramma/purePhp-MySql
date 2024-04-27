<?=
include 'header.php';
?>
<div class="container2">
    <h2> Últimas 5 recetas publicadas</h2>
    <div class="box">
        <?=
        include 'activity_3.php';
        ?>
    </div>
</div>
<div class="container">
    <h1>Receta Aleatoria</h1>
    <div>
        <?php
        // Incluir el script PHP para obtener la receta
        include 'activity_2.php';
        ?>
    </div>
</div>
<?=
include 'footer.php'; ?>