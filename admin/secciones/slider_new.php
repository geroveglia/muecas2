<?php
if(isset($_POST['guardar'])){
  $texto = $_POST['texto'];
  $bajada = $_POST['bajada'];
  $url = $_POST['url'];
  
  $sql = "INSERT INTO slider (texto, bajada, url, orden) VALUES ('$texto', '$bajada', '$url', (SELECT COALESCE(MAX(orden), 0) FROM slider C)+ 1)";
  $rsql = mysql_query($sql,$conexion);
  $slide_id = mysql_insert_id();
  
  $uploads = '../images/slider';
  if($_FILES["imagen"]["error"] == 0){
    move_uploaded_file($_FILES['imagen']['tmp_name'], $uploads.'/'.$slide_id.'.jpg');
  }
  $mensaje = '<div class="alert alert-info">Slide agregado satisfactoriamente.</div>';
}

?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Slide nuevo
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
          <form class="form-horizontal" action="./?seccion=slider_new&id=<?php echo $id;?>&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Imagen</label>
              <div class="col-sm-10">
                <input type="file" name="imagen" accept="image/jpeg" class="btn btn-warning btn-outline" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Texto</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="texto"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Bajada</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="bajada"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Link</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="url">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=slider&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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