<?php
$id = $_GET['id'];

if(isset($_POST['guardar'])){
  $tipo = $_POST['tipo'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $contrasenia = $_POST['contrasenia'];
  $telefono = $_POST['telefono'];
  $celular = $_POST['celular'];
  $direccion = $_POST['direccion'];
  $piso = $_POST['piso'];
  $departamento = $_POST['departamento'];
  $cp = $_POST['cp'];
  $barrio = $_POST['barrio'];
  $fuera_caba = $_POST['fuera_caba'];
  $nombre_contacto = $_POST['nombre_contacto'];
  $provincia = $_POST['provincia'];
  $localidad = $_POST['localidad'];
  $horario_apertura = $_POST['horario_apertura'];
  $descuento = $_POST['descuento'];
  $factura = $_POST['factura'];
  if($_POST['activo']=='1'){$activo = '1';}else{$activo = '0';}
  
  $consultaC = "SELECT * FROM clientes WHERE email='$email' AND Id!='$id'";
  $resultadoC = mysql_query($consultaC,$conexion);
  $cant = mysql_num_rows($resultadoC);
  
  if($cant==0){
    $sql = "UPDATE clientes SET tipo='$tipo', nombre='$nombre', apellido='$apellido', email='$email', contrasenia='$contrasenia', telefono='$telefono', celular='$celular', direccion='$direccion', cp='$cp', barrio='$barrio', nombre_contacto='$nombre_contacto', provincia='$provincia', localidad='$localidad', horario_apertura='$horario_apertura', descuento='$descuento', activo='$activo', factura='$factura' WHERE Id='$id'";
    $rsql = mysql_query($sql,$conexion);
    $mensaje = '<div class="alert alert-info">Cliente editado satisfactoriamente.</div>';
  }
  else{
    $mensaje = '<div class="alert alert-danger">El email ingresado ya se encuentra registrado.</div>';
  }
  $sEliminar = "DELETE FROM distribuidores_sucursales WHERE distribuidor_id='$id'";
  $rEliminar = mysql_query($sEliminar,$conexion);
  foreach((array)$_POST['sucursalprovincia'] as $key => $value){
    $sucursalprovincia = $_POST['sucursalprovincia'][$key];
    $sucursallocalidad = $_POST['sucursallocalidad'][$key];
    $sql = "INSERT INTO distribuidores_sucursales (distribuidor_id, provincia_id, localidad) VALUES ('$id', '$sucursalprovincia', '$sucursallocalidad')";
    $rsql = mysql_query($sql,$conexion);
  }
}

$consulta = "SELECT * FROM clientes WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Clientes > editar
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
          <form class="form-horizontal" action="./?seccion=clientes_edit&id=<?php echo $id;?>&volver=<?php echo $_GET['volver']; ?>&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Tipo</label>
              <div class="col-sm-10">
                <select class="form-control" name="tipo" id="tipo" required>
                  <option value="">Tipo de cliente</option>
                  <option <?php if($rArray['tipo']=='minorista'){echo 'selected';}?> value="minorista">Cliente particular C.A.B.A.</option>
                  <option <?php if($rArray['tipo']=='comercio'){echo 'selected';}?> value="comercio">Comercio C.A.B.A.</option>
                  <option <?php if($rArray['tipo']=='distribuidor'){echo 'selected';}?> value="distribuidor">Distribuidor Mayorista</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nombre / Nombre del local / Empresa</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nombre" value="<?php echo $rArray['nombre']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Apellido</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="apellido" value="<?php echo $rArray['apellido']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" value="<?php echo $rArray['email']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Contrase&ntilde;a</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="contrasenia" value="<?php echo $rArray['contrasenia']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tel&eacute;fono</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="telefono" value="<?php echo $rArray['telefono']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Celular</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="celular" value="<?php echo $rArray['celular']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Direcci&oacute;n / Direcci&oacute;n de entrega</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="direccion" value="<?php echo $rArray['direccion']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">CP</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="cp" value="<?php echo $rArray['cp']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Barrio</label>
              <div class="col-sm-10">
                <select class="form-control" name="barrio">
                  <option value=""></option>
<?php
$consultaB = "SELECT * FROM barrios ORDER BY barrio";
$resultadoB = mysql_query($consultaB,$conexion);
while($rArrayB = mysql_fetch_array($resultadoB)) {
  echo '
                  <option value="'.$rArrayB['Id'].'" '.(($rArrayB['Id'] == $rArray['barrio'])?'selected':'').'>'.$rArrayB['barrio'].'</option>
  ';
}
?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nombre de contacto</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nombre_contacto" value="<?php echo $rArray['nombre_contacto']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Provincia</label>
              <div class="col-sm-10">
                <select class="form-control" name="provincia">
                  <option value=""></option>
<?php
$consultaB = "SELECT * FROM provincias ORDER BY provincia";
$resultadoB = mysql_query($consultaB,$conexion);
while($rArrayB = mysql_fetch_array($resultadoB)) {
  echo '
                  <option value="'.$rArrayB['Id'].'" '.(($rArrayB['Id'] == $rArray['provincia'])?'selected':'').'>'.$rArrayB['provincia'].'</option>
  ';
}
?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Localidad</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="localidad" value="<?php echo $rArray['localidad']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Horario de apertura</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="horario_apertura" value="<?php echo $rArray['horario_apertura']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Descuento</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon">%</span>
                  <input type="number" min="0" step="1" class="form-control" name="descuento" value="<?php echo $rArray['descuento']; ?>" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Factura</label>
              <div class="col-sm-10">
                <select class="form-control" name="factura">
                  <option value="No" <?php if($rArray['factura']=='No'){echo 'selected';}; ?>>No</option>
                  <option value="A" <?php if($rArray['factura']=='A'){echo 'selected';}; ?>>A</option>
                  <option value="B" <?php if($rArray['factura']=='B'){echo 'selected';}; ?>>B</option>
                </select>
              </div>
            </div>
<?php if($_GET['volver']=='clientes_distribuidores'){?>
            <div class="form-group">
              <label class="col-sm-2 control-label">Sucursales <button type="button" id="addsucursales" class="btn btn-warning btn-xs"><i class="fa fa-plus"></i></button></label>
              <div class="col-sm-10">
                <div id="sucursales">
<?php
$consultaB = "SELECT * FROM distribuidores_sucursales WHERE distribuidor_id='$id'";
$resultadoB = mysql_query($consultaB,$conexion);
while($rArrayB = mysql_fetch_array($resultadoB)) {
  echo '
                  <div class="alert alert-warning m-b-xs p-xxs form-inline"><div class="input-group"><select class="form-control" name="sucursalprovincia[]" required><option value="">Seleccionar provincia</option>';
$consultaC = "SELECT * FROM provincias ORDER BY provincia";
$resultadoC = mysql_query($consultaC,$conexion);
while($rArrayC = mysql_fetch_array($resultadoC)) {
echo '<option value="'.$rArrayC['Id'].'" '.(($rArrayB['provincia_id']==$rArrayC['Id'])?'selected':'').'>'.$rArrayC['provincia'].'</option>';
}
  echo '
  </select></div><div class="input-group"><input type="text" class="form-control" placeholder="Localidad" name="sucursallocalidad[]" value="'.$rArrayB['localidad'].'" required><span class="input-group-btn"><button type="button" class="eliminar btn btn-danger"><i class="fa fa-times"></i></button></span></div></div>
  ';
}
?>
                </div>
              </div>
            </div>
<?php }?>
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
                <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green"><input type="checkbox" name="activo" value="1" <?php if($rArray['activo']=='1'){echo 'checked';}; ?>><ins class="iCheck-helper"></ins></div> <i></i> Activo </label>
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
<script>
$("#addsucursales").click(function(){
  $("#sucursales").append('<div class="alert alert-warning m-b-xs p-xxs form-inline"><div class="input-group"><select class="form-control" name="sucursalprovincia[]" required><option value="">Seleccionar provincia</option><?php
$consultaC = "SELECT * FROM provincias ORDER BY provincia";
$resultadoC = mysql_query($consultaC,$conexion);
while($rArrayC = mysql_fetch_array($resultadoC)) {
echo '<option value="'.$rArrayC['Id'].'">'.$rArrayC['provincia'].'</option>';
}
?></select></div><div class="input-group"><input type="text" class="form-control" placeholder="Localidad" name="sucursallocalidad[]" required><span class="input-group-btn"><button type="button" class="eliminar btn btn-danger"><i class="fa fa-times"></i></button></span></div></div>');
});

$(document).on('click', '.eliminar', function() {
  $(this).parent().parent().parent().remove();
});
</script>