<?php
$request = $_SERVER['REQUEST_URI'];

if (preg_match('/^\/api\//', $request)) {
    // Si la URL comienza con /api/, incluye api.php
    include 'api.php';
} else {
    include 'sections/header.php';
?>
    <div class="container2">
        <h2> Últimas 5 recetas publicadas</h2>
        <div class="box">
            <?php include 'activity_3.php'; ?>
        </div>
    </div>
    
    <div class="activity_2">
        <h2>activity_2</h2>
    </div>
    <div class="container">
        <h3>Receta Aleatoria</h3>
        <div id="activity_2">
            <?php
            // Incluir el script PHP para obtener la receta
            include 'activity_2.php';
            ?>
        </div>
    </div>
<?php
    include 'sections/footer.php';
}
?>