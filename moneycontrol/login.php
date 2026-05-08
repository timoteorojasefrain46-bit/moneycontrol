<<?php

session_start();

include("php/conexion.php");

if(isset($_POST['login'])){

    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios
            WHERE correo='$correo'";

    $resultado = mysqli_query($conn, $sql);

    if(mysqli_num_rows($resultado) > 0){

        $fila = mysqli_fetch_assoc($resultado);

        if(password_verify($password, $fila['password'])){

            $_SESSION['usuario_id'] = $fila['id'];
            $_SESSION['usuario_nombre'] = $fila['nombre'];

            header("Location: dashboard.php");

        }else{

            $error = "Contraseña incorrecta";

        }

    }else{

        $error = "Usuario no encontrado";

    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <div class="card">

        <div class="logo">
            🐷
        </div>

        <?php
        if(isset($error)){
            echo "<p style='color:red; text-align:center; margin-bottom:15px;'>$error</p>";
        }
        ?>

        <form method="POST">

            <div class="input-group">
                <label>Correo electrónico</label>
                <input type="email" name="correo" required>
            </div>

            <div class="input-group">
                <label>Contraseña</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" name="login" class="btn btn-blue">
                Iniciar Sesión
            </button>

        </form>

        <p class="text-center mt-20">
            ¿No tienes cuenta?
            <a href="registro.php" class="link">
                Regístrate
            </a>
        </p>

    </div>

</div>

</body>
</html>