<?php
$id = $_GET['id'];

if(isset($_POST['guardar'])){
  $pregunta = $_POST['pregunta'];
  $respuesta = $_POST['respuesta'];
  
  $sql = "UPDATE faq SET pregunta='$pregunta', respuesta='$respuesta' WHERE Id='$id'";
  $rsql = mysql_query($sql,$conexion);

  $mensaje = '<div class="alert alert-info">Categor&iacute;a editada satisfactoriamente.</div>';
}

$consulta = "SELECT * FROM faq WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Editar pregunta
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
          <form class="form-horizontal" action="./?seccion=faq_edit&id=<?php echo $id;?>&nc=<?php echo $rand;?>" method="POST">
            <div class="form-group">
              <label class="col-sm-2 control-label">Pregunta</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="pregunta" value="<?php echo $rArray['pregunta']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Respuesta</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="respuesta" required><?php echo $rArray['respuesta']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=faq&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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