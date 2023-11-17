<?php
$id = $_GET['id'];

$consulta = "SELECT * FROM contacto_distribuidores WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Contacto distribuidores > ver
      </h2>
    </div>
  </div>
</div>
<?php echo $mensaje; ?>
<div class="content animate-panel">
  <form class="form-horizontal" action="./?seccion=<?php echo $seccion;?>&id=<?php echo $id;?>&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-lg-12">
        <div class="hpanel">
          <div class="panel-body bg-info">
            <div class="form-group">
              <label class="col-sm-3 control-label">Fecha</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" name="fecha" value="<?php echo strftime('%Y-%m-%d', strtotime($rArray['fecha'])); ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Email</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" name="email" value="<?php echo $rArray['email']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre de contacto</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="nombre" value="<?php echo $rArray['nombre']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Teléfono</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="telefono" value="<?php echo $rArray['telefono']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre de la distribuidora</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="distribuidora" value="<?php echo $rArray['distribuidora']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Provincia donde está ubicada</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="provincia" value="<?php echo $rArray['provincia']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Localidad donde distribuye</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="localidad" value="<?php echo $rArray['localidad']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">¿A qué comercios distribuye actualmente?</label>
              <div class="col-sm-9">
<?php
foreach(json_decode($rArray['comercios'], true) as $value){
  echo '
                <input type="text" class="form-control" name="comercios[]" value="'.$value.'" readonly>
  ';
}
?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">¿De qué manera comercializan los productos?</label>
              <div class="col-sm-9">
<?php
foreach(json_decode($rArray['manera'], true) as $value){
  echo '
                <input type="text" class="form-control" name="manera[]" value="'.$value.'" readonly>
  ';
}
?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Web / redes sociales de la distribuidora</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="nombre" value="<?php echo $rArray['web']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">¿Actualmente vende Muecas?</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="nombre" value="<?php echo $rArray['actualmente']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Marcas que más vende actualmente</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="nombre" value="<?php echo $rArray['marcas']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">¿Cómo llegaste al formulario?</label>
              <div class="col-sm-9">
                <textarea class="form-control" name="nombre" readonly><?php echo $rArray['como']; ?></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="hpanel">
          <div class="panel-body">
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=contacto-distribuidor&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>


<script>
$('#provincia_id').on('change', function(){
  provincia_id = this.value;
  
  if(provincia_id!=''){
    if (window.XMLHttpRequest){
      xmlhttp=new XMLHttpRequest();
    }
    else{
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
        $("#localidad_id").html(xmlhttp.responseText);
      }
    }
    xmlhttp.open("POST","secciones/ajax_localidades.php?provincia_id="+provincia_id,true);
    xmlhttp.send();
  }
  else{
    
  }
});
</script>