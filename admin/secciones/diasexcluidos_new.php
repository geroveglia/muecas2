<?php
if(isset($_POST['guardar'])){
  $dia = $_POST['dia'];
  
  $sql = "INSERT INTO diasexcluidos (dia) VALUES ('$dia')";
  $rsql = mysql_query($sql,$conexion);
  $last_id = mysql_insert_id();
  
  $mensaje = '<div class="alert alert-info">D&iacute;a de entrega exclu&iacute;do satisfactoriamente.</div>';
}
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        D&iacute;as de entrega exclu&iacute;dos > nuevo
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
          <form class="form-horizontal" action="./?seccion=diasexcluidos_new&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">D&iacute;a</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="dia" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=diasexcluidos&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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