<?php
if(isset($_POST['orden'])){
  $orden = json_decode($_POST['orden'], TRUE);
  $x=1;
  foreach($orden as $value){
  $id = $value['id'];
    $sql = "UPDATE slider SET orden='$x' WHERE Id='$id'";
    $rsql = mysql_query($sql,$conexion);
    $x++;
  }
  $mensaje = '<div class="alert alert-info">Orden actualizado satisfactoriamente.</div>';
}
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Ordenar slides
      </h2>
    </div>
  </div>
</div>
<?php echo $mensaje; ?>
<div class="content animate-panel">
  <div class="row">
    <div class="col-lg-4">
      <div class="hpanel">
        <div class="panel-body">
          <div class="dd" id="nestable">
            <ol class="dd-list">
              <?php
              $consulta = "SELECT * FROM slider ORDER BY orden";
              $resultado = mysql_query($consulta,$conexion);
              while($rArray = mysql_fetch_array($resultado)) {
                echo '<li class="dd-item" data-id="'.$rArray['Id'].'">
                <div class="dd-handle"><img src="../images/slider/'.$rArray['Id'].'.jpg?nc='.$rand.'" class="img-responsive"></div>
                </li>
              ';
              }
              ?>
            </ol>
          </div>
          <form action="./?seccion=slider_order&nc=<?php echo $rand; ?>" method="post">
            <input type="hidden" id="orden" name="orden">
            <div class="pull-right">
              <a href="./?seccion=slider&id=<?php echo $catid; ?>&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
              <input type="submit" value="Guardar" class="btn btn-warning">
            </div>
          </form>   
        </div>
      </div>
    </div>
  </div>
</div>

<script src="vendor/nestable/jquery.nestable.js"></script>

<script>
     $(document).ready(function(){

         var updateOutput = function (e) {
             var list = e.length ? e : $(e.target),
                     output = list.data('output');
             if (window.JSON) {
                 output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
             } else {
                 output.val('JSON browser support required for this demo.');
             }
         };
         // activate Nestable for list 1
         $('#nestable').nestable({
             group: 1,
             maxDepth :1
         }).on('change', updateOutput);

         // output initial serialised data
         updateOutput($('#nestable').data('output', $('#orden')));

     });
</script>
