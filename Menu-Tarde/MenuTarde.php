<?php
include_once '../Admin/basedatos/conexion.php';
$bd = new connection();
$db = $bd->conectar();

$pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
if ($pagina <= 0) $pagina = 1;

$limit = 12;
$offset = ($pagina - 1) * $limit;

$busqueda = isset($_COOKIE['cookiebusqueda']) ? $_COOKIE['cookiebusqueda'] : '';

if ($busqueda != '') {
    $q = "SELECT * FROM menu WHERE nombre LIKE ? AND turno='Tarde' LIMIT ?, ?";
    $stmt = $db->prepare($q);
    $search_param = "%$busqueda%";
    $stmt->bind_param("sii", $search_param, $offset, $limit);
} else {
    $q = "SELECT * FROM menu WHERE turno='Tarde' LIMIT ?, ?";
    $stmt = $db->prepare($q);
    $stmt->bind_param("ii", $offset, $limit);
}

$stmt->execute();
$consulta = $stmt->get_result();

// For pagination counting
if ($busqueda != '') {
    $count_q = "SELECT COUNT(*) as total FROM menu WHERE nombre LIKE ? AND turno='Tarde'";
    $stmt_c = $db->prepare($count_q);
    $stmt_c->bind_param("s", $search_param);
} else {
    $count_q = "SELECT COUNT(*) as total FROM menu WHERE turno='Tarde'";
    $stmt_c = $db->prepare($count_q);
}
$stmt_c->execute();
$total_rows = $stmt_c->get_result()->fetch_assoc()['total'];
$paginas = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Tarde | Mi Bar</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="../PagPrincipal/CSS/modern-style.css">
    
    <style>
        .menu-header {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('fondo-menu.jpg');
            background-size: cover;
            background-position: center;
            padding: 120px 0 60px;
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }

        .search-bar {
            max-width: 600px;
            margin: -30px auto 40px;
            position: relative;
            z-index: 10;
        }

        .search-bar input {
            padding: 1.2rem 1.5rem;
            border-radius: 50px;
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            font-size: 1rem;
        }

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .product-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .product-info {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-tag {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--accent);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--primary);
            margin-top: 1rem;
        }

        .pagination-container {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .page-link-custom {
            padding: 0.8rem 1.2rem;
            border-radius: 10px;
            background: white;
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 600;
        }

        .page-link-custom.active {
            background: var(--accent);
            color: white;
        }

        .page-link-custom:hover:not(.active) {
            background: #eee;
        }
    </style>
</head>
<body style="background-color: #f8f9fa;">

    <header>
        <div class="nav-container">
            <div class="logo">
                <a href="../index.php">Mi Bar<span>.</span></a>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="../index.php#menu">Volver</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="menu-header">
        <h1 style="font-size: 3.5rem; font-weight: 900;">MENÚ TARDE</h1>
        <p style="opacity: 0.8; font-size: 1.2rem;">Momentos para compartir</p>
    </div>

    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="search-bar">
            <input type="text" placeholder="Busca tu comida favorita..." value="<?php echo htmlspecialchars($busqueda); ?>" onchange="busqueda(this.value)">
        </div>

        <div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));">
            <?php if ($consulta->num_rows > 0) {
                while ($item = $consulta->fetch_assoc()) { ?>
                <div class="reveal">
                    <div class="product-card">
                        <img src="../Uploads/<?php echo !empty($item['imagen']) ? $item['imagen'] : 'default.jpg'; ?>" class="product-img" alt="<?php echo $item['nombre']; ?>">
                        <div class="product-info">
                            <div>
                                <span class="product-tag"><?php echo $item['tipo']; ?></span>
                                <h3 style="margin: 0.5rem 0; font-size: 1.2rem;"><?php echo $item['nombre']; ?></h3>
                            </div>
                            <p class="product-price">$<?php echo number_format($item['precio'], 2); ?></p>
                        </div>
                    </div>
                </div>
            <?php } } else { ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 100px 0;">
                    <i class="fas fa-search fa-3x" style="opacity: 0.2; margin-bottom: 1rem;"></i>
                    <p style="font-size: 1.5rem; opacity: 0.5;">No encontramos lo que buscas...</p>
                </div>
            <?php } ?>
        </div>

        <?php if ($paginas > 1) { ?>
        <div class="pagination-container">
            <?php for ($i = 1; $i <= $paginas; $i++) { ?>
                <a href="?pagina=<?php echo $i; ?>" class="page-link-custom <?php echo $pagina == $i ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php } ?>
        </div>
        <?php } ?>
    </div>

    <footer style="margin-top: 100px;">
        <div style="text-align: center; opacity: 0.5; font-size: 0.8rem;">
            &copy; 2026 Mi Bar Mendoza.
        </div>
    </footer>

    <script src="script.js"></script>
    <script>
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                if (elementTop < windowHeight - 100) {
                    reveals[i].classList.add("active");
                }
            }
        }
        window.addEventListener("scroll", reveal);
        reveal();
    </script>
</body>
</html>
