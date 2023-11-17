<?php
$id = $_GET['id'];
$cid = $_GET['cid'];

if(isset($_POST['guardar'])){
  $consulta = "SELECT * FROM clientes WHERE Id='$cid'";
  $resultado = mysql_query($consulta,$conexion);
  $rArray = mysql_fetch_array($resultado);
  $tipo = $rArray['tipo'];
  $descuento = $rArray['descuento'];
  $factura = $rArray['factura'];
  
  $estado = $_POST['estado'];
  $fecha_entrega = $_POST['fecha_entrega'];
  $franja = $_POST['franja'];
  
  $sEliminar = "DELETE FROM pedidos_detalle WHERE pedido_id='$id'";
  $rEliminar = mysql_query($sEliminar,$conexion);
  
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
      $sql = "INSERT INTO pedidos_detalle (pedido_id, producto_id, cantidad, precio_abonado, promoaplicada) VALUES ('$id', '$key', '$value', '$precio', '$textoPromo')";
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
  
  $sql = "UPDATE pedidos SET estado='$estado', fecha_entrega='$fecha_entrega', franja_id='$franja', cantidad_total='$cantidad_total', monto='$total', iva='$iva', subtotal='$subtotal' WHERE Id='$id'";
  $rsql = mysql_query($sql,$conexion);
  
  $uploads = '../archivos/pedidos/remitos';
  if($_FILES["remito"]["error"] == 0){
    $path = $_FILES['remito']['name'];
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['remito']['tmp_name'], $uploads.'/'.$id.'.'.$extension);
    
    $sql = "UPDATE pedidos SET remito='$extension' WHERE Id='$id'";
    $rsql = mysql_query($sql,$conexion);
  }
  
  $mensaje = '<div class="alert alert-info">Pedido editado satisfactoriamente.</div>';
}

$consulta = "SELECT * FROM pedidos WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Pedidos > editar
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
          <form class="form-horizontal" action="./?seccion=pedidos_edit&id=<?php echo $id;?>&cid=<?php echo $cid;?>&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Estado</label>
              <div class="col-sm-10">
                <select class="form-control" name="estado" required>
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
  $consultaP2 = "SELECT * FROM pedidos_detalle WHERE pedido_id='$id' AND producto_id=".$rArrayP['Id'];
  $resultadoP2 = mysql_query($consultaP2,$conexion);
  $rArrayP2 = mysql_fetch_array($resultadoP2);
  $cantidad = $rArrayP2['cantidad'];
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
              <label class="col-sm-2 control-label">Remito/Factura<br>
              <?php
              if($rArray['remito']!=''){
                echo '
                <a href="../archivos/pedidos/remitos/'.$id.'.'.$rArray['remito'].'?nc='.$rand.'" download="remito-pedido-'.$id.'.'.$rArray['remito'].'" class="btn btn-xs btn-warning">
                  descargar
                </a>
                ';
              }
              ?>
              </label>
              <div class="col-sm-10">
                <input type="file" name="remito" class="btn btn-warning btn-outline">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=pedidos&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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