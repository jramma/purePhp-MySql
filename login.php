<?= include 'sections/header.php';
include 'utils/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $db->prepare("SELECT * FROM jrm_users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit;
    } else {
        echo "Invalid credentials";
    }
}
?>
<?php if (!isset($_SESSION['username'])) : ?>
    <h1 style="text-align: center;">Iniciar sesión</h1>
    <form action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
<?php endif; ?>
<div>
    <?php
    if (isset($_SESSION['username'])) {
        echo "Bienvenido/a, " . $_SESSION['username'];
    }
    ?>
</div>

<?= include 'sections/footer.php'; ?>
