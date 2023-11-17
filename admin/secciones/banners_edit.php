<?php
$id = $_GET['id'];

if(isset($_POST['guardar'])){
  $url = $_POST['url'];

  $sql = "UPDATE banners SET url='$url' WHERE Id='$id'";
  $rsql = mysql_query($sql,$conexion);
  //echo mysql_errno($conexion) . ": " . mysql_error($conexion) . "\n";
  $last_id = $id;
  
  $uploads = '../images/banners';
  if($_FILES["imagen"]["error"] == 0){
    move_uploaded_file($_FILES['imagen']['tmp_name'], $uploads.'/'.$last_id.'.jpg');
  }
  
  
  $mensaje = '<div class="alert alert-info">Banner editado satisfactoriamente.</div>';
}

$consulta = "SELECT * FROM banners WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Editar banner
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
          <form class="form-horizontal" action="./?seccion=banners_edit&id=<?php echo $id;?>&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
                <h5><?php echo $rArray['nombre']; ?></h5>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">URL</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="url" value="<?php echo $rArray['url']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Cambiar imagen</label>
              <div class="col-sm-10">
                <input type="file" name="imagen" accept="image/jpeg" class="btn btn-warning btn-outline">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"><br>
              </label>
              <div class="col-sm-10">
                <?php echo '<img src="../images/banners/'.$id.'.jpg?nc='.$rand.'" class="img-responsive">'; ?>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=banners&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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