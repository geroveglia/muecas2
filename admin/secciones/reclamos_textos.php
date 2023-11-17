<?php
if(isset($_POST['guardar'])){
  foreach($_POST['texto'] as $key => $value){
    $sql = "UPDATE reclamos_textos SET texto='$value' WHERE Id='$key'";
    $rsql = mysql_query($sql,$conexion);
  }
}
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Reclamos > Textos
      </h2>
    </div>
  </div>
</div>
<div class="content animate-panel">
  <div class="row">
    <div class="col-lg-12">
      <div class="hpanel">
        <div class="panel-body">
          <form class="form-horizontal" action="./?seccion=<?php echo $seccion;?>&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <?php
            $consulta = "SELECT * FROM reclamos_textos";
            $resultado = mysql_query($consulta,$conexion);
            while($rArray = mysql_fetch_array($resultado)){
            echo '
            <div class="form-group">
              <label class="col-sm-2 control-label text-capitalize">'.$rArray['tipo'].'</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="texto['.$rArray['Id'].']" required>'.$rArray['texto'].'</textarea>
              </div>
            </div>
            ';
            }
            ?>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <input type="submit" class="btn btn-info" name="guardar" value="Guardar">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>