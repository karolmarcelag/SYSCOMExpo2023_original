<?php 
include "conexion.php";
date_default_timezone_set('America/mexico_city');

$arreglo = array();
$x = 0;

for($x=0; $x<12; $x++)
{
    $arreglo["datos"][$x]["hora"] = 8+$x;
    $arreglo["datos"][$x]["dia1"] = 0;
    $arreglo["datos"][$x]["dia2"] = 0;
    $arreglo["datos"][$x]["dia3"] = 0;
}

$query = "
select fecha, time_format(hora, '%H') as 'hora' , count(time_format(hora, '%H')) as 'cantidad'
from expo.asistentes2023mx
group by fecha, time_format(hora, '%H') order by fecha, hora;";
$consulta = mysqli_query($conexion,$query);
while($tabla = mysqli_fetch_array($consulta))
{
    switch($tabla["fecha"])
    {
        case '2023-03-09':
            {
                switch(intval($tabla["hora"]))
                {
                    case 8: {$arreglo["datos"][0]["dia1"] = intval($tabla["cantidad"]);} break;
                    case 9: {$arreglo["datos"][1]["dia1"] = intval($tabla["cantidad"]);} break;
                    case 10: {$arreglo["datos"][2]["dia1"] = intval($tabla["cantidad"]);} break;
                    case 11: {$arreglo["datos"][3]["dia1"] = intval($tabla["cantidad"]);} break;
                    case 12: {$arreglo["datos"][4]["dia1"] = intval($tabla["cantidad"]);} break;
                    case 13: {$arreglo["datos"][5]["dia1"] = intval($tabla["cantidad"]);} break;
                    case 14: {$arreglo["datos"][6]["dia1"] = intval($tabla["cantidad"]);} break;
                    case 15: {$arreglo["datos"][7]["dia1"] = intval($tabla["cantidad"]);} break;
                    case 16: {$arreglo["datos"][8]["dia1"] = intval($tabla["cantidad"]);} break;
                    case 17: {$arreglo["datos"][9]["dia1"] = intval($tabla["cantidad"]);} break;
                    case 18: {$arreglo["datos"][10]["dia1"] = intval($tabla["cantidad"]);} break;
                    case 19: {$arreglo["datos"][11]["dia1"] = intval($tabla["cantidad"]);} break;
                }
            }
            break;
        case '2023-03-08':
            {
                switch(intval($tabla["hora"]))
                {
                    case 8: {$arreglo["datos"][0]["dia2"] = intval($tabla["cantidad"]);} break;
                    case 9: {$arreglo["datos"][1]["dia2"] = intval($tabla["cantidad"]);} break;
                    case 10: {$arreglo["datos"][2]["dia2"] = intval($tabla["cantidad"]);} break;
                    case 11: {$arreglo["datos"][3]["dia2"] = intval($tabla["cantidad"]);} break;
                    case 12: {$arreglo["datos"][4]["dia2"] = intval($tabla["cantidad"]);} break;
                    case 13: {$arreglo["datos"][5]["dia2"] = intval($tabla["cantidad"]);} break;
                    case 14: {$arreglo["datos"][6]["dia2"] = intval($tabla["cantidad"]);} break;
                    case 15: {$arreglo["datos"][7]["dia2"] = intval($tabla["cantidad"]);} break;
                    case 16: {$arreglo["datos"][8]["dia2"] = intval($tabla["cantidad"]);} break;
                    case 17: {$arreglo["datos"][9]["dia2"] = intval($tabla["cantidad"]);} break;
                    case 18: {$arreglo["datos"][10]["dia2"] = intval($tabla["cantidad"]);} break;
                    case 19: {$arreglo["datos"][11]["dia2"] = intval($tabla["cantidad"]);} break;
                }
            }
            break;
    }
}

//Cantidad de registros
$query2 = "select count(id) as 'cantidadRegistros' from expo.registros2023mx;";
$consulta2 = mysqli_query($conexion,$query2);
$tabla2 = mysqli_fetch_array($consulta2);

$arreglo["cantidad"][0]["registros"] = $tabla2["cantidadRegistros"];

//Cantidad de asistentes
$query3 = "select count(id) as 'cantidadAsistentes' from expo.asistentes2023mx where fecha='2023-03-08';";
$consulta3 = mysqli_query($conexion,$query3);
$tabla3 = mysqli_fetch_array($consulta3);

$arreglo["cantidad"][0]["asistentesUno"] = $tabla3["cantidadAsistentes"];

$query4 = "select count(id) as 'cantidadAsistentes' from expo.asistentes2023mx where fecha='2023-03-09';";
$consulta4 = mysqli_query($conexion,$query4);
$tabla4 = mysqli_fetch_array($consulta4);

$arreglo["cantidad"][0]["asistentesDos"] = $tabla4["cantidadAsistentes"];

if($x>0)
{
    echo json_encode($arreglo);
}
else
{
    echo "-1";
}
?>
