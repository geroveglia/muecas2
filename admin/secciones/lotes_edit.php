<?php
$id = $_GET['id'];

if(isset($_POST['guardar'])){
  $lote = $_POST['lote'];
  $ultimo_lote = $_POST['ultimo_lote'];
  
  $sql = "UPDATE reclamos_lotes SET lote='$lote', ultimo_lote='$ultimo_lote' WHERE Id='$id'";
  $rsql = mysql_query($sql,$conexion);

  $mensaje = '<div class="alert alert-info">Lote editado satisfactoriamente.</div>';
}

$consulta = "SELECT * FROM reclamos_lotes WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Lotes > editar
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
          <form class="form-horizontal" action="./?seccion=<?php echo $seccion;?>&id=<?php echo $id;?>&nc=<?php echo $rand;?>" method="POST">
            <div class="form-group">
              <label class="col-sm-2 control-label">Lote</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="lote" value="<?php echo $rArray['lote']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Último lote</label>
              <div class="col-sm-10">
                <input type="number" step="1" class="form-control" name="ultimo_lote" value="<?php echo $rArray['ultimo_lote']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=lotes&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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