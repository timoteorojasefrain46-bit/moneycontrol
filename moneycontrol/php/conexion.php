<?php

if ($_SERVER['HTTP_HOST'] == "localhost") {
    $host = "localhost";
    $usuario = "root";
    $password = "";
    $basedatos = "moneycontrol";
} else {
    $host = "sql302.infinityfree.com";
    $usuario = "if0_41861608";
    $password = "TU_PASSWORD";
    $basedatos = "if0_41861608_moneycontrol";
}

$conn = mysqli_connect($host, $usuario, $password, $basedatos);

?>