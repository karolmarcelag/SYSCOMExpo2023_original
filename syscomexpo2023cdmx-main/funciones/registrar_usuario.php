<?php

require "conexion.php";

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$correo = $_POST["correo"];
$cargo = $_POST["cargo"];
$rfc = $_POST["rfc"];
$empresa = $_POST["empresa"];
$cuenta = $_POST["cuenta"];
$pais = $_POST["pais"];
if($pais == "MX")
{
    $estado = $_POST["estado"];
    $ciudad = $_POST["ciudad"];
}
else
{
    $estado = $pais;
    $ciudad = $pais;
}
$telefono = $_POST["telefono"];
$fecha = date("d-m-Y"); 

$query0 = "select id from expo.registros2023mx where correo = '$correo';";
$consulta0 = mysqli_query($conexion,$query0);
$registros0 = mysqli_num_rows($consulta0);

if ($registros0 == 0)
{ 
    $consulta = "insert into expo.registros2023mx (nombre,apellido,correo,cargo,rfc,empresa,cuenta,pais,estado,ciudad,telefono,fecha) values ('$nombre','$apellido','$correo','$cargo','$rfc','$empresa','$cuenta','$pais','$estado','$ciudad','$telefono','$fecha')";
    mysqli_query($conexion,$consulta);
    
    echo "1";
}
else
{
    echo "-1";
}

?>