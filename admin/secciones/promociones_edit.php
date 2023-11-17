<?php
$id = $_GET['id'];

if(isset($_POST['guardar'])){
  $tipo_cliente = $_POST['tipo_cliente'];
  $producto_id = $_POST['producto_id'];
  $cajas = $_POST['cajas'];
  $precio_promo = $_POST['precio_promo'];
  
  $sql = "UPDATE promociones SET tipo_cliente='$tipo_cliente', cajas='$cajas', precio_promo='$precio_promo' WHERE Id='$id'";
  $rsql = mysql_query($sql,$conexion);
  $last_id = mysql_insert_id();
  
  $mensaje = '<div class="alert alert-info">Promoci&oacute;n editada satisfactoriamente.</div>';
}

$consulta = "SELECT * FROM promociones WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Promociones > editar
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
          <form class="form-horizontal" action="./?seccion=promociones_edit&id=<?php echo $id;?>&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Tipo de cliente</label>
              <div class="col-sm-10">
                <select class="form-control" name="tipo_cliente" required>
                  <option value="">Seleccionar</option>
                  <option <?php if($rArray['tipo_cliente']=='minorista'){echo 'selected';}?> value="minorista">Minorista</option>
                  <option <?php if($rArray['tipo_cliente']=='comercio'){echo 'selected';}?> value="comercio">Comercio</option>
                </select>
              </div>
            </div>
            <!--
            <div class="form-group">
              <label class="col-sm-2 control-label">Producto</label>
              <div class="col-sm-10">
                <select class="form-control" name="producto_id" required>
                  <option value="">Seleccionar</option>
<?php
$consultaC = "SELECT * FROM productos ORDER BY codigo";
$resultadoC = mysql_query($consultaC,$conexion);
while($rArrayC = mysql_fetch_array($resultadoC)) {
  echo '
                  <option value="'.$rArrayC['Id'].'" '.(($rArrayC['Id'] == $rArray['producto_id'])?'selected':'').'>'.$rArrayC['codigo'].' - '.$rArrayC['nombre'].'</option>
  ';
}
?>
                </select>
              </div>
            </div>
            -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Cantidad de cajas</label>
              <div class="col-sm-10">
                <input type="number" step="1" min="1" class="form-control" name="cajas" value="<?php echo $rArray['cajas']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Precio descuento</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="number" min="1" step="any" class="form-control" name="precio_promo" value="<?php echo $rArray['precio_promo']; ?>" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=promociones&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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