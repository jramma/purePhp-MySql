<?php
include 'sections/header.php';
include 'utils/connection.php';
$charset = 'utf8mb4';

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

$stmt = $db->prepare("SELECT * FROM jrm_users WHERE username = :username");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<h1>Perfil de usuario</h1>
<?php if ($user) : ?>
    <p>Nombre: <?= htmlspecialchars($user['name']) ?></p>
    <p>Apellido: <?= htmlspecialchars($user['surname']) ?></p>
<?php else : ?>
    <p>No se encontró información del usuario.</p>
<?php endif; ?>
<?php include 'sections/footer.php'; ?>