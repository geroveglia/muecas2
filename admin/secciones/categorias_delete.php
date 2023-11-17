<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
       Categorias > eliminar
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
            $sEliminar = "DELETE FROM categorias WHERE Id='$id'";
            $rEliminar = mysql_query($sEliminar,$conexion);
            
            echo '
            <div class="alert alert-info">Se elimin&oacute; la categoria.</div>
            <div class="pull-right m-t">
              <a href="?seccion=categorias&nc='.$rand.'" class="btn btn-danger">Aceptar</a>
            </div>
            ';
          }
          else{
            echo '
            <div class="alert alert-danger">&iquest;Confirma eliminar el producto?.<br>
              Esta acci&oacute;n no puede deshacerse.<br>
            </div>
            <div class="pull-right m-t">
              <a href="?seccion=categorias_delete&id='.$id.'&confirmar=si&nc='.$rand.'" class="btn btn-danger">Eliminar</a>
              <a href="?seccion=productos&nc='.$rand.'" class="btn btn-danger">Cancelar</a>
            </div>';
          }
        ?>
        </div>
      </div>
    </div>
  </div>
</div>