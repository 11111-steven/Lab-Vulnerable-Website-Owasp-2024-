<?php
include 'includes/header.php';

if (isset($_SESSION['userid'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';
if (isset($_GET['error']) && $_GET['error'] == 'login_required') {
    $error = "Debes iniciar sesión para poder comprar un destino.";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    $password_hash = $_POST['password']; 

    $sql = "SELECT id, username FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password_hash);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['userid'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
    $stmt->close();
}
?>

<h2>Iniciar Sesión</h2>
<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form id="login-form" action="login.php" method="POST">
    <div class="form-group">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" id="password-field" name="password" required>
    </div>
    <button type="submit" class="btn">Entrar</button>
</form>
<p style="text-align: center; margin-top: 1rem;"><a href="forgot_password.php">¿Olvidaste tu contraseña?</a></p>

<?php include 'includes/footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {

            event.preventDefault(); 
            
            const passwordField = document.getElementById('password-field');
            const plainPassword = passwordField.value;
            

            if (plainPassword.length > 0 && plainPassword.length !== 32) {

                const hashedPassword = CryptoJS.MD5(plainPassword).toString();
                

                passwordField.value = hashedPassword;
            }
            

            loginForm.submit();
        });
    }
});
</script>