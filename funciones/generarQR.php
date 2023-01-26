<?php

include "openssl.php";
require "../phpqrcode/qrlib.php";
date_default_timezone_set('America/Chihuahua');

$arreglo = array();
$dir = '../codigos/';
$nombreQR = $_POST["correo"];
$info = array();
$info[0]["nombre"] = $_POST["nombre"];
$info[0]["apellido"] = $_POST["apellido"];
$info[0]["correo"] = $_POST["correo"];
$info[0]["cargo"] = $_POST["cargo"];
$info[0]["empresa"] = $_POST["empresa"];

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

echo json_encode($arreglo);

//enviar correo
$para = $info[0]["correo"];
$url = "https://expo.syscom.mx/syscomexpo2023cdmx/codigos/$para.png";


$titulo = "Registro SYSCOMEXPO 2023 - CDMX";
$mensaje = "
<html>
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>
        <title>Registro SYSCOMEXPO 2023 - CDMX</title>
        <style>
                .cuerpo 
                {
                        font-family: 'Arial', sans-serif;
                        font-size:14px;
                        background: #1E1E1D;
                        color: #fff;
                        width:100%;
                        top:0;
                        left:0;
                        position: absolute;
                }
                b
                {
                        color:#fff;
                }
                .titulo1 {text-align:center;}
                .titulo2 {text-align:center;}
                .contenido
                {
                        width: 80%;
                        margin-left: 10%;
                        background: #FFF;
                        padding: 8px;
                        line-height: 1.8;
                        color: #000;
                        border-radius: 3px;
                }
                .fuera
                {
                        width:80%;
                        margin-left:10%;
                        padding:8px;
                }
                .liga_noti
                {
                        width: 60%;
                        margin-left: 20%;
                        height: 35px;
                        border: none;
                        background: #d2d2d2;
                        color: #000;
                        font-weight: bold;
                }
                .logo
                {
                        width: 20%;
                        margin-left: 40%;
                }
                .mensaje
                {
                        width: 100%;
                        text-align: center;
                }
        </style>
    </head>
    <body>
        <br><br>
        <div class='cuerpo'>
            <div class='contenido'>
                <img style='width:100%' src='https://ftp3.syscom.mx/usuarios/ftp/single_page/syscomexpo/2023/SYSCOMEXPO-CDMX-23.jpg'>
                <div style='margin-top: 10px;' class='mensaje'>Este es su pase al evento</div>
                <img style='width:60%; margin-left:20%;' src='$url'>
                <div style='margin-bottom: 10px;' class='mensaje'>¡Nos vemos pronto!</div>
                <img style='width:100%;' src='https://ftp3.syscom.mx/usuarios/ftp/single_page/syscomexpo/2023/HEADER-SIDE.jpg'>
            </div>
            <div class='fuera'>
                <p class='titulo2'>
                    <b>No responda a este correo.</b>
                    <br><br>
                    Correo enviado por el departamento de Mercadotecnia
                    <br>
                </p>
            </div>
        </div>
    </body>
</html>";

$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$cabeceras .= 'Reply-to: Ventas <ventas@syscom.mx>'."\r\n";
$cabeceras .= 'From: SYSCOMEXPO <expo@syscom.mx>' . "\r\n";
mail($para,'=?UTF-8?B?'.base64_encode($titulo).'?=', $mensaje,$cabeceras);

?>