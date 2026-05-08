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

$saldo = $totalIngresos - $totalGastos;

$sqlMovimientos = "SELECT * FROM movimientos
                   WHERE usuario_id='$usuario_id'
                   ORDER BY id DESC";

$movimientos = mysqli_query($conn, $sqlMovimientos);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="dashboard">

<?php

if(isset($_GET['mensaje'])){

    if($_GET['mensaje']=="ingreso"){
        echo "
        <div style='
            background:#00c853;
            color:white;
            padding:15px;
            border-radius:15px;
            margin-bottom:20px;
            text-align:center;
            font-weight:bold;
        '>
            Ingreso guardado correctamente
        </div>
        ";
    }

    if($_GET['mensaje']=="gasto"){
        echo "
        <div style='
            background:#ff1744;
            color:white;
            padding:15px;
            border-radius:15px;
            margin-bottom:20px;
            text-align:center;
            font-weight:bold;
        '>
            Gasto guardado correctamente
        </div>
        ";
    }

}

?>

    <div class="balance-card">

        <h3 style="margin-bottom:15px;">
            Hola, <?php echo $_SESSION['usuario_nombre']; ?>
        </h3>

        <h2>Saldo disponible</h2>

        <div class="balance">
            $<?php echo number_format($saldo,2); ?>
        </div>

    </div>

    <div class="actions">

        <a href="ingreso.php">

            <div class="action-card">

                <div class="action-icon green">
                    +
                </div>

                <h3>Ingreso</h3>

            </div>

        </a>

        <a href="gasto.php">

            <div class="action-card">

                <div class="action-icon red">
                    -
                </div>

                <h3>Gasto</h3>

            </div>

        </a>

        <a href="resumen.php">

            <div class="action-card">

                <div class="action-icon blue">
                    📊
                </div>

                <h3>Resumen</h3>

            </div>

        </a>

    </div>

    <h2 class="section-title">
        Movimientos recientes
    </h2>

    <?php while($mov = mysqli_fetch_assoc($movimientos)){ ?>

        <div class="movement">

            <div class="movement-left">

                <div class="movement-icon
                <?php
                    if($mov['tipo']=="ingreso"){
                        echo "green";
                    }else{
                        echo "red";
                    }
                ?>
                ">

                <?php
                    if($mov['tipo']=="ingreso"){
                        echo "+";
                    }else{
                        echo "-";
                    }
                ?>

                </div>

                <div>

                    <h3>
                        <?php echo $mov['descripcion']; ?>
                    </h3>

                    <p>
                        <?php echo $mov['fecha']; ?>
                    </p>

                </div>

            </div>

            <h2 class="
            <?php
                if($mov['tipo']=="ingreso"){
                    echo "amount-green";
                }else{
                    echo "amount-red";
                }
            ?>
            ">

            <?php
                if($mov['tipo']=="ingreso"){
                    echo "+";
                }else{
                    echo "-";
                }
            ?>

            $<?php echo number_format($mov['monto'],2); ?>

            </h2>

        </div>

    <?php } ?>

</div>

<div style="padding:20px;">

    <a href="logout.php">
        <button class="btn btn-red">
            Cerrar Sesión
        </button>
    </a>

</div>

</body>
</html>