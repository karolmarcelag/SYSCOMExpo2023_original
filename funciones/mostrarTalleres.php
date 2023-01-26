<?php
include "conexion.php";

$IdUsuario = $_POST["id_usuario"]; //azul variable nueva, lo naranja es el azul del script
$arreglo = array();
$x=0;

//$query = "select id, dia, hora, titulo, instructor, sala, capacidad from expo.talleres2023mx;";
$query = "SELECT a.* FROM expo.talleres2023mx a WHERE NOT EXISTS (SELECT b.* FROM expo.inscripcion_talleres2023mx b WHERE a.id=b.id_taller and id_usuario=$IdUsuario);";
$consulta = mysqli_query($conexion,$query);
while($tabla = mysqli_fetch_array($consulta))
{
    $query2 = "select id_taller from expo.inscripcion_talleres2023mx where id_taller = ".$tabla["id"].";";
    $consulta2 = mysqli_query($conexion,$query2);
    $registros = mysqli_num_rows($consulta2);
    if ($registros == 0)
    { 
        $arreglo[$x]["registrados"] = 0;
    }
    else
    {
        $arreglo[$x]["registrados"] = $registros;
    }

    $arreglo[$x]["id"] = $tabla["id"];
    $arreglo[$x]["dia"] = $tabla["dia"];
    $arreglo[$x]["hora"] = $tabla["hora"];
    $arreglo[$x]["titulo"] = $tabla["titulo"];
    $arreglo[$x]["instructor"] = $tabla["instructor"];
    $arreglo[$x]["sala"] = $tabla["sala"];
    $arreglo[$x]["capacidad"] = intval($tabla["capacidad"]);
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