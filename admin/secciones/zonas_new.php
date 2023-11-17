<?php
if(isset($_POST['guardar'])){
  $zona = $_POST['zona'];
  
  $sql = "INSERT INTO zonas (zona) VALUES ('$zona')";
  $rsql = mysql_query($sql,$conexion);
  $last_id = mysql_insert_id();
  
  foreach((array)$_POST['barrios'] as $value){
    $sql = "INSERT INTO zonas_barrios (zona_id, barrio_id) VALUES ('$last_id', '$value')";
    $rsql = mysql_query($sql,$conexion);
  }
  foreach((array)$_POST['dias'] as $value){
    $sql = "INSERT INTO zonas_dias (zona_id, dia_id) VALUES ('$id', '$value')";
    $rsql = mysql_query($sql,$conexion);
  }
  $mensaje = '<div class="alert alert-info">Zona agregada satisfactoriamente.</div>';
}
$diassemana = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Zonas > nueva
      </h2>
    </div>
  </div>
</div>
<?php echo $mensaje; ?>
<div class="content animate-panel">
  <div class="row">
    <div class="col-lg-12">
      <div class="hpanel">
        <div class="panel-body">
          <form class="form-horizontal" action="./?seccion=zonas_new&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Zona</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="zona" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">D&iacute;as</label>
              <div class="col-sm-10">
<?php
$consultaB = "SELECT * FROM dias";
$resultadoB = mysql_query($consultaB,$conexion);
while($rArrayB = mysql_fetch_array($resultadoB)) {
  echo '
                <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green"><input type="checkbox" name="dias[]" value="'.$rArrayB['Id'].'"><ins class="iCheck-helper"></ins></div> <i></i> '.$rArrayB['dia'].' </label>
  ';
}
?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Barrios</label>
              <div class="col-sm-10">
<?php
$consultaB = "SELECT * FROM barrios ORDER BY barrio";
$resultadoB = mysql_query($consultaB,$conexion);
while($rArrayB = mysql_fetch_array($resultadoB)) {
  echo '
                <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green"><input type="checkbox" name="barrios[]" value="'.$rArrayB['Id'].'"><ins class="iCheck-helper"></ins></div> <i></i> '.$rArrayB['barrio'].' </label>
  ';
}
?>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=zonas&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
                  <input type="submit" class="btn btn-warning" name="guardar" value="Guardar">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>