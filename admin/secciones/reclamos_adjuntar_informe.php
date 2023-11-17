<?php
$id = $_GET['id'];
$consulta = "SELECT * FROM reclamos WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$nombre = $rArray['nombre'];
$email = $rArray['email'];
$codigo = $rArray['codigo'];

if(isset($_POST['guardar'])){
  $texto_informe = $_POST['texto_informe'];

  $sql = "UPDATE reclamos SET texto_informe='$texto_informe', fecha_informe=NOW() WHERE Id='$id'";
  $rsql = mysql_query($sql,$conexion);

  $uploads = '../atencionalcliente/informe_calidad';
  if($_FILES["informe_calidad"]["error"] == 0){
    $path = $_FILES["informe_calidad"]['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $ext = strtolower($ext);
    move_uploaded_file($_FILES['informe_calidad']['tmp_name'], $uploads.'/'.$id.'.'.$ext);
    $sql = "UPDATE reclamos SET informe_calidad='$ext', fecha_cierre=NOW() WHERE Id='$id'";
    $rsql = mysql_query($sql,$conexion);
  }
  $mensaje = '<div class="alert alert-info">informe adjuntado satisfactoriamente.</div>';
}

$consulta = "SELECT * FROM reclamos WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Reclamos > adjuntar informe
      </h2>
    </div>
  </div>
</div>
<?php echo $mensaje; ?>
<div class="content animate-panel">
  <form class="form-horizontal" action="./?seccion=<?php echo $seccion;?>&id=<?php echo $id;?>&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
<?php
if($mensaje==''){
?>
    <div class="row">
      <div class="col-lg-6">
        <div class="hpanel">
          <div class="panel-body bg-warning">
            <h4 class="m-b-xl">Aclaración: el informe adjunto y el texto se le enviarán automáticamente por mail al cliente.</h4>
            <div class="form-group">
              <label class="col-sm-2 control-label">Adjuntar informe de calidad <?php if($rArray['informe_calidad']!=''){echo '<a href="../atencionalcliente/informe_calidad/'.$id.'.'.$rArray['informe_calidad'].'" class="btn btn-xs btn-warning" download="Informe de calidad NC'.str_pad($id, 5, '0', STR_PAD_LEFT).'">Descargar</a>';}?></label>
              <div class="col-sm-10">
                <input type="file" name="informe_calidad" class="btn btn-warning" required>
              </div>
            </div>
            <!--
            <div class="form-group">
              <label class="col-sm-2 control-label">Texto aclarativo</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="texto_informe"><?php echo $rArray['texto_informe']; ?></textarea>
              </div>
            </div>
            -->
          </div>
        </div>
      </div>
    </div>
<?php
}
?>
    <div class="row">
      <div class="col-lg-6">
        <div class="hpanel">
          <div class="panel-body">
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=reclamos&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
<?php
if($mensaje==''){
?>
                  <input type="submit" class="btn btn-warning" name="guardar" value="Guardar">
<?php
}
?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>