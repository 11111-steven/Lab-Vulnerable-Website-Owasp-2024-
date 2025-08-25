<?php
include 'includes/header.php';

$destination_query = isset($_GET['destination']) ? $_GET['destination'] : '';
?>

<h2>Resultados de búsqueda para: "<?php echo htmlspecialchars($destination_query); ?>"</h2>
<div class="destination-results">

<?php

$sql = "SELECT * FROM destinations WHERE name LIKE '%$destination_query%'";


try {
    $result = $conn->query($sql);
    

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<a href="destination_details.php?id=' . $row['id'] . '" class="destination-card-link">';
            echo '  <div class="destination-card">';
            echo '    <img src="' . htmlspecialchars($row['image_url']) . '" alt="Imagen de ' . htmlspecialchars($row['name']) . '">';
            echo '    <div class="destination-card-info">';
            echo '      <h3>' . htmlspecialchars($row['name']) . '</h3>';
            echo '      <p>' . substr(htmlspecialchars($row['description']), 0, 100) . '...</p>';
            echo '    </div>';
            echo '    <div class="price">Desde: $' . number_format($row['price'], 2) . '</div>';
            echo '  </div>';
            echo '</a>';
        }
    } else {
        if (!empty($destination_query)) {
             echo "<p>No se encontraron resultados para tu búsqueda.</p>";
        }
    }
} catch (mysqli_sql_exception $e) {

}
?>

</div>
<?php include 'includes/footer.php'; ?>