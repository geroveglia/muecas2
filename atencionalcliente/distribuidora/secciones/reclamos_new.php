<?php
if($_POST['guardar']!=''){
  $codigos = array(
    '2020'=>'',
    '2021'=>'',
    '2022'=>'B',
    '2023'=>'C',
    '2024'=>'D',
    '2025'=>'E',
    '2026'=>'F',
    '2027'=>'G',
    '2028'=>'H',
    '2029'=>'I',
    '2030'=>'J',
    '2031'=>'K',
    '2032'=>'L',
    '2033'=>'M',
    '2034'=>'N',
    '2035'=>'O',
    '2036'=>'P',
    '2037'=>'Q',
    '2038'=>'R',
    '2039'=>'S',
    '2040'=>'T'
  );
  $id = $_GET['id'];
  $distribuidor_id = $_SESSION["user_id"];

  $consulta1 = "SELECT * FROM clientes WHERE Id = '$distribuidor_id'";
  $resultado1 = mysql_query($consulta1,$conexion);
  $rArray = mysql_fetch_array($resultado1);

  $nombre = $rArray['nombre'];
  $email = $rArray['email'];
  $telefono = $rArray['telefono'];
  $direccion = $_POST['direccion'];
  $provincia_id = $_POST['provincia_id'];
  $localidad_id = $_POST['localidad_id'];
  $informacion_relevante = $_POST['informacion_relevante'];
  $cantidad_barritas = $_POST['cantidad_barritas'];
  $lote = $_POST['lote'];
  $fecha_vencimiento = $_POST['fecha_vencimiento'];
  

  $anioVencimiento = date('Y', strtotime('-6 months', strtotime($fecha_vencimiento))); 
$lote = $codigos[$anioVencimiento].'-'.$lote;

if ($_POST['codigo_lote']!='') {
    $lote .= $_POST['mes'].$_POST['anio']."L".$_POST['codigo_lote'].$_POST['turno'];
}

if ($_POST['x']!='') {
    $lote .= $_POST['x']."L".$_POST['abc'].$_POST['vto'].$_POST['dia-lote-3'].$_POST['mes-lote-3'].$_POST['anio-lote-3'];
}

  
  $barrita = $_POST['barrita'];
  $tipo_cliente = 'Distribuidora';
  $fecha_fabricacion = $_POST['fecha_fabricacion'];

  $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $repetido = 1;
  while($repetido>0){
    $codigo = substr(str_shuffle($permitted_chars), 0, 4);
    $consulta = "SELECT * FROM reclamos WHERE codigo='$codigo'";
    $resultado = mysql_query($consulta,$conexion);
    $repetido = mysql_num_rows($resultado);
  }


if (!empty($fecha_vencimiento)) {
    $sql = "INSERT INTO reclamos (nombre, email, telefono, informacion_relevante, cantidad_barritas, lote, fecha_vencimiento, fecha, estatus, barrita, tipo_cliente, codigo, distribuidor_id) VALUES ('$nombre', '$email', '$telefono', '$informacion_relevante', '$cantidad_barritas', '$lote', '$fecha_vencimiento', NOW(), 'Abierto', '$barrita', '$tipo_cliente', '$codigo', '$distribuidor_id')";
} else {
    $sql = "INSERT INTO reclamos (nombre, email, telefono, informacion_relevante, cantidad_barritas, lote, fecha, estatus, barrita, tipo_cliente, codigo, distribuidor_id) VALUES ('$nombre', '$email', '$telefono', '$informacion_relevante', '$cantidad_barritas', '$lote', NOW(), 'Abierto', '$barrita', '$tipo_cliente', '$codigo', '$distribuidor_id')";
}

$rsql = mysql_query($sql, $conexion);
$last_id = mysql_insert_id();


  //FOTO1
  if($_FILES["foto1"]["error"] == 0){
    $tmpFilePath = $_FILES['foto1']['tmp_name'];
    $archivo = $last_id.'_'.mt_rand();
    $extension = pathinfo($_FILES['foto1']['name'], PATHINFO_EXTENSION);
    if ($tmpFilePath != ""){
      $newFilePath = "../fotos/".$producto_id."/".$archivo.".".$extension;
      $archivo_extension = $archivo.".".$extension;
      if(move_uploaded_file($tmpFilePath, $newFilePath)){
        $sql = "UPDATE reclamos SET foto1='$archivo_extension' WHERE Id='$last_id'";
        $rsql = mysql_query($sql,$conexion);
      }
    }
  }
  //FOTO2
  if($_FILES["foto2"]["error"] == 0){
    $tmpFilePath = $_FILES['foto2']['tmp_name'];
    $archivo = $last_id.'_'.mt_rand();
    $extension = pathinfo($_FILES['foto2']['name'], PATHINFO_EXTENSION);
    if ($tmpFilePath != ""){
      $newFilePath = "../fotos/".$producto_id."/".$archivo.".".$extension;
      $archivo_extension = $archivo.".".$extension;
      if(move_uploaded_file($tmpFilePath, $newFilePath)){
        $sql = "UPDATE reclamos SET foto2='$archivo_extension' WHERE Id='$last_id'";
        $rsql = mysql_query($sql,$conexion);
      }
    }
  }
  //FOTOS ADICIONALES
  $totalFotos = count($_FILES['fotos']['name']);
  for($i=0; $i<$totalFotos; $i++) {
    $tmpFilePath = $_FILES['fotos']['tmp_name'][$i];
    $archivo = $last_id.'_'.mt_rand();
    $extension = pathinfo($_FILES['fotos']['name'][$i], PATHINFO_EXTENSION);
    if ($tmpFilePath != ""){
      $newFilePath = "../fotos/".$producto_id."/".$archivo.".".$extension;
      if(move_uploaded_file($tmpFilePath, $newFilePath)){
        $sql = "INSERT INTO reclamos_fotos (reclamo_id, archivo, extension) VALUES ('$last_id', '$archivo', '$extension')";
        $rsql = mysql_query($sql,$conexion);
      }
    }
  }

  $consulta = "SELECT * FROM reclamos_textos WHERE tipo='$tipo_cliente'";
  $resultado = mysql_query($consulta,$conexion);
  $rArray = mysql_fetch_array($resultado);
  $texto = $rArray['texto'];
  $CuerpoEmail = '
  <div style="background: #FFF; max-width: 600px;">
    <div style="background: #0C0C0C; text-align: center; padding: 10px; margin-bottom: 30px;">
      <img src="https://www.muecas.com.ar/atencionalcliente/img/logo-blanco.png" style="max-width: 250px;">
    </div>
    <h4>Hola ¿Cómo estás?</h4>
    <div style="margin-bottom: 20px;">
      '.nl2br($texto).'
    </div>
    <h2 style="color: #0C0C0C; margin-bottom: 20px;">Código de seguimiento "'.$codigo.'"</h2>
    <div style="margin-bottom: 20px;">
      Saludos<br>
      Equipo Muecas
    </div>
  </div>
  ';
    
  $ruta='../../PHPMailer/class.phpmailer.php';
  require($ruta);
  $mail = new PHPMailer();
  $mail->IsHTML(true);
  $mail->FromName = "Muecas";
  $mail->From = "web@muecas.com.ar";
  $mail->AddAddress($email);
  $mail->AddReplyTo("contacto@muecas.com.ar");
  $mail->CharSet = 'UTF-8';
  $mail->WordWrap = 50;
  $mail->Mailer = "smtp";
  $mail->SMTPAuth = true;
  $mail->Port = 25;
  $mail->Host = "mail.muecas.com.ar";  
  $mail->Username = "web@muecas.com.ar";
  $mail->Password = "trOd786wZ4";
  $mail->Subject = 'Atención al cliente Muecas';
  $mail->Body = $CuerpoEmail;
  //$mail->Send();

  $CuerpoEmail = '
  <div style="background: #FFF; text-align: center; padding: 20px; width: 90%; border: solid 3px #0C0C0C">
  <h2 style="color: #0C0C0C;">Código de seguimiento "'.$codigo.'"</h2><br>
  <h4>Nuevo caso de atención al cliente.</h4>
  <div style="margin-bottom: 20px;">
    <a href="https://www.muecas.com.ar/admin/?seccion=reclamos_edit&id='.$last_id.'" style="color: #FFF; background-color: #0C0C0C; border-color: #0C0C0C; border-radius: 3px; line-height: 22px; display: inline-block; font-weight: normal; text-align: center; vertical-align: middle; font-size: 14px; font-family: sans-serif; padding: 8px 19px; text-decoration:none">Ver caso</a><br><br><br>
  </div>
  
  <img src="https://www.muecas.com.ar/atencionalcliente/img/logo.png" style="max-width: 250px;">
  </div>
  ';
  $mail = new PHPMailer();
  $mail->clearAllRecipients();
  $mail->IsHTML(true);
  $mail->FromName = $nombre;
  $mail->From = "web@muecas.com.ar";
  $mail->AddAddress("calidad@muecas.com.ar");
  $consulta = "SELECT * FROM usuarios WHERE tipo='Administrador' OR tipo='Operador'";
  $resultado = mysql_query($consulta,$conexion);
  while($rArray = mysql_fetch_array($resultado)) {
    if($rArray['email']!=''){
      $mail->AddAddress($rArray['email']);
    }
  }
  $mail->AddReplyTo($email);
  $mail->CharSet = 'UTF-8';
  $mail->WordWrap = 50;
  $mail->Mailer = "smtp";
  $mail->SMTPAuth = true;
  $mail->Port = 25;
  $mail->Host = "mail.muecas.com.ar";  
  $mail->Username = "web@muecas.com.ar";
  $mail->Password = "trOd786wZ4";
  $mail->Subject = $codigo.' | Atención al cliente Muecas';
  $mail->Body = $CuerpoEmail;
  //$mail->Send();

  $mensaje = '<div class="alert alert-info">Reclamo agregad0 satisfactoriamente.</div>';
  //mysql_errno($conexion) . ": " . mysql_error($conexion) . "\n";
}

?>
<!-- Main Wrapper -->
<div id="wrapper" class="">
  <div class="normalheader transition animated fadeIn small-header">
    <div class="hpanel">
      <div class="panel-body">
        <h2>
        Mi perfil 
        </h2>
      </div>
    </div>
  </div>
<?php echo $mensaje;?>
  <div class="content animate-panel">
    <div class="row">
      <div class="col-lg-12">
        <div class="hpanel">
          <div class="panel-body m-b p-b">
            <form class="form-horizontal" action="./?seccion=reclamos_new&nc=<?php echo $rand;?>" method="POST" enctype="multipart/form-data">
              <!---
              <h4 class="texto-amarillo"><span class="texto-negro">PASO 1 | </span>Datos del Lugar donde fue realizada la compra</h4>
              <div class="form-group">
                <label class="col-sm-2 control-label">Direccion</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="direccion" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Provincia</label>
                <div class="col-sm-10">
                  <select class="form-control" id="provincia_id" name="provincia_id" required>
                    <option value=""></option>
                    <?php
                    $consulta = "SELECT * FROM provincias_reclamos";
                    $resultado = mysql_query($consulta,$conexion);
                    while($rArray = mysql_fetch_array($resultado)){
                      echo '
                      <option value="'.$rArray['Id'].'">'.$rArray['provincia'].'</option>
                      ';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Localidad</label>
                <div class="col-sm-10">
                  <select class="form-control" id="localidad_id" name="localidad_id" required>
                    <option value=""></option>
                  </select>
                </div>
              </div>
              --->
              <h4 class="texto-amarillo"><span class="texto-negro"></span>Datos del producto</h4>
              <div class="form-group">
                <label class="col-sm-2 control-label">Producto que estás reclamando</label>
                <div class="col-sm-10">
                  <select class="form-control" name="barrita" id="producto_id" required>
    <option value=""></option>
    <?php
    $consulta = "SELECT *, productos.Id AS Id FROM productos LEFT JOIN reclamos_lotes ON reclamos_lotes.Id=productos.lote_id";
    $resultado = mysql_query($consulta, $conexion);
    while ($rArray = mysql_fetch_array($resultado)) {
        echo '
        <option value="' . $rArray['nombre'] . '" data-loteid="' . $rArray['lote_id'] . '">' . $rArray['nombre'] . '</option>
        ';
    }
    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Cantidad de unidades afectadas</label>
                <div class="col-sm-10">
                  <div class="form-floating mb-2">
                    <input type="number" min="1" class="form-control" name="cantidad_barritas" id="cantidad_barritas" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Información relevante</label>
                <div class="col-sm-10">
                  <div class="form-floating mb-2">
                    <textarea class="form-control" name="informacion_relevante" id="informacion_relevante" placeholder="Agrega toda la información relevante para que podamos asesorarte y llevar adelante el análisis de la manera más eficiente" required></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Lote</label>
                <div class="col-sm-10">
                  <div id="contenedor-lote-1" class="contenedor-lote" style="display: none;">
                    <select class="form-control" id="lote" name="lote">
                      <option value=""></option>
                      <?php
                      $x = 1;
                      while ($x <= 366) {
                        echo '
                        <option value="L' . sprintf('%03d', $x) . '">L' . sprintf('%03d', $x) . '</option>
                        ';
                        $x++;
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div id="contenedor-lote-2" class="contenedor-lote mt-3 mb-3 oculto">
                <div class="d-flex align-items-stretch">
                  <div class="col-10">
                    <div class="row">
                      <div class="col-md-2 mb-2" style="margin-left: 156px;" >
                        <select class="form-control" name="mes" id="mes">
                          <option value=""></option>
                          <option value="ENE">ENE</option>
                          <option value="FEB">FEB</option>
                          <option value="MAR">MAR</option>
                          <option value="ABR">ABR</option>
                          <option value="MAY">MAY</option>
                          <option value="JUN">JUN</option>
                          <option value="JUL">JUL</option>
                          <option value="AGO">AGO</option>
                          <option value="SEP">SEP</option>
                          <option value="OCT">OCT</option>
                          <option value="NOV">NOV</option>
                          <option value="DIC">DIC</option>
                        </select>
                      </div>
                      <div class="col-md-2 mb-2">
                        <select class="form-control" name="anio" id="anio">
                          <option value=""></option>
                        </select>
                      </div>
                      <script>
                        const selectElement = document.getElementById('anio');
                        const currentYear = new Date().getFullYear();
                        for (let i = currentYear - 3; i <= currentYear + 3; i++) {
                          const option = document.createElement('option');
                          option.value = i;
                          option.text = i;
                          selectElement.appendChild(option);
                        }
                      </script>
                      <div class="col-md-1 mb-2">
                        <input type="text" class="form-control" name="L" readonly placeholder="L">
                      </div>
                      <div class="col-md-2 mb-6">
                        <input type="number" class="form-control" name="codigo_lote" min="100000" max="999999" placeholder="6 digitos">
                      </div>
                      <div class="col-md-2 mb-2">
                        <select class="form-control" name="turno" id="turno">
                          <option value=""></option>
                          <option value="M">M</option>
                          <option value="T">T</option>
                          <option value="N">N</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2 m-t">
                    </div>
                    <div class="col-md-2 offset-md-8 mb-1 m-t" style="margin-left: -10px;" >
                      <img src="../img/lote2.jpg" class="mb-2 mt-1 imagen-con-margen1 admin-thumb">
                    </div>
                  </div>
                </div>
              </div>
              <div id="contenedor-lote-3" class="contenedor-lote mt-3 mb-2 oculto">
                <div class="d-flex align-items-stretch">
                  <div class="col-10">
                    <div class="row">
                      <div class="col-md-1 mb-2" style="margin-left: 156px;" >
                        <select class="form-control" name="x" id="x">
                          <option value=""></option>
                          <option value="X">X</option>
                          <option value="Y">2</option>
                        </select>
                      </div>
                      <div class="col-md-1 mb-3">
                        <input type="text" class="form-control" name="L" readonly placeholder="L" max="366">
                      </div>
                      <div class="col-md-1 mb-1">
                        <input type="number" class="form-control" name="abc" min="100" max="999" placeholder="3 digitos">
                      </div>
                      <div class="col-md-1 mb-3">
                        <input type="text" class="form-control" name="vto" readonly placeholder="VTO">
                      </div>
                      <div class="col-md-1 mb-3">
                        <select class="form-control" name="dia-lote-3" id="dia-lote-3">
                          <option value=""></option>
                          <?php for ($i = 1; $i <= 31; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col-md-1 mb-3">
                        <select class="form-control" name="mes-lote-3" id="mes-lote-3">
                          <option value=""></option>
                          <?php for ($i = 1; $i <= 12; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col-md-2 mb-3">
                        <select class="form-control" name="anio-lote-3" id="anio-lote-3">
                          <option value=""></option>
                        </select>
                      </div>
                      <div class="col-md-2 m-t">
                      </div>
                      <div class="col-md-2 offset-md-8 mb-1  m-t" style="margin-left: 156px;" >
                        <img src="../img/lote3.jpg" class="mb-2 mt-1 imagen-con-margen admin-thumb">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="contenedor-lote-4" class="contenedor-lote" style="display: none;">
                <div class="form-group" >
                  <label class="col-sm-2 control-label" for="fecha_vencimiento">Fecha de vencimiento</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="fecha_vencimiento">
                  </div>
                </div>
              </div>

              <div class="form-group">
                
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Foto Fecha vencimiento y/o número del lote (obligatoria)</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="foto1" name="foto1" accept="image/*" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Foto del motivo del reclamo (obligatoria)</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="foto2" name="foto2" accept="image/*" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Si lo necesitás, podés subir más fotos acá</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="fotos" name="fotos[]" accept="image/*" multiple>
                </div>
              </div>
              <div class="form-group">
                <i class="small text-danger"><i class="far fa-exclamation-triangle"></i> Aclaración: "Sólo recibimos fotos, de tener videos o querer enviarnos más fotos, por favor hacerlo a <a class="texto-negro" href="mailto:contacto@muecas.com.ar">contacto@muecas.com.ar</a>, es importante que en el asunto y/o cuerpo del correo se indique el número de seguimiento del caso para poder identificarlo. Sin esta información no será tenido en cuenta el registro audiovisual."</i>
              </div>

              <script>
                const selectElement1 = document.getElementById('anio-lote-3');
                const currentYear1 = new Date().getFullYear();
                for (let x = currentYear1 - 3; x <= currentYear1 + 3; x++) {
                  const option1 = document.createElement('option');
                  option1.value = x;
                  option1.text = x;
                  selectElement1.appendChild(option1);
                }
              </script>
              <?php  $rArray['l']  ?>
              <script>
                  $(document).ready(function () {
                    $('#producto_id').on('change', function () {
                      var loteid = $(this).find('option:selected').data('loteid');
                      $('.contenedor-lote').hide(); // Oculta todos los contenedores de lote
                      if (loteid === 1) {
                        $('#contenedor-lote-1, #contenedor-lote-4').show(); // Muestra ambos contenedores
                        // Establece la propiedad 'required' para los elementos dentro de ambos contenedores
                        $('#contenedor-lote-1 select, #contenedor-lote-1 input, #contenedor-lote-4 select, #contenedor-lote-4 input').prop('required', true);
                      } else {
                        $('#contenedor-lote-' + loteid).show(); // Muestra el contenedor correspondiente
                        // Establece la propiedad 'required' para los elementos dentro del contenedor seleccionado
                        $('#contenedor-lote-' + loteid + ' select, #contenedor-lote-' + loteid + ' input').prop('required', true);
                      }
                    });
                  });
                </script>
              <div class="form-group" >
                <div class="col-sm-12">
                  <div class="pull-right">
                  <a href="./?seccion=reclamos&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
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
  
  <script>
    $('#provincia_id').on('change', function () {
      provincia_id = this.value;

      if (provincia_id != '') {
        if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
        } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            $("#localidad_id").html(xmlhttp.responseText);
          }
        }
        xmlhttp.open("POST", "../secciones/ajax_localidades.php?provincia_id=" + provincia_id, true);
        xmlhttp.send();
      } else {

      }
    });

    $(document).ready(function () {
      $('.select2').select2();
    });
  </script>
</div>

