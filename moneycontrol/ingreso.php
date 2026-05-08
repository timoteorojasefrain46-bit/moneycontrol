<?php

session_start();

include("php/conexion.php");

if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
}

if(isset($_POST['guardar'])){

    $usuario_id = $_SESSION['usuario_id'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];

    $sql = "INSERT INTO movimientos
            (usuario_id, tipo, monto, descripcion, fecha)

            VALUES

            ('$usuario_id','ingreso','$monto','$descripcion','$fecha')";

    mysqli_query($conn, $sql);

    header("Location: dashboard.php?mensaje=ingreso");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Ingreso</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <div class="card">

        <div class="action-icon green" style="margin:0 auto 25px;">
            +
        </div>

        <form method="POST">

            <div class="input-group">
                <label>Monto</label>
                <input type="number" step="0.01" name="monto" required>
            </div>

            <div class="input-group">
                <label>Descripción</label>
                <input type="text" name="descripcion">
            </div>

            <div class="input-group">
                <label>Fecha</label>
                <input type="date" name="fecha" required>
            </div>

            <button type="submit" name="guardar" class="btn btn-green">
                Guardar Ingreso
            </button>

        </form>

        <div style="margin-top:20px;">

            <a href="dashboard.php">
                <button type="button" class="btn btn-blue">
                    Volver
                </button>
            </a>

        </div>

    </div>

</div>

</body>
</html>