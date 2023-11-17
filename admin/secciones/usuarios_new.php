<?php
if(isset($_POST['guardar'])){
  $usuario = $_POST['usuario'];
  $contrasenia = $_POST['contrasenia'];
  $tipo = $_POST['tipo'];
  if($_POST['activo']=='on'){$activo = '1';}else{$activo='0';};
  $email = $_POST['email'];
  
  $sql = "INSERT INTO usuarios (usuario, contrasenia, tipo, activo, email) VALUES ('$usuario', '$contrasenia', '$tipo', '$activo', '$email')";
  $rsql = mysql_query($sql,$conexion);
  $last_id = mysql_insert_id();

  $mensaje = '<div class="alert alert-info">Usuario agregado satisfactoriamente.</div>';
  
}
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Usuario nuevo
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
          <form class="form-horizontal" action="./?seccion=usuarios_new&nc=<?php echo $rand;?>" method="POST">
            <div class="form-group">
              <label class="col-sm-2 control-label">Usuario</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="usuario" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Contrase&ntilde;a</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="contrasenia" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tipo</label>
              <div class="col-sm-10">
                <select class="form-control" name="tipo" required>
                  <option value="">Seleccionar</option>
                  <option>Administrador</option>
                  <option>Operador</option>
                  <option>Visualizador</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
                <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green"><input type="checkbox" name="activo" checked><ins class="iCheck-helper"></ins></div> <i></i> Activo </label>
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