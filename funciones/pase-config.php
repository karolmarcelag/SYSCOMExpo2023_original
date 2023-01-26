<html>
    <head>
        <meta charset="utf-8">
        <title>Pase SYSCOMExpo 2023</title>
        <link rel="icon" href="https://www.syscom.mx/favico/syscom_favico.png">
        <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <style>
        body
        {
            font-family: system-ui;
        }
        div
        {
            text-align: center;
        }
        .nombre, .apellido
        {
            margin-top: 43%;
            font-size: 20px;
            width: 95%;
            margin-left: 2.5%;
            text-align: center;
            top: 0;
            left: 0;
            position: absolute;
        }
        .apellido
        {
            margin-top: 53%;
        }
        .empresa
        {
            margin-top: 69%;
            margin-left: 5%;
            font-size: 10px;
            width: 90%;
            text-align: center;
            left: 0;
            top: 0;
            position: absolute;
        }
        .imagen
        {
            margin-top: 88%;
            text-align: center;
            width: 60%;
        }
        .expo
        {
            margin-top: -2%;
            font-size: 8px;
        }
        </style>
    </head>

    <body onload="window.print();">
        <!--<img src="fondo.jpg" class="fondo">-->
        <div class="cuadroInfo">
            <div class="nombre">Karol Marcela</div>
            <div class="apellido">Gutiérrez Prieto</div>
            <div class="empresa">Sistemas y Servicios de Comunicación S.A. de C.V.</div>
            <?php
            echo "<img class='imagen' src='https://expo.syscom.mx/syscomexpo2023cdmx/codigos/karol.gutierrez@syscom.mx.png'>"
            ?>
            <div class="expo">SYSCOM Expo 2022 CDMX</div>
        </div>
    </body>
</html>