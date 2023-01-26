<?php

$tipo = $_GET["type"];

include "../funciones/conexion.php";

switch($tipo)
{
    case "table":
        {
            $query1 = "select nombre, apellido, correo, cargo, rfc, empresa, cuenta, ciudad, estado, telefono, fecha
            from expo.registros2023mx";
            $consulta1 = mysqli_query($conexion,$query1);
            
            $codigo = "
            <table>
                <tr>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Correo</td>
                    <td>Cargo</td>
                    <td>RFC</td>
                    <td>Empresa</td>
                    <td>No. Cliente</td>
                    <td>Ciudad</td>
                    <td>Estado</td>
                    <td>Teléfono</td>
                    <td>Fecha</td>
                </tr>
            ";
            while($tabla1 = mysqli_fetch_array($consulta1))
            {
                $codigo.="
                <tr>
                    <td>".$tabla1["nombre"]."</td>
                    <td>".$tabla1["apellido"]."</td>
                    <td>".$tabla1["correo"]."</td>
                    <td>".$tabla1["cargo"]."</td>
                    <td>".$tabla1["rfc"]."</td>
                    <td>".$tabla1["empresa"]."</td>
                    <td>".$tabla1["cuenta"]."</td>
                    <td>".$tabla1["ciudad"]."</td>
                    <td>".$tabla1["estado"]."</td>
                    <td>".str_replace("+52","",$tabla1["telefono"])."</td>
                    <td>".$tabla1["fecha"]."</td>
                </tr>
                ";
            }
            $codigo.="
            </table>
            ";
            
            echo $codigo;
        }
        break;
    case "json":
        {
            $arreglo = array();
            $x=0;

            $query1 = "select nombre, apellido, correo, cargo, rfc, empresa, cuenta, ciudad, estado, telefono, fecha
            from expo.registros2023mx";
            $consulta1 = mysqli_query($conexion,$query1);

            while($tabla1 = mysqli_fetch_array($consulta1))
            {
                $arreglo[$x]["nombre"] = $tabla1["nombre"];
                $arreglo[$x]["apellido"] = $tabla1["apellido"];
                $arreglo[$x]["correo"] = $tabla1["correo"];
                $arreglo[$x]["cargo"] = $tabla1["cargo"];
                $arreglo[$x]["rfc"] = $tabla1["rfc"];
                $arreglo[$x]["empresa"] = $tabla1["empresa"];
                $arreglo[$x]["no_cliente"] = $tabla1["cuenta"];
                $arreglo[$x]["ciudad"] = $tabla1["ciudad"];
                $arreglo[$x]["estado"] = $tabla1["estado"];
                $arreglo[$x]["telefono"] = $tabla1["telefono"];
                $arreglo[$x]["fecha"] = date("Y-m-d",strtotime($tabla1["fecha"]));
                $x++;
            }

            echo json_encode($arreglo);
        }
        break;
    case "excel":
        {
            echo "<meta charset='utf-8'>";
            
            $nombre_archivo = "registros_clientes";

            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=$nombre_archivo.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            $query1 = "select nombre, apellido, correo, cargo, rfc, empresa, cuenta, ciudad, estado, telefono, fecha
            from expo.registros2023mx";
            $consulta1 = mysqli_query($conexion,$query1);
            
            $codigo = "
            <table>
                <tr>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Correo</td>
                    <td>Cargo</td>
                    <td>RFC</td>
                    <td>Empresa</td>
                    <td>No. Cliente</td>
                    <td>Ciudad</td>
                    <td>Estado</td>
                    <td>Teléfono</td>
                    <td>Fecha</td>
                </tr>
            ";
            while($tabla1 = mysqli_fetch_array($consulta1))
            {
                $codigo.="
                <tr>
                    <td>".$tabla1["nombre"]."</td>
                    <td>".$tabla1["apellido"]."</td>
                    <td>".$tabla1["correo"]."</td>
                    <td>".$tabla1["cargo"]."</td>
                    <td>".$tabla1["rfc"]."</td>
                    <td>".$tabla1["empresa"]."</td>
                    <td>".$tabla1["cuenta"]."</td>
                    <td>".$tabla1["ciudad"]."</td>
                    <td>".$tabla1["estado"]."</td>
                    <td>".str_replace("+52","",$tabla1["telefono"])."</td>
                    <td>".$tabla1["fecha"]."</td>
                </tr>
                ";
            }
            $codigo.="
            </table>
            ";
            
            echo $codigo;
        }
        break;
        default:
        {
            header("Location: https://syscom.mx");
        }
        break;
}