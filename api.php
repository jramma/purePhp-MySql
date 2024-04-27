    <?php
    include 'utils/connection.php';

    header('Content-Type: application/json');

    // Conexión a la base de datos
    $db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8;port=$port", $username, $password);

    // Obtiene la ruta solicitada
    $request = $_SERVER['REQUEST_URI'];
    $request = explode('/', $request);

    // Verifica si la ruta es /api/recipes/<page>
    if (count($request) === 4 && $request[1] === 'api' && $request[2] === 'recipes' && is_numeric($request[3])) {
        $page = $request[3];
        $perPage = 10;
        $start = ($page - 1) * $perPage;

        // Prepara y ejecuta la consulta
        $stmt = $db->prepare('SELECT * FROM jrm_receta LIMIT :start, :perPage');
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();

        // Obtiene los resultados
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Verifica que $recipes contiene los datos que esperas
        if ($recipes === false || $recipes === null) {
            echo json_encode(['error' => 'No se pudieron obtener las recetas']);
        } else {
            echo json_encode($recipes);
        }
    }
    // Verifica si la ruta es /api/recipe/<id>
    else if (count($request) === 4 && $request[1] === 'api' && $request[2] === 'recipe' && is_numeric($request[3])) {
        $id = $request[3];

        // Prepara y ejecuta la consulta
        $stmt = $db->prepare('SELECT * FROM jrm_receta WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Obtiene los resultados
        $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica que $recipe contiene los datos que esperas
        if ($recipe === false || $recipe === null) {
            echo json_encode(['error' => 'No se pudo obtener la receta']);
        } else {
            echo json_encode($recipe);
        }
    }
    ?>