<?php

require "conexion.php";
require "openssl.php";
date_default_timezone_set('America/mexico_city');

$lecturaEncriptada = $_POST["lectura"];
$fecha = date("Y-m-d"); 
$hora = date("H:i:s"); 

$lecturaDesencriptada = Openssl::desencriptar($lecturaEncriptada);
$arreglo = json_decode($lecturaDesencriptada,true);

$nombre = $arreglo[0]["nombre"];
$apellido = $arreglo[0]["apellido"];
$correo = $arreglo[0]["correo"];
$cargo = $arreglo[0]["cargo"];
$empresa = $arreglo[0]["empresa"];
$ciudad = $arreglo[0]["ciudad"];
$estado = $arreglo[0]["estado"];

if($nombre != "")
{
    $consulta = "insert into expo.asistentes2023mx (nombre,apellido,correo,cargo,empresa,fecha,hora) values ('$nombre','$apellido','$correo','$cargo','$empresa','$fecha','$hora')";
    mysqli_query($conexion,$consulta);
}

$arreglo2 = array();
$arreglo2[0]["nombre"] = $nombre;
$arreglo2[0]["apellido"] = $apellido;
$arreglo2[0]["correo"] = $correo;
$arreglo2[0]["cargo"] = $cargo;
$arreglo2[0]["empresa"] = $empresa;

echo json_encode($arreglo2);

?>