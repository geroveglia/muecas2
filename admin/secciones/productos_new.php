<?php
if(isset($_POST['guardar'])){
  $codigo = $_POST['codigo'];
  $nombre = $_POST['nombre'];
  $categorias = $_POST['categorias'];
  $sub_nombre = $_POST['sub_nombre'];
  $sub_color = $_POST['sub_color'];
  $frase = $_POST['frase'];
  $valor_energico = $_POST['valor_energico'];
  $carbohidratos = $_POST['carbohidratos'];
  $azucares_totales = $_POST['azucares_totales'];
  $azucares_aniadidos = $_POST['azucares_aniadidos'];
  $proteinas = $_POST['proteinas'];
  $grasas_totales = $_POST['grasas_totales'];
  $grasas_saturadas = $_POST['grasas_saturadas'];
  $grasas_trans = $_POST['grasas_trans'];
  $fibra_alimentaria = $_POST['fibra_alimentaria'];
  $sodio = $_POST['sodio'];
  $comentarios = $_POST['comentarios'];
  $presentacion_minorista = $_POST['presentacion_minorista'];
  $precio_minorista = $_POST['precio_minorista'];
  $stock_minorista = $_POST['stock_minorista'];
  $presentacion_mayorista = $_POST['presentacion_mayorista'];
  $precio_mayorista = $_POST['precio_mayorista'];
  $stock_mayorista = $_POST['stock_mayorista'];
  $ingredientes_btn = $_POST['ingredientes_btn'];
  if($_POST['nuevo']=='1'){$nuevo = '1';}else{$nuevo = '0';}
  if($_POST['stock']=='1'){$stock = '1';}else{$stock = '0';}
  if($_POST['activo_minorista']=='1'){$activo_minorista = '1';}else{$activo_minorista = '0';}
  if($_POST['activo_comercio']=='1'){$activo_comercio = '1';}else{$activo_comercio = '0';}
  if($_POST['activo_distribuidor']=='1'){$activo_distribuidor = '1';}else{$activo_distribuidor = '0';}
  if($_POST['promo_combinada']=='1'){$promo_combinada = '1';}else{$promo_combinada = '0';}
  $lote_id = $_POST['lote_id'];
  
  $url = str_replace(array(' ', 'á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ', '?', '"', '\'', '¿', '.', ',', ';', ':', '#', '(', ')', '!', '�'), array('-', 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'n', 'N', '', '', '', '', '', '', '', '', '', '', ''), $codigo.' - '.$nombre);
  $url = str_replace("--","-",$url);
  $url = str_replace("--","-",$url);
  $url = str_replace("--","-",$url);
  $url = str_replace("--","-",$url);
  $url = strtolower($url);

  

  $sql = "INSERT INTO productos (codigo, categorias, nombre, sub_nombre, sub_color, frase, valor_energico, carbohidratos, azucares_totales, azucares_aniadidos, proteinas, grasas_totales, grasas_saturadas, grasas_trans, fibra_alimentaria, sodio, lote_id, presentacion_minorista, precio_minorista, stock_minorista, presentacion_mayorista, precio_mayorista, stock_mayorista ) VALUES ('$codigo', '$categorias','$nombre', '$sub_nombre','$sub_color', '$frase', '$valor_energico', '$carbohidratos', '$azucares_totales', '$azucares_aniadidos', '$proteinas', '$grasas_totales', '$grasas_saturadas', '$grasas_trans', '$fibra_alimentaria', '$sodio','$lote_id', '$presentacion_minorista', '$precio_minorista', '$stock_minorista', '$presentacion_mayorista', '$precio_mayorista', '$stock_mayorista')";

  $rsql = mysql_query($sql,$conexion);
  $last_id = mysql_insert_id();
  
  if (isset($_POST['sellos']) && is_array($_POST['sellos'])) {
    $sellos_seleccionados = $_POST['sellos'];

    // Recorre los sellos seleccionados e inserta los registros en la tabla productos_sellos
    foreach ($sellos_seleccionados as $sello_id) {
        $query = "INSERT INTO productos_sellos (producto_id, sello_id) VALUES ('$last_id', '$sello_id')";
        // Ejecuta la consulta en la base de datos (debes manejar errores aquí)
        mysql_query($query, $conexion);
    }
    echo "Sellos guardados con éxito.";
} else {
    echo "No se han seleccionado sellos o el ID del producto está vacío.";
}
  
  mkdir('../images/productos/'.$last_id, 0777, true);
  
  $uploads = '../images/productos';
  if($_FILES["foto_producto"]["error"] == 0){
    move_uploaded_file($_FILES['foto_producto']['tmp_name'], $uploads.'/'.$last_id.'/foto_producto.jpg');
  }
  if($_FILES["foto_card"]["error"] == 0){
    move_uploaded_file($_FILES['foto_card']['tmp_name'], $uploads.'/'.$last_id.'/foto_card.jpg');
  }
  
  // Count # of uploaded files in array
  $totalFotos = count($_FILES['fotos']['name']);
  // Loop through each file
  for($i=0; $i<$totalFotos; $i++) {
    //Get the temp file path
    $tmpFilePath = $_FILES['fotos']['tmp_name'][$i];
    //Make sure we have a filepath
    if ($tmpFilePath != ""){
      $sql = "INSERT INTO productos_fotos (producto_id, orden) VALUES ('$last_id', (SELECT COALESCE(MAX(orden), 0) FROM productos_fotos C WHERE producto_id='$last_id')+ 1)";
      $rsql = mysql_query($sql,$conexion);
      $last_image_id = mysql_insert_id();
      
      //Setup our new file path
      $newFilePath = "../images/productos/".$last_id."/".$last_image_id.".jpg";
      //Upload the file into the temp dir
      move_uploaded_file($tmpFilePath, $newFilePath);
    }
  }
  
  $mensaje = mysql_errno($conexion) . ": " . mysql_error($conexion) . "\n";


}

?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Productos > nuevo
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
          <form class="form-horizontal" action="./?seccion=productos_new&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Categoria</label>
              <div class="col-sm-10">
                <select class="form-control" name="categorias" required>
                  <option value="">Seleccionar</option>
<?php
$consultaC = "SELECT * FROM categorias";
$resultadoC = mysql_query($consultaC,$conexion);
while($rArrayC = mysql_fetch_array($resultadoC)) {
  echo '
                  <option value="'.$rArrayC['Id'].'" '.(($rArrayC['Id']==$rArray['nombre'])?'selected':'').'>'.$rArrayC['nombre'].'</option>
  ';
}
?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nombre</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nombre" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Sub-Nombre</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="sub_nombre" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Sub-Color</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="sub_color" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Frase</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="frase" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Sistema de Lotes</label>
              <div class="col-sm-10">
                <select class="form-control" name="lote_id" required>
                  <option value="">Seleccionar</option>
<?php
$consultaC = "SELECT * FROM reclamos_lotes ORDER BY lote";
$resultadoC = mysql_query($consultaC,$conexion);
while($rArrayC = mysql_fetch_array($resultadoC)) {
  echo '
                  <option value="'.$rArrayC['Id'].'" '.(($rArrayC['Id']==$rArray['lote_id'])?'selected':'').'>'.$rArrayC['lote'].'</option>
  ';
}
?>
                </select>
              </div>
            </div>
            
            <div class="resaltar mb-4">
              <h3>Tabla nutricional</h3>
              <div class="form-group">
                <label class="col-sm-2 control-label">Valor energico</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="valor_energico" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Carbohidratos</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="carbohidratos" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Azúcares totales</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="azucares_totales" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Azúcares aniadidos</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="azucares_aniadidos" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Proteinas</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="proteinas" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Grasas totales</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="grasas_totales" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Grasas saturadas</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="grasas_saturadas" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Grasas trans</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="grasas_trans" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Fibra alimentaria</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="fibra_alimentaria" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sodio</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="sodio" required>
                </div>
              </div>

            </div>



            
            <div class="form-group">
              <label class="col-sm-2 control-label">Fotos cabecera</label>
              <div class="col-sm-10">
                <input type="file" name="fotos[]" accept="image/jpeg" class="btn btn-warning btn-outline" multiple>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Foto producto</label>
              <div class="col-sm-10">
                <input type="file" name="foto_producto" accept="image/jpeg,image/png" class="btn btn-warning btn-outline">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Foto card</label>
              <div class="col-sm-10">
                <input type="file" name="foto_card" accept="image/jpeg,image/png" class="btn btn-warning btn-outline">
              </div>
            </div>



            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <?php
                  $consultaD = "SELECT * FROM sellos";
                  $resultadoD = mysql_query($consultaD,$conexion);

              while($rArrayD = mysql_fetch_array($resultadoD)) {
                  echo '<label class="checkbox-inline i-checks">';
                  echo '<div class="icheckbox_square-green"><input type="checkbox" name="sellos[]" value="' . $rArrayD['Id'] . '"><ins class="iCheck-helper"></ins></div>';
                  echo '<i></i>' . $rArrayD['nombre']; // Muestra el nombre de la fila junto al checkbox
                  echo '</label>';
              }
                  ?>
                </div>
              </div>


              
              <h3>Minorista</h3>
            <div class="form-group">
              <label class="col-sm-2 control-label">Presentacion</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="presentacion_minorista" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Precio</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="precio_minorista" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Stock</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="stock_minorista" required>
              </div>
            </div>
          
          
              <h3>Mayorista</h3>
            <div class="form-group">
              <label class="col-sm-2 control-label">Presentacion</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="presentacion_mayorista" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Precio</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="precio_mayorista" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Stock</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="stock_mayorista" required>
              </div>
            </div>
          

              <!--
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
                <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green"><input type="checkbox" name="stock" value="1" checked><ins class="iCheck-helper"></ins></div> <i></i> Stock </label>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
                <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green"><input type="checkbox" name="activo_minorista" value="1" checked><ins class="iCheck-helper"></ins></div> <i></i> Activo minorista </label>
                <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green"><input type="checkbox" name="activo_comercio" value="1" checked><ins class="iCheck-helper"></ins></div> <i></i> Activo comercios </label>
                <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green"><input type="checkbox" name="activo_distribuidor" value="1" checked><ins class="iCheck-helper"></ins></div> <i></i> Activo distribuidor </label>
              </div>
            </div>
          -->
          <div class="form-group mt-9">
              <label class="col-sm-2 control-label">Comentarios</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="comentarios"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a href="./?seccion=productos&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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