<?php
session_start();
if (!isset($_SESSION["cuenta"])) {
    $_SESSION["cuenta"] = "";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Bar | Experiencia Gastronómica</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./PagPrincipal/CSS/modern-style.css">
</head>
<body>

    <header>
        <div class="nav-container">
            <div class="logo">
                <a href="#">Mi Bar<span>.</span></a>
            </div>
            
            <div class="nav-toggle" id="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <nav>
                <ul class="nav-links" id="nav-list">
                    <li><a href="#hero">Inicio</a></li>
                    <li><a href="#info-row">Horarios</a></li>
                    <li><a href="#info-row">Ubicación</a></li>
                    <li><a href="#menu">La Carta</a></li>
                    <?php if($_SESSION["cuenta"] == "admin"): ?>
                        <li><a href="./Admin/basedatos/formulario.php">Panel Admin</a></li>
                    <?php else: ?>
                        <li><a href="./Login/loginvista.php" class="btn-login">Acceso Clientes</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <section id="hero">
        <div class="hero-content">
            <h1>Mi Bar. Tu lugar.</h1>
            <p>Sabores auténticos en el corazón de Mendoza.</p>
            <div style="margin-top: 2rem;">
                <a href="#menu" class="btn">Ver la Carta</a>
            </div>
            <div style="margin-top: 4rem; animation: bounce 2s infinite;">
                <a href="#info-row" style="color: white; font-size: 2rem;"><i class="fas fa-chevron-down"></i></a>
            </div>
        </div>
    </section>

    <section id="info-row" class="reveal">
        <div class="info-flex-container">
            <!-- Horarios -->
            <div class="info-box">
                <h2 class="section-title">Horarios</h2>
                <i class="far fa-clock fa-3x" style="color: var(--accent); margin-bottom: 1.5rem;"></i>
                <div style="font-size: 1.1rem;">
                    <p style="margin-bottom: 0.5rem;"><strong>Lunes a Viernes</strong></p>
                    <p style="font-size: 1.4rem; color: var(--primary); font-weight: 800;">12:30 — 16:30</p>
                    <p style="font-size: 1.4rem; color: var(--primary); font-weight: 800;">18:30 — 23:30</p>
                    <hr style="margin: 1.5rem 0; opacity: 0.1;">
                    <p style="opacity: 0.6;">Sábados y Domingos: Cerrado</p>
                </div>
            </div>

            <!-- Ubicación -->
            <div class="info-box">
                <h2 class="section-title">Ubicación</h2>
                <i class="fas fa-map-marked-alt fa-3x" style="color: var(--accent); margin-bottom: 1.5rem;"></i>
                <p style="font-size: 1.1rem; margin-bottom: 1rem;">Calle Arístides Villanueva, Mendoza.</p>
                
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3350.1234!2d-68.8540801!3d-32.8922585!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzLCsDUzJzMyLjEiUyA2OMKwNTEnMTQuNyJX!5e0!3m2!1ses!2sar!4v1620000000000!5m2!1ses!2sar" allowfullscreen="" loading="lazy"></iframe>
                </div>
                
                <a href="https://www.google.com/maps/place/Arístides+Villanueva,+Mendoza" target="_blank" class="btn" style="margin-top: 1.5rem;">
                    <i class="fas fa-directions"></i> Cómo llegar
                </a>
            </div>
        </div>
    </section>

    <section id="menu" class="reveal">
        <h2 class="section-title">Nuestra Carta</h2>
        <div class="grid">
            <div class="card">
                <div style="height: 200px; background: url('./Imagenes/menu-mañana.jpg') center/cover; border-radius: 10px; margin-bottom: 1rem;"></div>
                <h3>Mañana</h3>
                <p>Desayunos artesanales, café de especialidad y opciones saludables para empezar el día.</p>
                <a href="./Menu-Mañana/Menu Mañana.php" class="btn" style="margin-top: 1.5rem;">Ver Menú Mañana</a>
            </div>
            <div class="card">
                <div style="height: 200px; background: url('./Imagenes/menu-almuerzo.jpg') center/cover; border-radius: 10px; margin-bottom: 1rem;"></div>
                <h3>Tarde / Noche</h3>
                <p>Almuerzos ejecutivos, tapeo, coctelería de autor y las mejores cervezas artesanales.</p>
                <a href="./Menu-Tarde/MenuTarde.php" class="btn" style="margin-top: 1.5rem;">Ver Menú Tarde</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Contacto</h4>
                <p><i class="fas fa-envelope"></i> info@mibar.com</p>
                <p><i class="fas fa-phone"></i> +54 261 632 5700</p>
                <p><i class="fas fa-location-arrow"></i> 25 de Mayo, Mendoza</p>
            </div>
            <div class="footer-section">
                <h4>Seguinos</h4>
                <div style="display: flex; gap: 1rem; font-size: 1.5rem;">
                    <a href="#" style="color: white;"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="color: white;"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: white;"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h4>Sugerencias</h4>
                <form action="#" method="POST">
                    <input type="text" placeholder="Tu nombre" style="margin-bottom: 0.5rem;">
                    <textarea placeholder="Tu mensaje" rows="3"></textarea>
                    <button type="submit" class="btn" style="width: 100%; margin-top: 0.5rem;">Enviar</button>
                </form>
            </div>
        </div>
        <div style="text-align: center; margin-top: 3rem; opacity: 0.5; font-size: 0.8rem;">
            &copy; 2026 Mi Bar Mendoza. Todos los derechos reservados.
        </div>
    </footer>
<script>
    // Mobile Menu Toggle
    const mobileMenu = document.getElementById('mobile-menu');
    const navList = document.getElementById('nav-list');

    mobileMenu.addEventListener('click', () => {
        navList.classList.toggle('active');
        mobileMenu.classList.toggle('toggle');
    });

    // Close menu when clicking a link
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            navList.classList.remove('active');
        });
    });

    // Scroll Reveal Animation
    function reveal() {
...
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }
        window.addEventListener("scroll", reveal);
        reveal(); // Initial check
    </script>
</body>
</html>
