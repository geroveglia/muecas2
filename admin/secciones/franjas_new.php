<?php
if(isset($_POST['guardar'])){
  $franja = $_POST['franja'];
  $maximo_cajas = $_POST['maximo_cajas'];
  
  $sql = "INSERT INTO franjas (franja, maximo_cajas) VALUES ('$franja', '$maximo_cajas')";
  $rsql = mysql_query($sql,$conexion);
  $last_id = mysql_insert_id();
  
  $mensaje = '<div class="alert alert-info">Franja horaria agregada satisfactoriamente.</div>';
}
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Franjas horarias > nueva
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
          <form class="form-horizontal" action="./?seccion=franjas_new&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Franja horaria</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="franja" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Cantidad m&aacute;xima de cajas</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="maximo_cajas" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=franjas&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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