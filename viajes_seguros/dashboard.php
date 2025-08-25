<?php
include 'includes/header.php';


if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['userid'];
?>


<?php if (isset($_GET['purchase']) && $_GET['purchase'] == 'success'): ?>
    <div class="alert alert-success">¡Felicidades! Tu viaje ha sido reservado con éxito.</div>
<?php elseif (isset($_GET['cancel']) && $_GET['cancel'] == 'success'): ?>
    <div class="alert alert-success">Tu viaje ha sido cancelado correctamente.</div>
<?php endif; ?>


<h2>Bienvenido a tu panel, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
<p>Desde aquí puedes gestionar tus viajes y ver tu información.</p>

<ul class="dashboard-links">
    <li><a href="profile.php?id=<?php echo $_SESSION['userid']; ?>">Ver mi perfil y datos de pago</a></li>
    <li><a href="index.php">Buscar nuevos destinos</a></li>
</ul>

<hr class="section-divider">


<div class="upcoming-trips">
    <h2>Tus Viajes Reservados</h2>

    <?php

$sql = "SELECT d.id AS destination_id, d.name, d.image_url, p.id AS purchase_id, p.purchase_date, p.status, p.final_price 
        FROM purchases p
        JOIN destinations d ON p.destination_id = d.id
        WHERE p.user_id = ?
        ORDER BY p.purchase_date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        while ($trip = $result->fetch_assoc()) {
            echo '<div class="trip-card">';
            echo '  <img src="' . htmlspecialchars($trip['image_url']) . '" alt="Imagen de ' . htmlspecialchars($trip['name']) . '">';
            echo '  <div class="trip-info">';
            echo '    <h3>' . htmlspecialchars($trip['name']) . '</h3>';
            echo '    <p><strong>Fecha de reserva:</strong> ' . date("d/m/Y", strtotime($trip['purchase_date'])) . '</p>';
            echo '    <p><strong>Estado:</strong> ' . htmlspecialchars($trip['status']) . '</p>';
            echo '    <p><strong>Precio Pagado:</strong> <span class="paid-price">$' . number_format($trip['final_price'], 2) . '</span></p>';
            echo '  </div>';

            echo '  <div class="trip-card-actions">';

            echo '    <a href="destination_details.php?id=' . $trip['destination_id'] . '" class="btn btn-secondary">Ver Detalles</a>';

            echo '    <button class="btn btn-danger btn-cancel-trip" data-purchase-id="' . $trip['purchase_id'] . '">Cancelar</button>';
            echo '  </div>';

            echo '</div>';
        }
    } else {

        echo '<p class="no-trips-message">Aún no has reservado ningún viaje. ¿Qué esperas para planear tu próxima aventura?</p>';
    }
    $stmt->close();
    ?>
</div>

<div class="modal-overlay hidden"></div>
<div class="modal-box hidden">
    <div class="modal-header">
        <h3>Confirmar Cancelación</h3>
        <button class="modal-close-btn">×</button>
    </div>
    <div class="modal-body">
        <p>¿Estás seguro de que quieres cancelar este viaje? Esta acción no se puede deshacer.</p>
    </div>
    <div class="modal-actions">
        <button class="btn btn-secondary btn-modal-cancel">No, volver</button>
        <a href="#" id="confirm-cancel-link" class="btn btn-danger">Sí, cancelar viaje</a>
    </div>
</div>

 
<?php include 'includes/footer.php'; ?>