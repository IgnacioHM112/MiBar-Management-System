<?php
include_once 'conexion.php';
session_start();
if ($_SESSION['cuenta'] !== 'admin') { header("Location: ../../index.php"); exit(); }
$bd = new connection();
$conex = $bd->conectar();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id == 0) { header("Location: formulario.php"); exit(); }

$stmt = $conex->prepare("SELECT * FROM menu WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$item = $stmt->get_result()->fetch_assoc();

if ($_POST && isset($_POST['accion'])) {
    $nombre = $_POST['nombre']; $precio = $_POST['precio']; $tipo = $_POST['tipo']; $turno = $_POST['turno'];
    $imagen = $item['imagen']; 
    
    if (!empty($_FILES["img"]["name"])) {
        $target_dir = "../../Uploads/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
        $imagen = $_FILES["img"]["name"];
    }
    
    $stmt = $conex->prepare("UPDATE menu SET nombre=?, tipo=?, turno=?, precio=?, imagen=? WHERE id=?");
    $stmt->bind_param("sssssi", $nombre, $tipo, $turno, $precio, $imagen, $id);
    $stmt->execute();
    header("Location: formulario.php"); exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Item - Mi Bar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-warning"><h5>Editar Item del Menú</h5></div>
                    <form action="form-edit.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data" class="card-body">
                        <input type="hidden" name="accion" value="2">
                        <div class="form-group"><label>Nombre</label><input type="text" name="nombre" value="<?php echo $item['nombre']; ?>" class="form-control" required></div>
                        <div class="form-group"><label>Precio</label><input type="number" step="0.01" name="precio" value="<?php echo $item['precio']; ?>" class="form-control" required></div>
                        <div class="form-group"><label>Tipo</label>
                            <select name="tipo" class="form-control">
                                <option <?php if($item['tipo'] == 'Comida') echo 'selected'; ?>>Comida</option>
                                <option <?php if($item['tipo'] == 'Bebida') echo 'selected'; ?>>Bebida</option>
                                <option <?php if($item['tipo'] == 'Postre') echo 'selected'; ?>>Postre</option>
                            </select>
                        </div>
                        <div class="form-group"><label>Turno</label>
                            <select name="turno" class="form-control">
                                <option <?php if($item['turno'] == 'Mañana') echo 'selected'; ?>>Mañana</option>
                                <option <?php if($item['turno'] == 'Tarde') echo 'selected'; ?>>Tarde</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Imagen Actual: <small><?php echo $item['imagen']; ?></small></label><br>
                            <input type="file" name="img" class="form-control">
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                            <a href="formulario.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>