<?php

include "conexion.php";
$correo = $_POST["correo"];

$query = "select * from expo.registros2023mx where correo='$correo';";
$consulta = mysqli_query($conexion,$query);
$registros = mysqli_num_rows($consulta);
if ($registros > 0)
{ 
        $tabla = mysqli_fetch_array($consulta);
        include "openssl.php";
        require "../phpqrcode/qrlib.php";
        date_default_timezone_set('America/Chihuahua');

        $arreglo = array();
        $dir = '../codigos/';
        $nombreQR = $_POST["correo"];
        $info = array();
        $info[0]["nombre"] = $tabla["nombre"];
        $info[0]["apellido"] = $tabla["apellido"];
        $info[0]["correo"] = $tabla["correo"];
        $info[0]["cargo"] = $tabla["cargo"];
        $info[0]["empresa"] = $tabla["empresa"];
        $info[0]["ciudad"] = $tabla["ciudad"];
        $info[0]["estado"] = $tabla["estado"];

        $json = json_encode($info);
        $jsonEncriptado = Openssl::encriptar($json);
        $contenidoQR = $jsonEncriptado;

        if (!file_exists($dir))
        {
                mkdir($dir); 
        }

        $filename = $dir.$nombreQR.'.png';

        $tamaño = 11; //Tamaño de Pixel
        $level = 'A'; //Precisión Baja
        $framSize = 5; //Tamaño en blanco

        QRcode::png($contenidoQR, $filename, $level, $tamaño, $framSize); 

        $url = "codigos/".$nombreQR.'.png';
        $arreglo[0]["url"] = $url;
        $arreglo[0]["respuesta"] = "1";

        echo json_encode($arreglo);
}
else
{
        $arreglo[0]["respuesta"] = "-1";
        echo json_encode($arreglo);
}

?>