<?php
if(isset($_POST['guardar'])){
  $nombre = $_POST['nombre'];
  

  $sql = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
  $rsql = mysql_query($sql,$conexion);
  $last_id = mysql_insert_id();
  //echo mysql_errno($conexion) . ": " . mysql_error($conexion) . "\n";
  
  
  
  $mensaje = '<div class="alert alert-info">Categoria agregada satisfactoriamente.</div>';
}

?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Categorias > nuevo
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
          <form class="form-horizontal" action="./?seccion=categorias_new&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Nombre</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nombre" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=categorias&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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