<?php
if(isset($_POST['guardar'])){
  $unidad = $_POST['unidad'];
  
  $sql = "INSERT INTO unidad_venta (unidad) VALUES ('$unidad')";
  $rsql = mysql_query($sql,$conexion);
  $last_id = mysql_insert_id();
  
  $mensaje = '<div class="alert alert-info">Unidad de venta agregada satisfactoriamente.</div>';
  
}
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Unidad de venta > nueva
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
          <form class="form-horizontal" action="./?seccion=unidades_new&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Unidad de venta</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="unidad" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=unidades&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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