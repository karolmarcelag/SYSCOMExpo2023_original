<?php

include "conexion.php";

$id = $_POST["id"];

$consulta = "delete from expo.inscripcion_talleres2023mx where id=$id";
mysqli_query($conexion,$consulta);

echo "1";

?>