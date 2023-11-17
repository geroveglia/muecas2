<?php

  $id = $_GET['id'];
  $distribuidor_id = $_SESSION["user_id"];
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
  

  $consulta1 = "SELECT * FROM clientes WHERE Id = '$distribuidor_id'";
  $resultado1 = mysql_query($consulta1,$conexion);
  $rArray = mysql_fetch_array($resultado1);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
       Mi perfil  
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
              <label class="col-sm-2 control-label">Nombre / Nombre del local / Empresa</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nombre" value="<?php echo $rArray['nombre']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Apellido</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="apellido" value="<?php echo $rArray['apellido']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" value="<?php echo $rArray['email']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Contrase&ntilde;a</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="contrasenia" value="<?php echo $rArray['contrasenia']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tel&eacute;fono</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="telefono" value="<?php echo $rArray['telefono']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Celular</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="celular" value="<?php echo $rArray['celular']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">CP</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="cp" value="<?php echo $rArray['cp']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label">Barrio</label>
              <div class="col-sm-10">
                  <?php
                  $consultaB = "SELECT * FROM barrios ORDER BY barrio";
                  $resultadoB = mysql_query($consultaB, $conexion);
                  $barrioValue = '';
                  while ($rArrayB = mysql_fetch_array($resultadoB)) {
                      if ($rArrayB['Id'] == $rArray['barrio']) {
                          $barrioValue = $rArrayB['barrio'];
                          break;
                      }
                  }
                  ?>
                  <input type="text" class="form-control" name="barrio" value="<?php echo $barrioValue; ?>" readonly>
              </div>
            </div>


            <div class="form-group">
            <label class="col-sm-2 control-label">Provincia</label>
              <div class="col-sm-10">
                  <?php
                  $consultaB = "SELECT * FROM provincias ORDER BY provincia";
                  $resultadoB = mysql_query($consultaB, $conexion);
                  $provinciaValue = '';
                  while ($rArrayB = mysql_fetch_array($resultadoB)) {
                      if ($rArrayB['Id'] == $rArray['provincia']) {
                          $provinciaValue = $rArrayB['provincia'];
                      }
                  }
                  ?>
                  <input type="text" class="form-control" name="provincia" value="<?php echo $provinciaValue; ?>" readonly>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Localidad</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="localidad" value="<?php echo $rArray['localidad']; ?>" readonly>
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
                  <label class="checkbox-inline i-checks"> 
                      <div class="icheckbox_square-green">
                          <input type="checkbox" name="activo" value="1" <?php if($rArray['activo']=='1'){echo 'checked';} ?> disabled>
                          <ins class="iCheck-helper"></ins>
                      </div> 
                      <i></i> Activo 
                  </label>
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