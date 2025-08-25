<?php
include 'includes/header.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<h2>Destino no especificado.</h2>";
    include 'includes/footer.php';
    exit();
}

$destination_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
$stmt->bind_param("i", $destination_id);
$stmt->execute();
$result = $stmt->get_result();
$destination = $result->fetch_assoc();

if ($destination) {
?>

    <div class="destination-grid">


        <div class="destination-main-content">
            <img class="destination-image" src="<?php echo htmlspecialchars($destination['image_url']); ?>" alt="Imagen de <?php echo htmlspecialchars($destination['name']); ?>">
            
            <div class="destination-header">
                <h1><?php echo htmlspecialchars($destination['name']); ?></h1>
                <p class="travel-type-badge"><?php echo htmlspecialchars($destination['travel_type']); ?></p>
            </div>
            
            <p class="description"><?php echo htmlspecialchars($destination['description']); ?></p>

            <h2 class="section-title">Detalles del Viaje</h2>
            <div class="key-details">
                <div class="detail-item">
                    <strong>Duración:</strong> <?php echo htmlspecialchars($destination['duration_days']); ?> días
                </div>
                <div class="detail-item">
                    <strong>Idioma:</strong> <?php echo htmlspecialchars($destination['language']); ?>
                </div>
            </div>

            <?php if (!empty($destination['map_embed_url'])): ?>
                <h2 class="section-title">Ubicación</h2>
                <div class="map-container">
                    <iframe 
                        src="<?php echo htmlspecialchars($destination['map_embed_url']); ?>" 
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            <?php endif; ?>
        </div>


        <aside class="destination-sidebar">
            <div class="purchase-box">
                <div class="price-tag">Desde: <strong>$<?php echo number_format($destination['price'], 2); ?></strong></div>
                <p class="price-clarification">por persona, impuestos incluidos.</p>
                

                <a href="confirm_purchase.php?id=<?php echo $destination['id']; ?>" class="btn btn-buy">Reservar Viaje</a>
                
                <div class="sidebar-contact">
                    ¿Dudas? <a href="contact.php">Contáctanos</a>
                </div>
            </div>
        </aside>

    </div>
<?php
} else {
    echo "<h2>Destino no encontrado.</h2>";
}

$stmt->close();
include 'includes/footer.php';
?>