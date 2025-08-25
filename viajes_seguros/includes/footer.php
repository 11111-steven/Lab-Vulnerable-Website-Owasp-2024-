    </div> 

<footer class="site-footer">
    <div class="footer-content">
        
        <div class="footer-section about">
            <h3 class="logo-text">Viajes Seguros S.A.</h3>
            <p>
                Tu pasaporte a aventuras inolvidables con la tranquilidad que mereces.
                Descubre el mundo con la confianza de estar siempre protegido.
            </p>
        </div>
        <div class="footer-section links">
            <h3>Enlaces Rápidos</h3>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="about.php">Quiénes Somos</a></li>
                <li><a href="contact.php">Contacto</a></li>
                <li><a href="terms.php">Términos y Condiciones</a></li>
            </ul>
        </div>
        <div class="footer-section contact-social">
            <h3>Contacto</h3>
            <span>Correo: viajesseguros@gmail.com</span>
            <span>Telf: +34 912 345 678</span>
            <div class="socials">
                <a href="https://www.instagram.com/steven.eduu/" target="_blank" title="Mi Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                </a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        © <?php echo date('Y'); ?> Viajes Seguros S.A. | Todos los derechos reservados | Desarrollado por Steven Vallejo Sacoto
    </div>
</footer>


<script>
document.addEventListener('DOMContentLoaded', function() {
    
    const modalOverlay = document.querySelector('.modal-overlay');
    const modalBox = document.querySelector('.modal-box');
    const confirmCancelLink = document.getElementById('confirm-cancel-link');
    const cancelButtons = document.querySelectorAll('.btn-cancel-trip');
    const closeModalButtons = document.querySelectorAll('.modal-close-btn, .btn-modal-cancel');


    if (modalOverlay && modalBox && confirmCancelLink) {
        

        const openModal = (purchaseId) => {
            confirmCancelLink.href = `cancel_trip.php?purchase_id=${purchaseId}`;
            modalOverlay.classList.remove('hidden');
            modalBox.classList.remove('hidden');
        };

        
        const closeModal = () => {
            modalOverlay.classList.add('hidden');
            modalBox.classList.add('hidden');
        };


        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const purchaseId = this.dataset.purchaseId;
                openModal(purchaseId);
            });
        });


        closeModalButtons.forEach(button => {
            button.addEventListener('click', closeModal);
        });

        
        modalOverlay.addEventListener('click', closeModal);
    }
});
</script>


</body>
</html>
<?php

if (isset($conn)) {
    $conn->close();
}
?>