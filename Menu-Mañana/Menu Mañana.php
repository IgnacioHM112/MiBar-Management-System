<?php
include_once '../Admin/basedatos/conexion.php';
$bd = new connection();
$db = $bd->conectar();

$pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
if ($pagina <= 0) $pagina = 1;

$limit = 8;
$offset = ($pagina - 1) * $limit;

$busqueda = isset($_COOKIE['cookiebusqueda']) ? $_COOKIE['cookiebusqueda'] : '';

if ($busqueda != '') {
    $q = "SELECT * FROM menu WHERE nombre LIKE ? AND turno='Mañana' LIMIT ?, ?";
    $stmt = $db->prepare($q);
    $search_param = "%$busqueda%";
    $stmt->bind_param("sii", $search_param, $offset, $limit);
} else {
    $q = "SELECT * FROM menu WHERE turno='Mañana' LIMIT ?, ?";
    $stmt = $db->prepare($q);
    $stmt->bind_param("ii", $offset, $limit);
}

$stmt->execute();
$consulta = $stmt->get_result();

// For pagination counting
if ($busqueda != '') {
    $count_q = "SELECT COUNT(*) as total FROM menu WHERE nombre LIKE ? AND turno='Mañana'";
    $stmt_c = $db->prepare($count_q);
    $stmt_c->bind_param("s", $search_param);
} else {
    $count_q = "SELECT COUNT(*) as total FROM menu WHERE turno='Mañana'";
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
    <title>Menú Mañana - Mi Bar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 font-weight-bold text-primary">MENÚ DE MAÑANA</h1>
            <p class="lead text-muted">Empieza tu día con lo mejor de Mi Bar</p>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <input type="text" class="form-control shadow-sm" placeholder="¿Qué estás buscando?..." value="<?php echo htmlspecialchars($busqueda); ?>" onchange="busqueda(this.value)">
            </div>
            <div class="col text-right">
                <a href="../index.php" class="btn btn-primary shadow-sm">Volver al Inicio</a>
            </div>
        </div>

        <div class="row">
            <?php if ($consulta->num_rows > 0) {
                while ($item = $consulta->fetch_assoc()) { ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm border-0 transition-hover">
                        <img src="../Uploads/<?php echo !empty($item['imagen']) ? $item['imagen'] : 'default.jpg'; ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-dark"><?php echo $item['nombre']; ?></h5>
                            <span class="badge badge-light text-muted mb-2"><?php echo $item['tipo']; ?></span>
                            <p class="card-text text-primary font-weight-bold h5">$<?php echo number_format($item['precio'], 2); ?></p>
                        </div>
                    </div>
                </div>
            <?php } } else { ?>
                <div class="col-12 text-center py-5">
                    <p class="h4 text-muted">No se encontraron productos en este horario.</p>
                </div>
            <?php } ?>
        </div>

        <?php if ($paginas > 1) { ?>
        <nav class="mt-4">
            <ul class="pagination justify-content-center shadow-sm">
                <li class="page-item <?php echo $pagina <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>">Anterior</a>
                </li>
                <?php for ($i = 1; $i <= $paginas; $i++) { ?>
                    <li class="page-item <?php echo $pagina == $i ? 'active' : ''; ?>">
                        <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
                <li class="page-item <?php echo $pagina >= $paginas ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>">Siguiente</a>
                </li>
            </ul>
        </nav>
        <?php } ?>
    </div>
    <script src="script.js"></script>
</body>
</html>