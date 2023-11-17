<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Eliminar email
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
            $sEliminar="DELETE FROM newsletter WHERE Id='$id'";
            $rEliminar = mysql_query($sEliminar,$conexion);
            
            echo '
            <div class="alert alert-info">Se elimin&oacute; el email.</div>
            <div class="pull-right">
              <a href="?seccion=newsletter&nc='.$rand.'" class="btn btn-warning">Aceptar</a>
            </div>
            ';
          }
          else{
            echo '
            <div class="alert alert-danger">&iquest;Confirma eliminar el email?.<br>
              Esta acci&oacute;n no puede deshacerse.<br>
            </div>
            <div class="pull-right m-t-sm">
              <a href="?seccion=newsletter_delete&id='.$id.'&confirmar=si&nc='.$rand.'" class="btn btn-warning">Eliminar</a>
              <a href="?seccion=newsletter&nc='.$rand.'" class="btn btn-warning">Cancelar</a>
            </div>';
          }
        ?>
        </div>
      </div>
    </div>
  </div>
</div>