<html>
  <head>
    <title>Escaner QR</title>
    <meta charset="utf-8">
    <link rel="icon" href="https://www.syscom.mx/favico/syscom_favico.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="javascript/adapter.min.js"></script>
    <script type="text/javascript" src="javascript/vue.min.js"></script>
    <script type="text/javascript" src="javascript/instascan.min.js"></script>
    <?php 
    $correo = $_GET["mail"];
    echo "
    <script>
      var correo = '$correo'
    </script>
    ";
    ?>
  </head>
  <body>
    <div id="app">
      <div class="sidebar">
        <section class="cameras">
          <h2>Cámaras</h2>
          <ul>
            <li v-if="cameras.length === 0" class="empty">No se encontraron cámaras</li>
            <li v-for="camera in cameras">
              <span v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active">{{ formatName(camera.name) }}</span>
              <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
                <a @click.stop="selectCamera(camera)">{{ formatName(camera.name) }}</a>
              </span>
            </li>
          </ul>
        </section>
      </div>
      <div class="preview-container">
        <video id="preview"></video>
      </div>
    </div>
    <script type="text/javascript" src="javascript/app.js"></script>
  </body>
</html>
