<?php
$cid = $_GET['cid'];
$consulta = "SELECT * FROM clientes WHERE Id='$cid'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$nombre = $rArray['nombre'];
$apellido = $rArray['apellido'];
$tipo = $rArray['tipo'];
$descuento = $rArray['descuento'];
$factura = $rArray['factura'];
  
if(isset($_POST['guardar'])){
  $estado = $_POST['estado'];
  $fecha_entrega = $_POST['fecha_entrega'];
  $franja = $_POST['franja'];
  
  $sql = "INSERT INTO pedidos (cliente_id, estado, fecha, fecha_entrega, franja_id, descuento_aplicado, telefonico, tipo_factura) VALUES ('$cid', ' $estado', NOW(), '$fecha_entrega', '$franja_id', '$descuento', '1', '$factura')";
  $rsql = mysql_query($sql,$conexion);
  $last_id = mysql_insert_id();
  
  $cantidad_total = 0;
  $monto = 0;
  foreach((array)$_POST['cantidad'] as $key => $value){
    $cantidad_total = $cantidad_total+$value;
  }
  foreach((array)$_POST['cantidad'] as $key => $value){
    $consultaP = "SELECT * FROM productos WHERE Id='$key'";
    $resultadoP = mysql_query($consultaP,$conexion);
    $rArrayP = mysql_fetch_array($resultadoP);
    $precio = $rArrayP['precio_'.$tipo];
    
    $consultaPR = "SELECT * FROM promociones WHERE tipo_cliente='$tipo' AND cajas<='$cantidad_total' ORDER BY cajas DESC LIMIT 1";
    $resultadoPR = mysql_query($consultaPR,$conexion);
    $rArrayPR = mysql_fetch_array($resultadoPR);
    $cantPR = mysql_num_rows($resultadoPR);
    $textoPromo = '';
    if($cantPR>0){
      $precio = $rArrayPR['precio_promo'];
      $textoPromo = 'Precio llevando '.$rArrayPR['cajas'].' cajas';
    }
    
    if($value=='' || $value=='0'){
    }
    else{
      $sql = "INSERT INTO pedidos_detalle (pedido_id, producto_id, cantidad, precio_abonado, promoaplicada) VALUES ('$last_id', '$key', '$value', '$precio', '$textoPromo')";
      $rsql = mysql_query($sql,$conexion);
      $monto = $monto+$precio*$value;
    }
  }
  $total = $monto;
  $subtotal = $total;
  $descuento_aplicado = $total*$descuento/100;
  $total = $total-$descuento_aplicado;
  if($factura=='A' || $factura=='B'){
    $iva = $total*0.21;
    $total = $total+$iva;
  }
  else{
    $iva = 0;
  }
  
  $sql = "UPDATE pedidos SET estado='$estado', fecha_entrega='$fecha_entrega', franja_id='$franja', cantidad_total='$cantidad_total', monto='$total', iva='$iva', subtotal='$subtotal' WHERE Id='$last_id'";
  $rsql = mysql_query($sql,$conexion);
  
  $uploads = '../archivos/pedidos/remitos';
  if($_FILES["remito"]["error"] == 0){
    $path = $_FILES['remito']['name'];
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['remito']['tmp_name'], $uploads.'/'.$last_id.'.'.$extension);
    
    $sql = "UPDATE pedidos SET remito='$extension' WHERE Id='$last_id'";
    $rsql = mysql_query($sql,$conexion);
  }
  
  $mensaje = '<div class="alert alert-info">Pedido creado satisfactoriamente.</div>';
}
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Pedidos > nuevo > Cliente: <?php echo $nombre;?> <?php echo $apellido;?>
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
          <form class="form-horizontal" action="./?seccion=pedidos_new&cid=<?php echo $cid;?>&volver=<?php echo $_GET['volver'];?>&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Estado</label>
              <div class="col-sm-10">
                <select class="form-control" name="estado" required>
                  <option value="">Seleccionar</option>
                  <option <?php if($rArray['estado']=='Recibido'){echo 'selected';};?>>Recibido</option>
                  <option <?php if($rArray['estado']=='En preparación'){echo 'selected';};?>>En preparación</option>
                  <option <?php if($rArray['estado']=='Despachado'){echo 'selected';};?>>Despachado</option>
                  <option <?php if($rArray['estado']=='Recoordinar'){echo 'selected';};?>>Recoordinar</option>
                  <option <?php if($rArray['estado']=='Entregado'){echo 'selected';};?>>Entregado</option>
                  <option <?php if($rArray['estado']=='Llamar a la vendedora'){echo 'selected';};?>>Llamar a la vendedora</option>
                  <option <?php if($rArray['estado']=='Anulado'){echo 'selected';};?>>Anulado</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Fecha de entrega</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="fecha_entrega" value="<?php echo $rArray['fecha_entrega']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Franja horaria</label>
              <div class="col-sm-10">
                <select class="form-control" name="franja" required>
                  <option value="">Seleccionar</option>
<?php
$consultaF = "SELECT * FROM franjas";
$resultadoF = mysql_query($consultaF,$conexion);
while($rArrayF = mysql_fetch_array($resultadoF)){
  echo '
                  <option value="'.$rArrayF['Id'].'" '.(($rArray['Id']==$rArrayF['franja'])?'selected':'').'>'.$rArrayF['franja'].'</option>
  ';
}
?>
                </select>
              </div>
            </div>
<?php
$consultaP = "SELECT * FROM productos ORDER BY orden";
$resultadoP = mysql_query($consultaP,$conexion);
while($rArrayP = mysql_fetch_array($resultadoP)){
  echo '
            <div class="form-group">
              <label class="col-sm-2 control-label">'.$rArrayP['nombre'].'</label>
              <div class="col-sm-10">
                <input type="number" min="0" class="form-control" name="cantidad['.$rArrayP['Id'].']" value="'.$cantidad.'">
              </div>
            </div>
  ';
}
?>
            <div class="form-group">
              <label class="col-sm-2 control-label">Remito/Factura</label>
              <div class="col-sm-10">
                <input type="file" name="remito" class="btn btn-warning btn-outline">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=<?php echo $_GET['volver']; ?>&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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