<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
       Zonas > eliminar
      </h2>
    </div>
  </div>
</div>
<div class="content animate-panel">
  <div class="row">
    <div class="col-lg-4">
      <div class="hpanel">
        <div class="panel-body">
        <?php
          $confirmar = $_GET['confirmar'];
          $id = $_GET['id'];
          
          if($confirmar == 'si'){
            $sEliminar = "DELETE FROM zonas WHERE Id='$id'";
            $rEliminar = mysql_query($sEliminar,$conexion);
            
            echo '
            <div class="alert alert-info">Se elimin&oacute; la zona.</div>
            <div class="pull-right m-t">
              <a href="?seccion=zonas&nc='.$rand.'" class="btn btn-danger">Aceptar</a>
            </div>
            ';
          }
          else{
            echo '
            <div class="alert alert-danger">&iquest;Confirma eliminar la zona?.<br>
              Esta acci&oacute;n no puede deshacerse.<br>
            </div>
            <div class="pull-right m-t">
              <a href="?seccion=zonas_delete&id='.$id.'&confirmar=si&nc='.$rand.'" class="btn btn-danger">Eliminar</a>
              <a href="?seccion=zonas&nc='.$rand.'" class="btn btn-danger">Cancelar</a>
            </div>';
          }
        ?>
        </div>
      </div>
    </div>
  </div>
</div>