<html>
    <head>
        <meta charset="utf-8">
        <title>SYSCOMEXPO 2023 - CDMX</title>
        <link rel="icon" href="https://www.syscom.mx/favico/syscom_favico.png">
        <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link href="estilos/estilo.css" rel="stylesheet">
        <script src="scripts/jquery-3.6.0.js"></script>
        <script src="scripts/jquery-3.6.0.min.js"></script>
        <script src="scripts/script.js"></script>
    </head>
    <body onload="cargarTalleresQR()">
        <div class="logo">
            <a href='https://expo.syscom.mx'><img src="imagenes/captura.png"></a></div><br>
        </div>
        <div class="info" id="info">
            <div class="datos">
                Seleccione Taller <span class='asterisco'>*</span><br>
                <select id='taller_seleccionado' onchange='taller_seleccionado()' style='padding:5px'>
                    <option value=''></option>
                </select>
                <div id='contenedorLectura' style='display:none'>
                    Lectura QR<br>
                    <input type="text" id="lectura_qr"><br>
                </div>
                <span id='accesoTaller'></span>
            </div>
        </div>
    </body>
</html>