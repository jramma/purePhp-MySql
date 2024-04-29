<?= include 'sections/header.php';
include 'utils/connection.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset;port=$port";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';

    $stmt = $db->prepare("UPDATE jrm_users SET name = :name, surname = :surname WHERE username = :username");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();

    header('Location: profile.php');
    exit;
}

$stmt = $db->prepare("SELECT * FROM jrm_users WHERE username = :username");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>


    <h1>Perfil de usuario</h1>
    <?php if ($user): ?>
        <p>Nombre: <?= htmlspecialchars($user['name']) ?></p>
        <p>Apellido: <?= htmlspecialchars($user['surname']) ?></p>
        <button id="editProfileButton">Editar perfil</button>
        <div id="editProfileForm" style="display: none;">
            <form action="profile.php" method="post">
                <label for="name">Nombre:</label><br>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br>
                <label for="surname">Apellido:</label><br>
                <input type="text" id="surname" name="surname" value="<?= htmlspecialchars($user['surname']) ?>" required><br>
                <input type="submit" value="Guardar cambios">
            </form>
        </div>
    <?php else: ?>
        <p>No se encontró información del usuario.</p>
    <?php endif; ?>
    <script>
        document.getElementById('editProfileButton').addEventListener('click', function() {
            document.getElementById('editProfileForm').style.display = 'block';
        });
    </script>
<?= include 'sections/footer.php'; ?>