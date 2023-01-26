<?php
include "../funciones/conexion.php";
require "../funciones/openssl.php";

$lecturaEncriptada = str_replace(" ","+",$_GET["valor"]);
$correoExpositor = $_GET["correo"];
$arreglo = array();

$lecturaDesencriptada = Openssl::desencriptar($lecturaEncriptada);
$arreglo = json_decode($lecturaDesencriptada,true);

$nombre = $arreglo[0]["nombre"];
$apellido = $arreglo[0]["apellido"];
$correo = $arreglo[0]["correo"];
$cargo = $arreglo[0]["cargo"];
$empresa = $arreglo[0]["empresa"];
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Datos de Contacto</title>
        <link rel="icon" href="https://www.syscom.mx/favico/syscom_favico.png">
        <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link href="../estilos/estilo.css" rel="stylesheet">
        <script src="../scripts/jquery-3.6.0.js"></script>
        <script src="../scripts/jquery-3.6.0.min.js"></script>
        <script src="../scripts/script.js"></script>
    </head>
    <body>
        <div class="logo2" style="background:#1e1e1e;">
            <a href='https://expo.syscom.mx'><img src="../imagenes/captura.png"></a></div><br>
        </div>          
        <div class="info">
            <div class="datos">
                <div class="nombre">
                    Nombre: <br><input type="text" id="nombre" value="<?php echo $nombre." ".$apellido;?>" disabled><br>
                </div>
                <div class="correo">
                    Correo: <br><input type="email" id="correo" value="<?php echo $correo;?>" disabled><br>
                </div>
                <div class="cargo">
                    Cargo: <br><input type="text" id="cargo" value="<?php echo $cargo;?>" disabled><br>
                </div>
                <div class="empresa">
                    Empresa: <br><input type="text" id="empresa" value="<?php echo $empresa;?>" disabled><br>
                </div>
            </div>
            <div>
                Notas: <br><textarea id="notas" class='notas'></textarea>
            </div> 
            <input type='hidden' id='correoExpositor' value='<?php echo $correoExpositor;?>'>
            <button id="enviarCorreo">Enviar</button>
        </div>
    </body>
</html>