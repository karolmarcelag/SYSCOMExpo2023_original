<?php

include "conexion.php";

$arreglo = array();
$x=0;
$IdUsuario = $_POST["id_usuario"]; //azul variable nueva, lo naranja es el azul del script

$query = "select b.hora, b.dia, b.titulo, b.instructor, b.sala, c.id
from (expo.registros2023mx a inner join expo.talleres2023mx b) inner join expo.inscripcion_talleres2023mx c
on a.id = c.id_usuario and b.id = id_taller and id_usuario = $IdUsuario;";
$consulta = mysqli_query($conexion,$query);
while($tabla = mysqli_fetch_array($consulta))
{
    $arreglo[$x]["dia"] = $tabla["dia"];
    $arreglo[$x]["hora"] = $tabla["hora"];
    $arreglo[$x]["titulo"] = $tabla["titulo"];
    $arreglo[$x]["instructor"] = $tabla["instructor"];
    $arreglo[$x]["sala"] = $tabla["sala"];
    $arreglo[$x]["id"] = $tabla["id"];
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