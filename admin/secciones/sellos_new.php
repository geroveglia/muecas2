<?php
if(isset($_POST['guardar'])){
  $nombre = $_POST['nombre'];
  

  $sql = "INSERT INTO sellos (nombre) VALUES ('$nombre')";
  $rsql = mysql_query($sql,$conexion);
  $last_id = mysql_insert_id();
  //echo mysql_errno($conexion) . ": " . mysql_error($conexion) . "\n";
  
  $uploads = '../images/sellos';
  if($_FILES["imagen"]["error"] == 0){
    move_uploaded_file($_FILES['imagen']['tmp_name'], $uploads.'/'.$last_id.'.jpg');
  }
  
  $mensaje = '<div class="alert alert-info">Sello agregad0 satisfactoriamente.</div>';
}

?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Sellos > nuevo
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
          <form class="form-horizontal" action="./?seccion=sellos_new&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Nombre</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nombre" required>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-2 control-label">Subir imagen (Formato web)</label>
              <div class="col-sm-10">
                <input type="file" name="imagen" accept="image/*" class="btn btn-warning btn-outline">
                <p>Sube una imagen en formato web (por ejemplo, JPEG, PNG, GIF).</p>
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=sellos&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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