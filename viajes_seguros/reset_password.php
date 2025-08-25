<?php
include 'includes/header.php';

$error = '';
$success = '';
$token = $_GET['token'] ?? '';

if (!$token) {
    header("Location: login.php");
    exit();
}


$stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    $error = "El enlace de reseteo es inválido o ha expirado. Por favor, solicita uno nuevo.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $user) {
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password === $password_confirm) {
        $hashed_password = md5($password);
        $update_stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?");
        $update_stmt->bind_param("si", $hashed_password, $user['id']);
        if ($update_stmt->execute()) {
            $success = "¡Tu contraseña ha sido actualizada con éxito! Ya puedes <a href='login.php'>iniciar sesión</a>.";
        }
    } else {
        $error = "Las contraseñas no coinciden.";
    }
}
?>

<h2>Restablecer Contraseña</h2>

<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php else: ?>
    <?php if ($user): ?>
    <form action="reset_password.php?token=<?php echo htmlspecialchars($token); ?>" method="POST">
        <div class="form-group">
            <label for="password">Nueva Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirm">Confirmar Nueva Contraseña:</label>
            <input type="password" id="password_confirm" name="password_confirm" required>
        </div>
        <button type="submit" class="btn">Cambiar Contraseña</button>
    </form>
    <?php endif; ?>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>