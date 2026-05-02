<?php
include_once 'conexion.php';
session_start();
if ($_SESSION['cuenta'] !== 'admin') { header("Location: ../../index.php"); exit(); }
$bd = new connection();
$conex = $bd->conectar();

// Borrar Item
if (!empty($_GET['borrar'])) {
    $id = intval($_GET['borrar']);
    $stmt = $conex->prepare("DELETE FROM menu WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: formulario.php"); exit();
}

// Agregar Item
if ($_POST && isset($_POST['accion'])) {
    $nombre = $_POST['nombre']; $precio = $_POST['precio']; $tipo = $_POST['tipo']; $turno = $_POST['turno'];
    $imagen = "";
    if (!empty($_FILES["img"]["name"])) {
        $target_dir = "../../Uploads/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
        $imagen = $_FILES["img"]["name"];
    }
    $stmt = $conex->prepare("INSERT INTO menu (nombre, tipo, turno, precio, imagen) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $tipo, $turno, $precio, $imagen);
    $stmt->execute();
    header("Location: formulario.php"); exit();
}

// Logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../../index.php"); exit();
}

$consulta = $conex->query("SELECT * FROM menu ORDER BY turno DESC, nombre ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - Mi Bar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white"><h5>Agregar Nuevo Producto</h5></div>
                    <form action="formulario.php" method="POST" enctype="multipart/form-data" class="card-body">
                        <input type="hidden" name="accion" value="1">
                        <div class="form-group"><label>Nombre</label><input type="text" name="nombre" class="form-control" required></div>
                        <div class="form-group"><label>Precio</label><input type="number" step="0.01" name="precio" class="form-control" required></div>
                        <div class="form-group"><label>Tipo</label>
                            <select name="tipo" class="form-control"><option>Comida</option><option>Bebida</option><option>Postre</option></select>
                        </div>
                        <div class="form-group"><label>Turno</label>
                            <select name="turno" class="form-control"><option value="Mañana">Mañana</option><option value="Tarde">Tarde</option></select>
                        </div>
                        <div class="form-group"><label>Imagen</label><input type="file" name="img" class="form-control"></div>
                        <button type="submit" class="btn btn-success btn-block">Guardar en el Menú</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Gestión de Productos</h5>
                        <form method="POST" class="m-0"><button type="submit" name="logout" class="btn btn-danger btn-sm">Cerrar Sesión</button></form>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="thead-dark">
                                <tr><th>Nombre</th><th>Tipo</th><th>Turno</th><th>Precio</th><th>Acciones</th></tr>
                            </thead>
                            <tbody>
                                <?php while($row = $consulta->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo $row['nombre']; ?></td>
                                    <td><?php echo $row['tipo']; ?></td>
                                    <td><span class="badge <?php echo $row['turno']=='Mañana'?'badge-warning':'badge-info'; ?>"><?php echo $row['turno']; ?></span></td>
                                    <td>$<?php echo number_format($row['precio'], 2); ?></td>
                                    <td>
                                        <a href="form-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="formulario.php?borrar=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro?')">Borrar</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-3 text-right"><a href="../../index.php" class="btn btn-link">Volver al Sitio</a></div>
            </div>
        </div>
    </div>
</body>
</html>