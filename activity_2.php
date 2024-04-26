<?php
// Datos de conexión a la base de datos
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "jrm_recetas";
$port = "3306";

// Intentar establecer conexión mediante PDO
try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    // Configurar el modo de error a excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para obtener una receta cualquiera
    $sql = "SELECT * FROM jrm_receta ORDER BY RAND() LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Obtener la fila de la receta
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se ha encontrado una receta
    if ($row) {
        echo "<h2>" . ($row["Nombre"] ?? "Nombre no disponible") . "</h2>";
        echo "<p><strong>Ingredientes:</strong> " . ($row["Ingredientes"] ?? "Ingredientes no disponibles") . "</p>";
        echo "<p><strong>Instrucciones:</strong> " . ($row["Instrucciones"] ?? "Instrucciones no disponibles") . "</p>";
    } else {
        echo "No se encontraron recetas.";
    }
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
// Cerrar conexión
$conn = null;
?>
