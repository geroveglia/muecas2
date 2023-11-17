<?php
$id = $_GET['id'];

if(isset($_POST['guardar'])){
  $usuario = $_POST['usuario'];
  $contrasenia = $_POST['contrasenia'];
  $tipo = $_POST['tipo'];
  if($_POST['activo']=='on'){$activo = '1';}else{$activo='0';};
  $email = $_POST['email'];
  
  if($id=='1'){
    $tipo = 'Administrador';
    $activo = '1';
  }
  
  $sql = "UPDATE usuarios SET usuario='$usuario', contrasenia='$contrasenia', tipo='$tipo', activo='$activo', email='$email' WHERE Id='$id'";
  $rsql = mysql_query($sql,$conexion);

  $mensaje = '<div class="alert alert-info">Usuario editado satisfactoriamente.</div>';
}

$consulta = "SELECT * FROM usuarios WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Editar usuario
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
          <form class="form-horizontal" action="./?seccion=usuarios_edit&id=<?php echo $id;?>&nc=<?php echo $rand;?>" method="POST">
            <div class="form-group">
              <label class="col-sm-2 control-label">Usuario</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="usuario" value="<?php echo $rArray['usuario']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Contrase&ntilde;a</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="contrasenia" value="<?php echo $rArray['contrasenia']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" value="<?php echo $rArray['email']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tipo</label>
              <div class="col-sm-10">
                <select class="form-control" name="tipo" required <?php if($id=='1'){echo 'disabled';}?>>
                  <option value="">Seleccionar</option>
                  <option <?php if($rArray['tipo']=='Administrador'){echo 'selected';}?>>Administrador</option>
                  <option <?php if($rArray['tipo']=='Operador'){echo 'selected';}?>>Operador</option>
                  <option <?php if($rArray['tipo']=='Visualizador'){echo 'selected';}?>>Visualizador</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
                <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green"><input type="checkbox" name="activo" <?php if($rArray['activo']=='1'){echo 'checked';}; ?> <?php if($id=='1'){echo 'disabled';}?>><ins class="iCheck-helper"></ins></div> <i></i> Activo </label>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=usuarios&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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