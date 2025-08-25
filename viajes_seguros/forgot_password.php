<?php
include 'includes/header.php';

$message = '';
$message_type = 'info';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {

        $token = bin2hex(random_bytes(16));
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

        $update_stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE id = ?");
        $update_stmt->bind_param("ssi", $token, $expiry, $user['id']);
        $update_stmt->execute();


        $log_message = "Password reset for " . $user['username'] . " - Token: " . $token . "\n";
        file_put_contents('logs/password_resets.log', $log_message, FILE_APPEND);

        $reset_link = "http://localhost/viajes_seguros/reset_password.php?token=" . $token;
        $message = "Se ha enviado un correo a <strong>" . htmlspecialchars($email) . "</strong>.<br><br>";
        $message .= "<strong>(Simulación de Laboratorio)</strong>: Como no tenemos un servidor de correo, puedes usar el siguiente enlace para continuar:<br>";
        $message .= "<a href='" . $reset_link . "'>" . $reset_link . "</a>";
        $message_type = 'success';

    } else {

        $message = "Si tu correo electrónico está en nuestro sistema, recibirás un enlace para restablecer tu contraseña.";
        $message_type = 'success';
    }
}
?>

<h2>Recuperar Contraseña</h2>
<p>Ingresa tu correo electrónico y te enviaremos las instrucciones para restablecer tu contraseña.</p>


<?php if ($message): ?>
    <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
<?php endif; ?>

<form action="forgot_password.php" method="POST">
    <div class="form-group">
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <button type="submit" class="btn">Enviar Instrucciones</button>
</form>

<?php include 'includes/footer.php'; ?>