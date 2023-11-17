<?php
$id = $_GET['id'];

if(isset($_POST['guardar'])){
  $unidad = $_POST['unidad'];
  
  $sql = "UPDATE unidad_venta SET unidad='$unidad' WHERE Id='$id'";
  $rsql = mysql_query($sql,$conexion);
  
  $mensaje = '<div class="alert alert-info">Unidad de venta editada satisfactoriamente.</div>';
}

$consulta = "SELECT * FROM unidad_venta WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Unidad de venta > editar
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
          <form class="form-horizontal" action="./?seccion=unidades_edit&id=<?php echo $id;?>&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Unidad de venta</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="unidad" value="<?php echo $rArray['unidad']; ?>" required>
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