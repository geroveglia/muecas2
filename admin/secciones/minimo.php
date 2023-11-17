<?php
if(isset($_POST['guardar'])){
  $precio = $_POST['precio'];
  $sql = "UPDATE minimo SET precio='$precio' WHERE Id='1'";
$rsql = mysql_query($sql,$conexion);

  $mensaje = '<div class="alert alert-info">Compra m&iacute;nima editada satisfactoriamente.</div>';
}
$consulta = "SELECT * FROM minimo WHERE Id='1'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Compra m&iacute;nima
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
          <form class="form-horizontal" action="./?seccion=minimo&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Compra online</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon">$</span>	
                  <input type="number" step="1" min="0" name="precio" class="form-control" value="<?php echo $rArray['precio'];?>" required>
                </div>
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