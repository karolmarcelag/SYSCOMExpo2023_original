<?php

include "conexion.php";
$correo = $_POST["correo"];
$arreglo = array();

$query = "select nombre, empresa from expo.resgistros2023mx where correo='$correo' order by id desc limit 1;";
$consulta = mysqli_query($conexion,$query);
$tabla = mysqli_fetch_array($consulta);

$arreglo[0]["nombre"] = $tabla["nombre"];
$arreglo[0]["empresa"] = $tabla["empresa"];

echo json_encode($arreglo);

?>