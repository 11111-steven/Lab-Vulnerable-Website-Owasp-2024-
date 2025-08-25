<?php
include 'includes/header.php';

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$destination_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
$stmt->bind_param("i", $destination_id);
$stmt->execute();
$result = $stmt->get_result();
$destination = $result->fetch_assoc();

if (!$destination) {
    echo "<h2>Destino no encontrado.</h2>";
    include 'includes/footer.php';
    exit();
}
?>

<div class="purchase-confirmation-container">
    <div class="confirmation-header">
        <h1>Confirmar Reserva</h1>
        <p>Estás a un paso de tu próxima aventura. Por favor, revisa los detalles a continuación.</p>
    </div>

    <div class="summary-card">
        
        <div class="summary-image-container" style="background-image: url('<?php echo htmlspecialchars($destination['image_url']); ?>');">

        </div>

        <div class="summary-details">
            <h2><?php echo htmlspecialchars($destination['name']); ?></h2>
            <div class="summary-row">
                <span>Duración:</span>
                <span><?php echo htmlspecialchars($destination['duration_days']); ?> días</span>
            </div>
            <div class="summary-row">
                <span>Tipo de Viaje:</span>
                <span><?php echo htmlspecialchars($destination['travel_type']); ?></span>
            </div>
            <hr>
            <div class="summary-row total">
                <span>Precio Final:</span>
                <span>$<?php echo number_format($destination['price'], 2); ?></span>
            </div>
            <p class="summary-note">El pago se procesará de forma segura. Este viaje aparecerá en tu panel después de la confirmación.</p>


 
            <form action="purchase.php" method="POST">
                <input type="hidden" name="destination_id" value="<?php echo $destination['id']; ?>">
                <input type="hidden" name="final_price" value="<?php echo $destination['price']; ?>">
                <button type="submit" class="btn btn-buy">Confirmar y Pagar</button>
            </form>


            <div class="go-back-link">
                <a href="destination_details.php?id=<?php echo $destination['id']; ?>">o volver a los detalles del destino</a>
            </div>

        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>