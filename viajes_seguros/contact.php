<?php include 'includes/header.php'; ?>

<div class="info-page-container">

    <?php
    if (isset($_SESSION['contact_success'])) {
        echo '<div class="alert alert-success">' . $_SESSION['contact_success'] . '</div>';
        unset($_SESSION['contact_success']);
    }
    ?>

    <h1>Contacto</h1>
    <p class="subtitle">¿Tienes preguntas o estás listo para planificar tu próxima aventura? Estamos aquí para ayudarte.</p>
    
    <hr class="section-divider">

    <div class="contact-grid">

        <div class="contact-info">
            <h3>Información de Contacto</h3>
            <ul>
                <li><strong>Dirección:</strong>Av. de la Aventura 123, 28080 Madrid, España</li>
                <li><strong>Teléfono:</strong>+34 912 345 678</li>
                <li><strong>Email:</strong>viajesseguros@gmail.com</li>
            </ul>

            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3037.649987893901!2d-3.70578918460394!3d40.41677537936502!2m3!1f0!2f0!3f0!3m2!1i1024!i768!4f13.1!3m3!1m2!1s0xd422880a87a2455%3A0x897c4e9c4c7c3d6d!2sPuerta%20del%20Sol!5e0!3m2!1ses!2ses!4v1678887000000!5m2!1ses!2ses" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div> 


        <div class="contact-form">
            <h3>Envíanos un Mensaje</h3>
            <form action="handle_contact.php" method="POST">
                <div class="form-group">
                    <label for="name">Nombre Completo</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Asunto</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea id="message" name="message" rows="6" required></textarea>
                </div>
                <button type="submit" class="btn">Enviar Mensaje</button>
            </form>
        </div> 
    </div> 
</div> 

<?php include 'includes/footer.php'; ?>