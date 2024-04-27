<?php
require_once __DIR__ . '/vendor/autoload.php';
// Datos de conexión a la base de datos
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$servername = $_ENV['SERVERNAME'];
$username = $_ENV['USERNAME'];
$password = $_ENV['PASSWORD'];
$dbname = $_ENV['DBNAME'];
$port = $_ENV['PORT'];

// Intentar establecer conexión mediante PDO
try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    // Configurar el modo de error a excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para obtener las últimas 5 recetas publicadas
    $sql = "SELECT * FROM jrm_receta ORDER BY Fecha_creacion DESC LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Verificar si se han encontrado recetas
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Convertir la fecha de creación al formato DD/MM/YYYY
            $fecha_creacion = date("d/m/Y", strtotime($row["Fecha_creacion"]));

            // Obtener las primeras 30 palabras de las instrucciones
            $instrucciones = implode(' ', array_slice(explode(' ', $row["Instrucciones"]), 0, 30));
            echo "<div class='receta'>";
            echo "<div class='receta_flex'>";
            echo "<div>";
            echo "<h2>" . ($row["Nombre"] ?? "Nombre no disponible") . "</h2>";
            echo "<p><strong>Fecha de publicación:</strong> " . $fecha_creacion . "</p>";
            echo "<p><strong>Categoría:</strong> " . ($row["Categoria"] ?? "Categoría no disponible") . "</p>";
            echo "<p><strong>Tiempo de preparación:</strong> " . ($row["Tiempo_preparacion"] ?? "Tiempo de preparación no disponible") . "</p>";
            echo "<p><strong>Nivel de dificultad:</strong> " . ($row["Nivel_dificultad"] ?? "Nivel de dificultad no disponible") . "</p>";
            echo "</div>";
            echo "<img src='" . ($row["Imagen_receta"] ?? "ruta/imagen/por/defecto.jpg") . "' alt='Imagen de la receta'>";
            echo "</div>";
            echo "<p><strong>Instrucciones:</strong> " . $instrucciones . "...</p>";

            echo "</div>";
        }
    } else {
        echo "No se encontraron recetas.";
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
// Cerrar conexión
$conn = null;
