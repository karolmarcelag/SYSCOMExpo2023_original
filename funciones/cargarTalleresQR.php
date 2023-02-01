<?php
include "conexion.php";

$arreglo = array();
$x=0;

$query = "SELECT * FROM expo.talleres2023mx;";
$consulta = mysqli_query($conexion,$query);
while($tabla = mysqli_fetch_array($consulta))
{
    $arreglo[$x]["id"] = $tabla["id"];
    $arreglo[$x]["dia"] = $tabla["dia"];
    $arreglo[$x]["hora"] = $tabla["hora"];
    $arreglo[$x]["titulo"] = $tabla["titulo"];
    $x++;
}

if($x>0)
{
    echo json_encode($arreglo);
}
else
{
    echo "-1";
}