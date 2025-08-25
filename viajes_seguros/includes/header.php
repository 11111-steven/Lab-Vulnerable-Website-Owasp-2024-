<?php 
require_once 'db.php'; 




if (isset($_SESSION['userid']) && !isset($_SESSION['user_uuid'])) {
    $stmt_uuid = $conn->prepare("SELECT uuid FROM users WHERE id = ?");
    if ($stmt_uuid) {
        $stmt_uuid->bind_param("i", $_SESSION['userid']);
        $stmt_uuid->execute();
        $result_uuid = $stmt_uuid->get_result();
        if ($user_data = $result_uuid->fetch_assoc()) {
            $_SESSION['user_uuid'] = $user_data['uuid'];
        }
        $stmt_uuid->close();
    }
}


if (!isset($open_container)) {
    $open_container = true;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viajes Seguros S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="logo">Viajes Seguros S.A.</a>
        <div>
            <a href="index.php">Inicio</a>
            <a href="about.php">Quiénes Somos</a>
            <a href="contact.php">Contacto</a>
            
            <?php if (isset($_SESSION['userid'])): ?>
                <a href="dashboard.php">Mi Panel</a>

                <a href="profile.php?uuid=<?php echo htmlspecialchars($_SESSION['user_uuid'] ?? ''); ?>">Mi Perfil</a>
                <a href="logout.php">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Registro</a>
            <?php endif; ?>
        </div>
    </nav>

<?php if ($open_container): ?>
    <div class="container">
<?php endif; ?>