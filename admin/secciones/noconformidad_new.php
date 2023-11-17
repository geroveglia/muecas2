<?php
if(isset($_POST['guardar'])){
  $noconformidad = $_POST['noconformidad'];

  $sql = "INSERT INTO reclamos_noconformidad (noconformidad) VALUES ('$noconformidad')";
  $rsql = mysql_query($sql,$conexion);
  $faq_id = mysql_insert_id();

  $mensaje = '<div class="alert alert-info">Tipo de no conformidad agregado satisfactoriamente.</div>';
  
}
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Tipos de no conformidad > nuevo
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
              <label class="col-sm-3 control-label">Tipo de no conformidad</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="noconformidad" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=noconformidad&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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