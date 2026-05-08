<?php

session_start();

include("php/conexion.php");

if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
}

$usuario_id = $_SESSION['usuario_id'];

$sqlIngresos = "SELECT SUM(monto) AS total
                FROM movimientos
                WHERE usuario_id='$usuario_id'
                AND tipo='ingreso'";

$resultadoIngresos = mysqli_query($conn, $sqlIngresos);
$filaIngresos = mysqli_fetch_assoc($resultadoIngresos);

$totalIngresos = $filaIngresos['total'] ?? 0;

$sqlGastos = "SELECT SUM(monto) AS total
              FROM movimientos
              WHERE usuario_id='$usuario_id'
              AND tipo='gasto'";

$resultadoGastos = mysqli_query($conn, $sqlGastos);
$filaGastos = mysqli_fetch_assoc($resultadoGastos);

$totalGastos = $filaGastos['total'] ?? 0;

$balance = $totalIngresos - $totalGastos;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="dashboard">

    <h1 class="section-title">
        Resumen Financiero
    </h1>

    <div class="movement">

        <div class="movement-left">

            <div class="movement-icon green">
                +
            </div>

            <div>
                <h3>Total Ingresos</h3>
                <p>Dinero recibido</p>
            </div>

        </div>

        <h2 class="amount-green">
            $<?php echo number_format($totalIngresos,2); ?>
        </h2>

    </div>

    <div class="movement">

        <div class="movement-left">

            <div class="movement-icon red">
                -
            </div>

            <div>
                <h3>Total Gastos</h3>
                <p>Dinero gastado</p>
            </div>

        </div>

        <h2 class="amount-red">
            $<?php echo number_format($totalGastos,2); ?>
        </h2>

    </div>

    <div class="movement">

        <div class="movement-left">

            <div class="movement-icon blue">
                $
            </div>

            <div>
                <h3>Balance Final</h3>
                <p>Saldo disponible</p>
            </div>

        </div>

        <h2 style="color:#2962ff;">
            $<?php echo number_format($balance,2); ?>
        </h2>

    </div>

    <div class="card" style="margin-top:30px; max-width:100%;">

        <h2 class="text-center" style="margin-bottom:25px;">
            Estadísticas
        </h2>

        <div style="
            width:100%;
            height:260px;
            display:flex;
            align-items:flex-end;
            justify-content:space-around;
            gap:20px;
        ">

            <div>

                <div style="
                    width:80px;
                    height:<?php echo ($totalIngresos/50); ?>px;
                    background:#00c853;
                    border-radius:20px 20px 0 0;
                "></div>

                <p class="text-center mt-20">
                    Ingresos
                </p>

            </div>

            <div>

                <div style="
                    width:80px;
                    height:<?php echo ($totalGastos/50); ?>px;
                    background:#ff1744;
                    border-radius:20px 20px 0 0;
                "></div>

                <p class="text-center mt-20">
                    Gastos
                </p>

            </div>

        </div>

    </div>

    <div style="margin-top:25px;">

        <a href="dashboard.php">
            <button class="btn btn-blue">
                Volver al Dashboard
            </button>
        </a>

    </div>

</div>

</body>
</html>