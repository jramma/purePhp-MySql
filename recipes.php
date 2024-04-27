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

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtén el número de página desde la URL, si no existe, es la página 1
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 5; // Número de recetas por página

    // Calcula el inicio de las recetas para la consulta SQL
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    // Prepara y ejecuta la consulta SQL
    $stmt = $conn->prepare("SELECT * FROM recetas LIMIT :start, :perPage");
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();

    // Obtén las recetas
    $recetas = $stmt->fetchAll();

    // Muestra las recetas
    foreach ($recetas as $receta) {
        // Muestra las recetas
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
    }

    // Calcula el número total de páginas
    $stmt = $conn->prepare("SELECT COUNT(*) FROM recetas");
    $stmt->execute();
    $totalRecetas = $stmt->fetchColumn();
    $pages = ceil($totalRecetas / $perPage);

    // Muestra los enlaces de paginación
    for ($i = 1; $i <= $pages; $i++) {
        echo "<a href='?page=$i'>$i</a> ";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
