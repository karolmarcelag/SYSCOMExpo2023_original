<?php
require_once '../google-api/vendor/autoload.php';
 
// init configuration
$clientID = '949448301397-jglmdppogppi4c25d785ell264d2nia2.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://127.0.0.1/Git/syscomexpo2023cdmx/graficas/index.php';
//$redirectUri = 'https://expo.syscom.mx/syscomexpo2023cdmx/graficas/index.php';
  
// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
 
// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) 
{
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
  
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;

  session_start();

  if(strpos($email,"@syscom.mx") !== false)
  {
    //codigo graficas
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Gráficas</title>
            <link rel="icon" href="https://www.syscom.mx/favico/syscom_favico.png">
            <link rel="stylesheet" href="../estilos/estilo3.1.css">
            <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript" src="../scripts/jquery-3.6.0.js"></script>
            <script type="text/javascript" src="../scripts/jquery-3.6.0.min.js"></script>
            <script type="text/javascript" src="../scripts/graficas.js"></script>
        </head>
        <body>
            <div class="logo">
                <a href='https://expo.syscom.mx'><img src="../imagenes/captura.png"></a></div><br>
            </div>
            <div class="total">
                Registros: <br><input type="text" id="registros" disabled><br>
            </div>
            <div class="primerDia">
                Asistentes 08 de Marzo: <br><input type="text" id="asistentesUno" disabled><br>
            </div>
            <div class="segundoDia">
                Asistentes 09 de Marzo: <br><input type="text" id="asistentesDos" disabled><br>
            </div>
            <div id="chart_div"></div>
        </body>
        <script>
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(cargar);
            iniciar()
        </script>
    </html>
    <?php
  }
  else
  {
    header("Location: $redirectUri?msg");
  }
} 
else 
{
  ?>
  <html>
      <head>
          <meta charset="utf-8">
          <title>Gráficas</title>
          <link rel="icon" href="https://www.syscom.mx/favico/syscom_favico.png">
          <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
          <link href="../estilos/estilo4.css" rel="stylesheet">
      </head>
      <body>
          <?php
          echo 
          "<a href='".$client->createAuthUrl()."'><button class='boton1'>Iniciar sesión con Google</button></a>";
          ?>
      </body>
  </html>
  <?php
  if (isset($_GET['msg'])) 
  {
    echo 
    "<script>
      alert('Lamentablemente no tiene permisos para acceder a este portal')
    </script>";
  }
}
?>