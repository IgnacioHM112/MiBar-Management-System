<?php
include '../Admin/basedatos/conexion.php';

if ($_POST) {
    $conec = connection::conectar(); 

    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Secure insert using prepared statements
    $stmt = $conec->prepare("INSERT INTO usuarios (usuario, contraseña, Admin) VALUES (?, ?, 0)");
    $stmt->bind_param("ss", $usuario, $contraseña);
    
    if ($stmt->execute()) {
        header('Location: loginvista.php');
        exit();
    } else {
        echo "Error al registrar: " . $conec->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Registro - Mi Bar</title> 
        <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
        <link rel="stylesheet" href="style.css">
    </head>  

    <body>

        <form method="POST" class="formulario" action="registrarvista.php">

            <h1>Registrate</h1>
            <div class="contenedor">
            
                <div class="input-contenedor">
                    <i class="fas fa-user icon"></i>
                    <input type="text" placeholder="Usuario" name="usuario" required>
                </div>
                    
                <div class="input-contenedor">
                    <i class="fas fa-key icon"></i>
                    <input type="password" placeholder="Contraseña" name="contraseña" required>
                </div>

                <input type="submit" value="Registrate" class="button">
                <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
                <p>¿Ya tienes una cuenta? <a class="link" href="loginvista.php">Iniciar Sesion</a></p>

            </div>
        </form>
    </body>
</html>