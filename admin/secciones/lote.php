<?php
if(isset($_POST['guardar'])){
  $lote = $_POST['lote'];
  $sql = "UPDATE reclamos_lotes SET lote='$lote' WHERE Id='1'";
  $rsql = mysql_query($sql,$conexion);

  $mensaje = '<div class="alert alert-info">Último Lote editado satisfactoriamente.</div>';
}
$consulta = "SELECT * FROM reclamos_lotes WHERE Id='1'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Último Lote
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
          <form class="form-horizontal" action="./?seccion=lote&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Último lote (sólo número)</label>
              <div class="col-sm-10">
                <input type="number" step="1" min="0" name="lote" class="form-control" value="<?php echo $rArray['lote'];?>" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
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