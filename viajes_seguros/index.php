<?php include 'includes/header.php'; ?>


<div class="hero-section">


    <div class="carousel-background">
        <img src="images\premium_photo-1694475139039-cbe1cb02a610.jpeg" alt="Fondo de París">
        <img src="images\Yifeng-Ding-1800x1192.jpeg" alt="Fondo de Italia">
        <img src="images\arquitectura-china-gran-great-wallpaper-preview.jpg" alt="Fondo de Dubai">
        <img src="images\premium_photo-1694475139039-cbe1cb02a610.jpeg" alt="Fondo de París">
    </div>


    <div class="hero-content">
        <h1>¡Bienvenido a Viajes Seguros S.A.!</h1>
        <p1>Tu próxima aventura comienza aquí. Busca tu destino soñado.</p1>

        <h2>Buscar Destinos</h2>
        <form action="search_results.php" method="GET">
            <div class="form-group">
                <label for="destination">Destino:</label>
                <input type="text" id="destination" name="destination" placeholder="Ej: París, Roma, Tokio...">
            </div>
            <button type="submit" class="btn">Buscar</button>
        </form>
    </div>

</div>


<div class="container"> 

    <h2>Nuestros Destinos Populares</h2>
    <div class="destinations-showcase">
        <?php

        $sql_destinos = "SELECT id, name, image_url FROM destinations ORDER BY name ASC";
        $result_destinos = $conn->query($sql_destinos);

        if ($result_destinos && $result_destinos->num_rows > 0) {
            while($row = $result_destinos->fetch_assoc()) {

                echo '<a href="destination_details.php?id=' . $row['id'] . '" class="showcase-card-link">';
                echo '  <div class="showcase-card">';
                echo '    <img src="' . htmlspecialchars($row['image_url']) . '" alt="Imagen de ' . htmlspecialchars($row['name']) . '">';
                echo '    <div class="card-title-overlay">';
                echo '      <h4>' . htmlspecialchars($row['name']) . '</h4>';
                echo '    </div>';
                echo '  </div>';
                echo '</a>';
            }
        } else {
            echo '<p>No hay destinos disponibles para mostrar en este momento.</p>';
        }
        ?>
    </div>

    <hr style="margin: 2.5rem 0;">


    <h2>Oferta Especial del Día</h2>
    <p>Carga el archivo de oferta de nuestros socios para ver detalles exclusivos.</p>
    <form action="special_offer_parser.php" method="POST">
        <div class="form-group">
            <label for="xml_data">Pega el contenido XML de la oferta aquí:</label>
            <textarea name="xml_data" id="xml_data" rows="8" style="width:100%;"></textarea>
        </div>
        <button type="submit" class="btn">Procesar Oferta</button>
    </form>

</div> 

<?php include 'includes/footer.php'; ?>