<?php
include("../../inc/db.php");

$provincia_id = $_GET['provincia_id'];
echo '
  <option value="">Localidad</option>
';
$selected = '';
$consulta = "SELECT * FROM localidades WHERE provincia_id='$provincia_id' ORDER by localidad";
$resultado = mysql_query($consulta,$conexion);
$cant = $rArray = mysql_num_rows($resultado);
while($rArray = mysql_fetch_array($resultado)){
  echo '
    <option value="'.$rArray['Id'].'">'.$rArray['localidad'].'</option>
  ';
}
?>