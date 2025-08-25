<?php
include 'includes/header.php';

$message = '';
$error = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); 
    $credit_card = $_POST['credit_card']; 


    try {
        $sql = "INSERT INTO users (username, email, password, credit_card_number) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $password, $credit_card);

        if ($stmt->execute()) {
            $message = "¡Registro exitoso! Ahora puedes <a href='login.php'>iniciar sesión</a>.";
        } 
        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        
        if ($e->getCode() == 1062) {
            
            $error = "El nombre de usuario o el correo electrónico ya están registrados. Por favor, elige otros diferentes.";
        } else {
            
            $error = "Ocurrió un error inesperado durante el registro. Por favor, inténtalo de nuevo.";
            
        }
    }
    
}
?>

<h2>Regístrate</h2>
<?php if ($message): ?>
    <div class="alert alert-success"><?php echo $message; ?></div>
<?php endif; ?>
<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form action="register.php" method="POST">
    <div class="form-group">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="credit_card">Número de Tarjeta de Crédito:</label>
        <input type="text" id="credit_card" name="credit_card">
    </div>
    <button type="submit" class="btn">Registrarse</button>
</form>

<?php include 'includes/footer.php'; ?>