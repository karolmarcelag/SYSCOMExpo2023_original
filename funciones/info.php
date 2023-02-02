<?php

include "conexion.php";
require "openssl.php";

$idTaller = $_POST["id_taller"]; //azul variable nueva, lo naranja es el azul del script
$lecturaDesencriptada = Openssl::desencriptar($_POST["lectura"]);
$arreglo = json_decode($lecturaDesencriptada,true);

$correo = $arreglo[0]["correo"];

$query = "select c.id
from (expo.registros2023mx a inner join expo.talleres2023mx b) inner join expo.inscripcion_talleres2023mx c
on a.id = c.id_usuario and b.id = c.id_taller and a.correo = '$correo' and b.id = $idTaller;";
$consulta = mysqli_query($conexion,$query);
$registros = mysqli_num_rows($consulta);
if ($registros > 0)
{
    $arreglo[0]["respuesta"] = 1;
}
else
{
    $arreglo[0]["respuesta"] = -1;
}

echo json_encode($arreglo);
?>