<?php
if(isset($_POST['guardar'])){
  $lote = $_POST['lote'];
  $ultimo_lote = $_POST['ultimo_lote'];

  $sql = "INSERT INTO reclamos_lotes (lote, ultimo_lote) VALUES ('$lote', '$ultimo_lote')";
  $rsql = mysql_query($sql,$conexion);
  $faq_id = mysql_insert_id();

  $mensaje = '<div class="alert alert-info">Pregunta agregada satisfactoriamente.</div>';
  
}
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Lotes > nuevo
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
          <form class="form-horizontal" action="./?seccion=<?php echo $seccion;?>&nc=<?php echo $rand;?>" method="POST">
            <div class="form-group">
              <label class="col-sm-2 control-label">Lote</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="lote" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Último lote</label>
              <div class="col-sm-10">
                <input type="number" step="1" class="form-control" name="ultimo_lote" required>
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