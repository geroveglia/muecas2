<?php
if(isset($_POST['guardar'])){
  $uploads = '../images';
  
  if($_FILES["header-comprar"]["error"] == 0){
    move_uploaded_file($_FILES['header-comprar']['tmp_name'], $uploads.'/header-comprar.jpg');
  }
  if($_FILES["header-pais"]["error"] == 0){
    move_uploaded_file($_FILES['header-pais']['tmp_name'], $uploads.'/header-pais.jpg');
  }
  if($_FILES["header-medio"]["error"] == 0){
    move_uploaded_file($_FILES['header-medio']['tmp_name'], $uploads.'/header-medio.jpg');
  }
  if($_FILES["menu-bg"]["error"] == 0){
    move_uploaded_file($_FILES['menu-bg']['tmp_name'], $uploads.'/menu-bg.jpg');
  }
  $mensaje = '<div class="alert alert-info">Cabeceras editadas satisfactoriamente.</div>';
}
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Cabeceras
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
          <form class="form-horizontal" action="./?seccion=cabeceras&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Compra online<br>
              <img src="../images/header-comprar.jpg?nc=<?php echo $rand; ?>" class="img-responsive">
              </label>
              <div class="col-sm-10">
                <input type="file" name="header-comprar" accept="image/jpeg" class="btn btn-warning btn-outline">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Muecas en el pa&iacute;s<br>
              <img src="../images/header-pais.jpg?nc=<?php echo $rand; ?>" class="img-responsive">
              </label>
              <div class="col-sm-10">
                <input type="file" name="header-pais" accept="image/jpeg" class="btn btn-warning btn-outline">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Registro<br>
              <img src="../images/header-medio.jpg?nc=<?php echo $rand; ?>" class="img-responsive">
              </label>
              <div class="col-sm-10">
                <input type="file" name="header-medio" accept="image/jpeg" class="btn btn-warning btn-outline">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Menu<br>
              <img src="../images/menu-bg.jpg?nc=<?php echo $rand; ?>" class="img-responsive">
              </label>
              <div class="col-sm-10">
                <input type="file" name="menu-bg" accept="image/jpeg" class="btn btn-warning btn-outline">
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