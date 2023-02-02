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

$arreglo2 = array();

if($nombre != "")
{
    $query = "select cuenta from expo.registros2023mx where correo = '$correo'";
    $consulta = mysqli_query($conexion,$query);
    $tabla = mysqli_fetch_array($consulta);
    if($tabla["cuenta"] == 100)
    {
        $arreglo2[0]["empresa"] = "<h1>INVITADO</h1>";
    }
    else
    {
        $arreglo2[0]["empresa"] = $empresa;
    }

    $consulta2 = "insert into expo.asistentes2023mx (nombre,apellido,correo,cargo,empresa,fecha,hora) values ('$nombre','$apellido','$correo','$cargo','$empresa','$fecha','$hora')";
    mysqli_query($conexion,$consulta2);
}
else
{
    $arreglo2[0]["empresa"] = $empresa;  
}

$arreglo2[0]["nombre"] = $nombre;
$arreglo2[0]["apellido"] = $apellido;
$arreglo2[0]["correo"] = $correo;
$arreglo2[0]["cargo"] = $cargo;

echo json_encode($arreglo2);

?>