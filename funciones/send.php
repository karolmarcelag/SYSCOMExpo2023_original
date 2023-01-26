<?php

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$cargo = $_POST["cargo"];
$empresa = $_POST["empresa"];
$notas = $_POST["notas"];
$correoExpositor = $_POST["correoExpositor"];

$para = "$correoExpositor,$correo";
$fecha = date("Y-m-d"); 
$hora = date("H:i:s"); 

//guardar nota
include "conexion.php";
$consulta = "insert into expo.notas2023mx (fecha,hora,nombre,correo,cargo,empresa,capturado_por,nota) values ('$fecha','$hora','$nombre','$correo','$cargo','$empresa','$correoExpositor','$notas');";
mysqli_query($conexion,$consulta);

$titulo = "$fecha $hora | Notas SYSCOMEXPO 2023 - CDMX";
$mensaje = "

<html>
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>
        <title>Notas SYSCOMEXPO 2023 - CDMX</title>
        <style>
            .cuerpo 
            {
                font-family: 'Arial', sans-serif;
                font-size:13px;
                background: #1E1E1D;
                color: #fff;
                width:100%;
                top:0;
                left:0;
                position: absolute;
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
                text-align: left;
            }
        </style>
    </head>
    <body>
        <div style='width:100%; height:20px'></div>
        <div class='cuerpo'>
            <br><br>
            <div class='contenido'>
                <div style='margin-top: 10px;' class='mensaje'>
                    <b>Nombre:</b> $nombre<br>
                    <b>Correo:</b> $correo<br>
                    <b>Cargo:</b> $cargo<br>
                    <b>Empresa:</b> $empresa<br>
                </div>
                <div style='margin-bottom: 10px;' class='mensaje'>
                    <b>Notas:</b>
                    <br>$notas
                </div>
            </div>
            <div class='fuera'>
                <p class='titulo2'>
                    <b style='color:#fff'>Dirija sus respuestas al correo $correoExpositor.</b>
                    <br><br>
                    Correo enviado por el departamento de Ingeniería SYSCOM
                    <br>
                </p>
            </div>
        </div>
    </body>
</html>";

$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$cabeceras .= 'From: SYSCOMEXPO <expo@syscom.mx>' . "\r\n";
mail($para,'=?UTF-8?B?'.base64_encode($titulo).'?=', $mensaje,$cabeceras);

echo "1";

?>