<?php
include 'includes/header.php';


if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}


if (!isset($_GET['uuid'])) {
    echo "<h2>Error: No se ha especificado un perfil.</h2>";
    include 'includes/footer.php';
    exit();
}

$user_uuid = $_GET['uuid'];



$sql = "SELECT id, uuid, username, email, credit_card_number FROM users WHERE uuid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_uuid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
?>

    <div class="profile-container">
        <h2>Perfil de <?php echo htmlspecialchars($user['username']); ?></h2>
        
        <div class="profile-info-row">
            <strong>ID de Usuario:</strong> 
            <span><?php echo $user['id']; ?></span>
        </div>

        <div class="profile-info-row">
            <strong>UUID de Usuario:</strong> 
            <span><?php echo htmlspecialchars($user['uuid']); ?></span>
        </div>
        
        <div class="profile-info-row">
            <strong>Email:</strong> 
            <span><?php echo htmlspecialchars($user['email']); ?></span>
        </div>
        

        <div class="profile-info-row sensitive">
            <strong>Número de Tarjeta de Crédito:</strong> 
            <span class="sensitive-data"><?php echo htmlspecialchars($user['credit_card_number']); ?></span>
        </div>
    </div>


<?php
} else {

    echo "<h2>Usuario no encontrado.</h2>";
}

$stmt->close();
include 'includes/footer.php';
?>