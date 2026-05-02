<?php
include '../Admin/basedatos/conexion.php';

session_start();

if ($_POST) {
    $conec = connection::conectar(); 
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Using prepared statements to prevent SQL Injection
    $stmt = $conec->prepare("SELECT id, usuario, contraseña, Admin FROM usuarios WHERE usuario = ? AND contraseña = ?");
    $stmt->bind_param("ss", $usuario, $contraseña);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row == null) {
        echo '<script type="text/javascript">';
        echo ' alert("Usuario/Contraseña incorrecto")'; 
        echo '</script>';
    } else {
        if ($row['Admin'] == 1) {
            $_SESSION['cuenta'] = 'admin'; 
            header('Location: ../Admin/basedatos/formulario.php');
        } else {
            $_SESSION['cuenta'] = 'usuario';
            header('Location: ../index.php');
        }
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Login - Mi Bar</title> 
        <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
        <link rel="stylesheet" href="style.css">
    </head>  

    <body>

        <form method="POST" action="loginvista.php" class="formulario">
        
            <h1>Login</h1>

            <div class="contenedor">
                
                <div class="input-contenedor">
                    <i class="fas fa-user icon"></i>
                    <input type="text" placeholder="Usuario" name="usuario" required>
                </div>
                
                <div class="input-contenedor">
                    <i class="fas fa-key icon"></i>
                    <input type="password" placeholder="Contraseña" name="contraseña" required>
                </div>

                <input type="submit" value="Login" class="button">
                <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
                <p>¿No tienes una cuenta? <a class="link" href="registrarvista.php">Registrate </a></p>
                
            </div>

        </form>

    </body>
</html>