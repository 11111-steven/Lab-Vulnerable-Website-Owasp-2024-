<?php
include 'includes/header.php';

libxml_disable_entity_loader(false); 

$xml_response = '';
if (isset($_POST['xml_data']) && !empty($_POST['xml_data'])) {
    $xml_data = $_POST['xml_data'];
    $dom = new DOMDocument();
    

    if ($dom->loadXML($xml_data, LIBXML_NOENT)) { 
        $offer = simplexml_import_dom($dom);
        $title = $offer->title;
        $description = $offer->description;
        $xml_response = "<h3>Oferta Procesada: " . htmlspecialchars($title) . "</h3>";
        $xml_response .= "<p>" . htmlspecialchars($description) . "</p>";
    } else {
        $xml_response = "<div class='alert alert-danger'>Error al procesar el XML.</div>";
    }
} else {
    $xml_response = "<p>No se recibió ningún dato XML para procesar.</p>";
}
?>

<h2>Resultado de la Oferta Especial</h2>
<div>
    <?php echo $xml_response; ?>
</div>
<a href="index.php" class="btn">Volver al inicio</a>

<?php include 'includes/footer.php'; ?>