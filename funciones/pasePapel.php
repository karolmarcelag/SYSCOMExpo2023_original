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
        .cuadroInfo
        {
            width: 50%;
            transform: rotate(-90deg);
            margin-left: 20%;
            margin-top: -23%;
        }
        .cuadroDos
        {
            margin-top: 30%;
        }
        .nombre
        {
            font-size: 35px;
            width: 100%;
            text-align: center;
            top: 0;
            left: 0;
            position: absolute;
            margin-top: 60%;
            margin-left: -40%;
            font-weight: bold;
        }
        .apellido, .empresa, .cargo
        {
            font-size: 17px;
            width: 90%;
            text-align: center;
            left: 0;
            top: 0;
            position: absolute;
            margin-left: -35%;
        }
        .apellido
        {
            margin-top: 76%;
            font-size: 25px;
            font-weight: bold;
        }
        .empresa
        {
            margin-top: 99%;
        }
        .cargo
        {
            margin-top: 146%;
            margin-left: -53%;
            text-align: center;
            width: 40%;
            font-size: 14px;
        }
        .imagen
        {
            margin-top: 140%;
            text-align: center;
            margin-left: 40%;
            width: 40%;
        }
        </style>
    </head>

    <body onload="window.print(); window.close();">
    <!--<body onload="window.print();">-->
        <!--<img src="fondo.jpg" class="fondo">-->
        <div class="cuadroInfo">
            <div class="nombre"><?php echo $_GET["nombre"] ?></div>
            <div class="apellido"><?php echo $_GET["apellido"] ?></div>
            <div class="empresa"><?php echo $_GET["empresa"] ?></div>
            <div class="cargo"><?php echo $_GET["cargo"] ?></div>
            <?php
            echo "<img class='imagen' src='../codigos/".$_GET["correo"].".png'>"
            ?>
        </div>
        <div class="cuadroInfo">
            <div class=cuadroDos>
                <div class="nombre"><?php echo $_GET["nombre"] ?></div>
                <div class="apellido"><?php echo $_GET["apellido"] ?></div>
                <div class="empresa"><?php echo $_GET["empresa"] ?></div>
                <div class="cargo"><?php echo $_GET["cargo"] ?></div>
                <?php
                echo "<img class='imagen' src='../codigos/".$_GET["correo"].".png'>"
                ?>
            </div>
        </div>
    </body>
</html>