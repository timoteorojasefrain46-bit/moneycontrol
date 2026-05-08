<?php

include("php/conexion.php");

if(isset($_POST['registrar'])){

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios(nombre, correo, password)
            VALUES('$nombre','$correo','$password')";

    mysqli_query($conn, $sql);

    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <div class="card">

        <div class="logo">
            🐷
        </div>

        <form method="POST">

            <div class="input-group">
                <label>Nombre completo</label>
                <input type="text" name="nombre" required>
            </div>

            <div class="input-group">
                <label>Correo electrónico</label>
                <input type="email" name="correo" required>
            </div>

            <div class="input-group">
                <label>Contraseña</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" name="registrar" class="btn btn-green">
                Crear Cuenta
            </button>

        </form>

        <p class="text-center mt-20">
            ¿Ya tienes cuenta?
            <a href="login.php" class="link">
                Inicia sesión
            </a>
        </p>

    </div>

</div>
<script src="js/app.js"></script>

</body>
</html>