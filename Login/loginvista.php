<?php
include '../Admin/basedatos/conexion.php';

session_start();

if ($_POST) {
    $conec = connection::conectar(); 
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    $stmt = $conec->prepare("SELECT id, usuario, contraseña, Admin FROM usuarios WHERE usuario = ? AND contraseña = ?");
    $stmt->bind_param("ss", $usuario, $contraseña);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row == null) {
        $error = "Usuario o contraseña incorrectos";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Mi Bar</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../PagPrincipal/CSS/modern-style.css">

    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('../Imagenes/Fondo Web PC.jpg');
            background-size: cover;
            background-position: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 3rem;
            border-radius: 25px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 450px;
            animation: fadeInUp 0.8s ease;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-header h1 {
            font-size: 2rem;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .input-group input {
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #eee;
            border-radius: 12px;
            transition: var(--transition);
        }

        .input-group input:focus {
            border-color: var(--accent);
            background: white;
            outline: none;
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            font-size: 1rem;
            margin-top: 1rem;
        }

        .login-footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #666;
        }

        .login-footer a {
            color: var(--accent);
            font-weight: 700;
            text-decoration: none;
        }

        .error-msg {
            background: #ffeaea;
            color: var(--accent);
            padding: 0.8rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <a href="../index.php" style="text-decoration: none; color: var(--accent); font-weight: 900; font-size: 1.5rem;">Mi Bar.</a>
            <h1>Bienvenido</h1>
            <p style="color: #666;">Ingresa tus credenciales</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="error-msg">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="loginvista.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Usuario" name="usuario" required>
            </div>
            
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Contraseña" name="contraseña" required>
            </div>

            <button type="submit" class="btn btn-login">Entrar</button>
        </form>

        <div class="login-footer">
            <p>¿No tienes una cuenta? <a href="registrarvista.php">Regístrate aquí</a></p>
            <p style="margin-top: 1rem; opacity: 0.5;"><a href="../index.php" style="color: #666; font-weight: 400;">← Volver al inicio</a></p>
        </div>
    </div>

</body>
</html>
