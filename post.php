<?php
include 'header.php';

include 'utils/connection.php';

// Verifica si el ID de la receta está presente en la URL
if (!isset($_GET['Id'])) {
    echo "No se proporcionó un ID de receta.";
    exit;
}

$id_receta = $_GET['Id'];
try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepara y ejecuta la consulta SQL
    $stmt = $conn->prepare("SELECT * FROM jrm_receta WHERE Id = :Id");
    $stmt->bindParam(':Id', $id_receta, PDO::PARAM_INT);
    $stmt->execute();

    // Verificar si se ha encontrado la receta
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Convertir la fecha de creación al formato DD/MM/YYYY
        $fecha_creacion = date("d/m/Y", strtotime($row["Fecha_creacion"]));

       
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
        echo "<p class='instrucciones'><strong>Instrucciones:</strong> " . ($row["Instrucciones"] ?? "Instrucciones no disponibles") . "...</p>";
        echo "</div>";
    } else {
        echo "No se encontró la receta.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

include 'footer.php';
