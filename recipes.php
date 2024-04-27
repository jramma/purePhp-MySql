<?php
include 'header.php';
?>
<!-- Filtros para ordenar las recetas -->
<div>
    <form action="" method="get">
        <label for="orden">Ordenar por:</label>
        <select name="orden">
            <option value="nombre_asc">Nombre (A-Z)</option>
            <option value="nombre_desc">Nombre (Z-A)</option>
            <option value="tiempo_asc">Tiempo de preparación (ascendente)</option>
            <option value="tiempo_desc">Tiempo de preparación (descendente)</option>
        </select>
        <label for="categoria">Categoría:</label>
        <select name="categoria">
            <option value="">Todas</option>
            <option value="italiana">Italiana</option>
            <option value="vegana">Vegana</option>
            <option value="postre">Postre</option>
            <option value="desayuno">Desayuno</option>
            <option value="almuerzo">Almuerzo</option>
            <option value="cena">Cena</option>
            <option value="snack">Snack</option>
        </select>
        <label for="dificultad">Nivel de dificultad:</label>
        <select name="dificultad">
            <option value="">Todos</option>
            <option value="bajo">Bajo</option>
            <option value="medio">Medio</option>
            <option value="alto">Alto</option>
        </select>
        <input type="submit" value="Aplicar filtros">
    </form>
</div>
<div class="box">
    <?php
    include 'utils/connection.php';

    try {
        $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtén el número de página desde la URL, si no existe, es la página 1
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 5; // Número de recetas por página

        // Calcula el inicio de las recetas para la consulta SQL
        $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

        // Obtén los parámetros de ordenación y filtrado desde la URL
        $orden = $_GET['orden'] ?? 'nombre_asc';
        $categoria = $_GET['categoria'] ?? '';
        $dificultad = $_GET['dificultad'] ?? '';

        $orderBy = '';
        switch ($orden) {
            case 'nombre_asc':
                $orderBy = 'Nombre ASC';
                break;
            case 'nombre_desc':
                $orderBy = 'Nombre DESC';
                break;
            case 'tiempo_asc':
                $orderBy = 'Tiempo_preparacion ASC';
                break;
            case 'tiempo_desc':
                $orderBy = 'Tiempo_preparacion DESC';
                break;
        }

        $where = [];
        if ($categoria !== '') {
            $where[] = 'Categoria = :categoria';
        }
        if ($dificultad !== '') {
            $where[] = 'Nivel_dificultad = :dificultad';
        }

        $sql = "SELECT * FROM jrm_receta";
        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $sql .= " ORDER BY $orderBy LIMIT :start, :perPage";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        if ($categoria !== '') {
            $stmt->bindParam(':categoria', $categoria);
        }
        if ($dificultad !== '') {
            $stmt->bindParam(':dificultad', $dificultad);
        }
        $stmt->execute();

        // Verificar si se han encontrado recetas
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Convertir la fecha de creación al formato DD/MM/YYYY
                $fecha_creacion = date("d/m/Y", strtotime($row["Fecha_creacion"]));

                // Obtener las primeras 30 palabras de las instrucciones
                $instrucciones = implode(' ', array_slice(explode(' ', $row["Instrucciones"]), 0, 30));

                // Obtener id de la receta
                $id_receta = $row["Id"];

                // Crear el enlace a post.php con el nombre de la receta
                echo "<a class='clicky' href='post.php?Id=" . urlencode($id_receta) . "'>";
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
                echo "</a>";
            }
        } else {
            echo "No se encontraron recetas.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }


    ?>
</div>
<div class="paginación">
    <?php
    // Calcula el número total de páginas
    $stmt = $conn->prepare("SELECT COUNT(*) FROM jrm_receta");
    $stmt->execute();
    $totalRecetas = $stmt->fetchColumn();
    $pages = ceil($totalRecetas / $perPage);

    // Muestra los enlaces de paginación
    for ($i = 1; $i <= $pages; $i++) {
        echo "<a class='enlace' href='?page=$i'>$i</a> ";
    }
    $conn = null;
    ?>
</div>
<?php
include 'footer.php';
?>