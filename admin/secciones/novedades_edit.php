<?php
$id = $_GET['id'];

if(isset($_POST['guardar'])){
  $titulo = $_POST['titulo'];
  $titulo = utf8_encode($titulo);
  $contenido = $_POST['contenido'];
  $fecha = $_POST['fecha'];
  
  $url = str_replace(array(' ', 'á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ', '?', '"', '\'', '¿', '.', ',', ';', ':', '#', '(', ')', '!', '�', '°', 'º', '/', '+', '&', '$'), array('-', 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'n', 'N', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'), $titulo);
  $url = str_replace("--","-",$url);
  $url = str_replace("--","-",$url);
  $url = str_replace("--","-",$url);
  $url = str_replace("--","-",$url);
  $url = strtolower($url);

  $sql = "UPDATE novedades SET titulo='$titulo', contenido='$contenido', fecha='$fecha', url='$url' WHERE Id='$id'";
  $rsql = mysql_query($sql,$conexion);
  //echo mysql_errno($conexion) . ": " . mysql_error($conexion) . "\n";
  $last_id = $id;
  
  $uploads = '../images/novedades';
  if($_FILES["imagen"]["error"] == 0){
    move_uploaded_file($_FILES['imagen']['tmp_name'], $uploads.'/'.$last_id.'.jpg');
  }
  
  
  $mensaje = '<div class="alert alert-info">Novedad editada satisfactoriamente.</div>';
}

$consulta = "SELECT * FROM novedades WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Novedad > editar
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
          <form class="form-horizontal" action="./?seccion=novedades_edit&id=<?php echo $id;?>&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">T&iacute;tulo</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="titulo" value="<?php echo utf8_decode($rArray['titulo']); ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Contenido</label>
              <div class="col-sm-10">
                <textarea name="contenido" id="contenido" class="form-control" required><?php echo $rArray['contenido']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Fecha</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="fecha" value="<?php echo $rArray['fecha']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Cambiar foto<br>
              <?php echo '<img src="../fotos/novedades/'.$id.'.jpg?nc='.$rand.'" class="admin-thumb pull-right">'; ?>
              </label>
              <div class="col-sm-10">
                <input type="file" name="imagen" accept="image/jpeg" class="btn btn-warning btn-outline">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=novedades&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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

<!-- CK EDITOR -->
<script src="ckeditor/ckeditor.js"></script>

<script>
CKEDITOR.replace('contenido', {
    toolbar: [
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
    { name: 'links', items: [ 'Link', 'Unlink'] },
    { name: 'insert', items: [ 'Table', 'HorizontalRule', 'SpecialChar'] },
    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    { name: 'colors', items: [ 'TextColor', 'BGColor' ] }
]
});

</script>