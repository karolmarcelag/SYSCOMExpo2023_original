<?php

include "conexion.php";
$correo = $_POST["correo"];

$query = "select id from expo.registros2023mx where correo='$correo';";
$consulta = mysqli_query($conexion,$query);
$registros = mysqli_num_rows($consulta);
if ($registros > 0)
{
    $tabla = mysqli_fetch_array($consulta);
    echo $tabla["id"];
}
else
{
    echo "-1";
}

?>