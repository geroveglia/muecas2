<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
       Franjas horarias > eliminar
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
            $sEliminar = "DELETE FROM franjas WHERE Id='$id'";
            $rEliminar = mysql_query($sEliminar,$conexion);
            
            echo '
            <div class="alert alert-info">Se elimin&oacute; la franja horaria.</div>
            <div class="pull-right m-t">
              <a href="?seccion=franjas&nc='.$rand.'" class="btn btn-danger">Aceptar</a>
            </div>
            ';
          }
          else{
            echo '
            <div class="alert alert-danger">&iquest;Confirma eliminar la franja horaria?.<br>
              Esta acci&oacute;n no puede deshacerse.<br>
            </div>
            <div class="pull-right m-t">
              <a href="?seccion=franjas_delete&id='.$id.'&confirmar=si&nc='.$rand.'" class="btn btn-danger">Eliminar</a>
              <a href="?seccion=franjas&nc='.$rand.'" class="btn btn-danger">Cancelar</a>
            </div>';
          }
        ?>
        </div>
      </div>
    </div>
  </div>
</div>