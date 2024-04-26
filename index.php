<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receta Aleatoria</title>
</head>
<body>
    <div class="container">
        <h1>Receta Aleatoria</h1>
        <div class="receta">
            <?php
            // Incluir el script PHP para obtener la receta
            include 'activity_2.php';
            ?>
        </div>
    </div>
</body>
</html>

<style>
    :root {
        color-scheme: light dark;
    }
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 1rem;
    }
    .container h1{
        text-decoration: underline;
    }

    
</style>