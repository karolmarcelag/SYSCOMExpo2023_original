<?php

include "conexion.php";

$IdUsuario = $_POST["id_usuario"]; //azul variable nueva, lo naranja es el azul del script
$IdTaller = $_POST["id_taller"];

$consulta = "insert into expo.inscripcion_talleres2023mx (id_usuario,id_taller) values ('$IdUsuario','$IdTaller')";
mysqli_query($conexion,$consulta);

echo "1";

?>