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
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_repeat = $_POST['password_repeat'] ?? '';

    if ($password !== $password_repeat) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    $stmt = $db->prepare("SELECT * FROM jrm_users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "El nombre de usuario ya existe.";
        exit;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO jrm_users (username, name, surname, password) VALUES (:username, :name, :surname, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':password', $password_hash);
    $stmt->execute();

    $_SESSION['username'] = $username;
    header('Location: profile.php');
    exit;
}
?>
<?php if (!isset($_SESSION['username'])) : ?>
    <h1 style="text-align: center;">Registro de usuario</h1>
    <form action="signup.php" method="post">
        <label for="username">Nombre de usuario:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="name">Nombre:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="surname">Apellidos:</label><br>
        <input type="text" id="surname" name="surname" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="password_repeat">Repite la contraseña:</label><br>
        <input type="password" id="password_repeat" name="password_repeat" required><br>
        <input type="submit" value="Registrarse">
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
<style>
    body {
        font-family: Arial, sans-serif;
    }

    form {
        width: 300px;
        margin: 0 auto;
    }

    label {
        display: block;
        margin-top: 20px;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
    }

    input[type="submit"] {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    div {
        margin-top: 20px;
        text-align: center;
        font-size: 20px;
    }
</style>