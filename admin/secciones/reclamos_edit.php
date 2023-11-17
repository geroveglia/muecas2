<?php
$id = $_GET['id'];

if(isset($_POST['guardar'])){
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];
  $provincia_id = $_POST['provincia_id'];
  $localidad_id = $_POST['localidad_id'];
  $informacion_relevante = $_POST['informacion_relevante'];
  $cantidad_barritas = $_POST['cantidad_barritas'];
  $lote = $_POST['lote'];
  $fecha_vencimiento = $_POST['fecha_vencimiento'];
  $fecha = $_POST['fecha'];
  $consumidor_final = $_POST['consumidor_final'];
  $direccion = $_POST['direccion'];
  $reclamo_justificado = $_POST['reclamo_justificado'];
  $reclamo_nojustificado = $_POST['reclamo_nojustificado'];
  $contestado = $_POST['contestado'];
  $resumen = $_POST['resumen'];
  $compensacion = $_POST['compensacion'];
  $respuesta = $_POST['respuesta'];
  $tipo_noconformidad = $_POST['tipo_noconformidad'];
  $clase = $_POST['clase'];
  $producto_id = $_POST['producto_id'];
  $estatus = $_POST['estatus'];
  $barrita = $_POST['barrita'];
  $tipo_cliente = $_POST['tipo_cliente'];
  $fecha_fabricacion = $_POST['fecha_fabricacion'];
  $compensado = $_POST['compensado'];
  $repuesto = $_POST['repuesto'];

  $sql = "UPDATE reclamos SET 
    nombre = '$nombre',
    email = '$email',
    telefono = '$telefono',
    provincia_id = '$provincia_id',
    localidad_id = '$localidad_id',
    informacion_relevante = '$informacion_relevante',
    cantidad_barritas = '$cantidad_barritas',
    lote = '$lote',
    fecha_vencimiento = '$fecha_vencimiento',
    fecha = '$fecha',
    consumidor_final = '$consumidor_final',
    direccion = '$direccion',
    reclamo_justificado = '$reclamo_justificado',
    reclamo_nojustificado = '$reclamo_nojustificado',
    contestado = '$contestado',
    resumen = '$resumen',
    compensacion = '$compensacion',
    respuesta = '$respuesta',
    tipo_noconformidad = '$tipo_noconformidad',
    clase = '$clase',
    producto_id = '$producto_id',
    estatus = '$estatus',
    barrita = '$barrita',
    cliente = '$cliente',
    tipo_cliente = '$tipo_cliente',
    fecha_fabricacion = '$fecha_fabricacion',
    compensado = '$compensado',
    repuesto = '$repuesto'
    WHERE Id='$id'";
    $rsql = mysql_query($sql,$conexion);
    
  $mensaje = '<div class="alert alert-info">Reclamo editado satisfactoriamente.</div>';
}

$consulta = "SELECT * FROM reclamos WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Reclamos > editar
      </h2>
    </div>
  </div>
</div>
<?php echo $mensaje; ?>
<div class="content animate-panel">
  <form class="form-horizontal" action="./?seccion=<?php echo $seccion;?>&id=<?php echo $id;?>&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
    <fieldset <?php if($_SESSION["tipo"]=='Visualizador'){echo 'disabled';};?>>
    <div class="row">
      <div class="col-lg-6">
        <div class="hpanel">
          <div class="panel-body bg-info">
            <h3 class="text-info">Completado por el cliente</h3>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tipo de cliente</label>
              <div class="col-sm-9">
                <select class="form-control" name="tipo_cliente" required>
                  <option value="">Tipo de cliente</option>
<?php
$tipo_cliente = array('Consumidor Final', 'Distribuidora' ,'Punto de Venta');
foreach($tipo_cliente as $value){
  echo '
                <option value="'.$value.'" '.(($value == $rArray['tipo_cliente'])?'selected':'').'>'.$value.'</option>
';
}
?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="nombre" value="<?php echo $rArray['nombre']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Email</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" name="email" value="<?php echo $rArray['email']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Teléfono</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="telefono" value="<?php echo $rArray['telefono']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Dirección</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="direccion" value="<?php echo $rArray['direccion']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Provincia</label>
              <div class="col-sm-9">
                <select class="form-control" name="provincia_id" id="provincia_id" required>
                  <option value="">Seleccionar</option>
<?php
$consultaB = "SELECT * FROM provincias_reclamos ORDER BY provincia";
$resultadoB = mysql_query($consultaB,$conexion);
while($rArrayB = mysql_fetch_array($resultadoB)) {
  echo '
                  <option value="'.$rArrayB['Id'].'" '.(($rArrayB['Id'] == $rArray['provincia_id'])?'selected':'').'>'.$rArrayB['provincia'].'</option>
  ';
}
?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Localidad</label>
              <div class="col-sm-9">
                <select class="form-control" name="localidad_id" id="localidad_id" required>
                  <option value="">Seleccionar</option>
<?php
$provincia_id = $rArray['provincia_id'];
$consultaB = "SELECT * FROM localidades WHERE provincia_id='$provincia_id' ORDER BY localidad";
$resultadoB = mysql_query($consultaB,$conexion);
while($rArrayB = mysql_fetch_array($resultadoB)) {
  echo '
                  <option value="'.$rArrayB['Id'].'" '.(($rArrayB['Id'] == $rArray['localidad_id'])?'selected':'').'>'.$rArrayB['localidad'].'</option>
  ';
}
?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Barrita por la que está reclamando</label>
              <div class="col-sm-9">
                <select class="form-control" name="barrita" id="barrita" required>
                  <option value="">Seleccionar</option>
<?php
$consultaB = "SELECT * FROM productos ORDER BY nombre";
$resultadoB = mysql_query($consultaB,$conexion);
while($rArrayB = mysql_fetch_array($resultadoB)) {
  echo '
                  <option value="'.$rArrayB['nombre'].'" '.(($rArrayB['nombre'] == $rArray['barrita'])?'selected':'').'>'.$rArrayB['nombre'].'</option>
  ';
}
?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Cantidad de barritas afectadas</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="cantidad_barritas" value="<?php echo $rArray['cantidad_barritas']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Información relevante</label>
              <div class="col-sm-9">
                <textarea class="form-control" name="informacion_relevante"><?php echo $rArray['informacion_relevante']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Lote</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="lote" value="<?php echo $rArray['lote']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Fecha de vencimiento</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" name="fecha_vencimiento" value="<?php echo $rArray['fecha_vencimiento']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Fecha de fabricación</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" name="fecha_fabricacion" value="<?php if($rArray['fecha_fabricacion']!=''){echo $rArray['fecha_fabricacion'];}; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Fotos</label>
              <div class="col-sm-9">
                <div id="checkFotos">
<?php
if($rArray['foto1']!=''){
  echo '
                  <a href="../atencionalcliente/fotos/'.$rArray['foto1'].'" download="Reclamo-'.$rArray['foto1'].'"><img src="../atencionalcliente/fotos/'.$rArray['foto1'].'" class="admin-thumb"></a>
  ';
}
if($rArray['foto2']!=''){
  echo '
                  <a href="../atencionalcliente/fotos/'.$rArray['foto2'].'" download="Reclamo-'.$rArray['foto2'].'"><img src="../atencionalcliente/fotos/'.$rArray['foto2'].'" class="admin-thumb"></a>
  ';
}
$consultaF = "SELECT * FROM reclamos_fotos WHERE reclamo_id='$id'";
$resultadoF = mysql_query($consultaF,$conexion);
while($rArrayF = mysql_fetch_array($resultadoF)){
  echo '
                  <a href="../atencionalcliente/fotos/'.$rArrayF['archivo'].'.'.$rArrayF['extension'].'" download="Reclamo-'.$rArrayF['archivo'].'.'.$rArrayF['extension'].'"><img src="../atencionalcliente/fotos/'.$rArrayF['archivo'].'.'.$rArrayF['extension'].'" class="admin-thumb"></a>
  ';
};
?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="hpanel">
          <div class="panel-body bg-warning">
            <h3 class="text-warning">Completado por muecas</h3>
            <div class="form-group">
              <label class="col-sm-3 control-label">Numero de reclamo</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="NC<?php echo str_pad($rArray['Id'], 5, '0', STR_PAD_LEFT); ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Código</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $rArray['codigo']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Fecha de recepción</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" name="fecha" value="<?php echo $rArray['fecha']; ?>" required>
              </div>
            </div>
<?php
$email = $rArray['email'];
$consultaL = "SELECT COUNT(*) AS cantidad FROM reclamos WHERE email='$email'";
$resultadoL = mysql_query($consultaL,$conexion);
$cantreclamos = mysql_fetch_array($resultadoL);
?>
            <div class="form-group">
              <label class="col-sm-3 control-label">Cantidad de reclamos</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $cantreclamos['cantidad']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label"></label>
              <div class="col-sm-9">
                <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green"><input type="checkbox" name="reclamo_justificado" value="1" <?php if($rArray['reclamo_justificado']=='1'){echo 'checked';}; ?>><ins class="iCheck-helper"></ins></div> <i></i> Reclamo justificado </label>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label"></label>
              <div class="col-sm-9">
                <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green"><input type="checkbox" name="reclamo_nojustificado" value="1" <?php if($rArray['reclamo_nojustificado']=='1'){echo 'checked';}; ?>><ins class="iCheck-helper"></ins></div> <i></i> Reclamo no justificado </label>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Estatus</label>
              <div class="col-sm-9">
                <select class="form-control" name="estatus" id="estatus" required>
                  <option value="">Seleccionar</option>
<?php
$estatus = array('Abierto', 'En proceso a tiempo', 'En proceso atrasado', 'Cerrado pendiente compensación', 'Cerrado y compensado', 'Cerrado no requiere compensación', 'Cerrado');
foreach($estatus as $key => $value){
  echo '
                  <option '.(($value==$rArray['estatus'])?'selected':'').'>'.$value.'</option>
  ';
}
?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Clase</label>
              <div class="col-sm-9">
                <select class="form-control" name="clase" id="clase">
                  <option value="">Seleccionar</option>
<?php
$estatus = array('Clase 1', 'Clase 2', 'Clase 3');
foreach($estatus as $key => $value){
  echo '
                  <option '.(($value==$rArray['clase'])?'selected':'').'>'.$value.'</option>
  ';
}
?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tipo de no conformidad</label>
              <div class="col-sm-9">
                <select class="form-control" name="tipo_noconformidad" id="tipo_noconformidad">
                  <option value="">Seleccionar</option>
<?php
$consultaN = "SELECT * FROM reclamos_noconformidad ORDER BY noconformidad";
$resultadoN = mysql_query($consultaN,$conexion);
while($rArrayN = mysql_fetch_array($resultadoN)) {
  echo '
                  <option '.(($rArrayN['noconformidad']==$rArray['tipo_noconformidad'])?'selected':'').'>'.$rArrayN['noconformidad'].'</option>
  ';
}
?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Resumen de la respuesta y acciones</label>
              <div class="col-sm-9">
                <textarea class="form-control" name="resumen"><?php echo $rArray['resumen']; ?></textarea>
              </div>
            </div>
            <div class="form-group m-b-none">
              <label class="col-sm-3 control-label"></label>
              <div class="col-sm-9">
                <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green"><input type="checkbox" name="compensado" value="1" <?php if($rArray['compensado']=='1'){echo 'checked';}; ?>><ins class="iCheck-helper"></ins></div> <i></i> Compensación </label>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label"></label>
              <div class="col-sm-9">
                <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green"><input type="checkbox" name="repuesto" value="1" <?php if($rArray['repuesto']=='1'){echo 'checked';}; ?>><ins class="iCheck-helper"></ins></div> <i></i> Reposición </label>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Compensación de producto</label>
              <div class="col-sm-9">
                <textarea class="form-control" name="compensacion"><?php echo $rArray['compensacion']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Fecha de cierre</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" name="fecha_cierre" value="<?php if($rArray['fecha_cierre']!=''){echo $rArray['fecha_cierre'];}; ?>" readonly>
              </div>
            </div>
<?php
$fecha_recepcion = strtotime($rArray['fecha']);
$fecha_cierre = strtotime($rArray['fecha_cierre']);
$secs = $fecha_cierre - $fecha_recepcion;// == <seconds between the two times>
$tiempo_respuesta = $secs / 86400;
if($fecha_cierre==''){
  $tiempo_respuesta = '';
}
?>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tiempo de respuesta (días corridos)</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $tiempo_respuesta; ?>" readonly>
              </div>
            </div>
<?php
$tiempo_respuesta_habiles = number_of_working_days($rArray['fecha'], $rArray['fecha_cierre']);
if($fecha_cierre==''){
  $tiempo_respuesta_habiles = '';
}
?>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tiempo de respuesta (días hábiles)</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $tiempo_respuesta_habiles; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Informe de calidad <?php if($rArray['informe_calidad']!=''){echo '<a href="../atencionalcliente/informe_calidad/'.$rArray['Id'].'.'.$rArray['informe_calidad'].'" class="btn btn-info btn-xs" download="Informe '.str_pad($rArray['Id'], 5, '0', STR_PAD_LEFT).'.'.$rArray['informe_calidad'].'"><i class="fa fa-download"></i> Descargar informe</a>';}?></label>
              <div class="col-sm-9">
                <textarea class="form-control" readonly><?php echo $rArray['texto_informe']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Fecha informe de calidad</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" value="<?php if($rArray['fecha_informe']!=''){echo $rArray['fecha_informe'];}; ?>" readonly>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </fieldset>
    <div class="row">
      <div class="col-lg-12">
        <div class="hpanel">
          <div class="panel-body">
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=reclamos&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
                  <?php if($_SESSION["tipo"]!='Visualizador'){ ?>
                  <input type="submit" class="btn btn-warning" name="guardar" value="Guardar">
                  <?php };?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>


<script>
$('#provincia_id').on('change', function(){
  provincia_id = this.value;
  
  if(provincia_id!=''){
    if (window.XMLHttpRequest){
      xmlhttp=new XMLHttpRequest();
    }
    else{
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
        $("#localidad_id").html(xmlhttp.responseText);
      }
    }
    xmlhttp.open("POST","secciones/ajax_localidades.php?provincia_id="+provincia_id,true);
    xmlhttp.send();
  }
  else{
    
  }
});
</script>