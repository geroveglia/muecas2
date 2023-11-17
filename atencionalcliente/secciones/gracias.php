<?php
if($_POST['email']!=''){
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
  $tipo_cliente = mysql_real_escape_string($_POST['tipo_cliente']);
  $nombre = mysql_real_escape_string($_POST['nombre']);
  $email = mysql_real_escape_string($_POST['email']);
  $telefono = mysql_real_escape_string($_POST['telefono']);
  $provincia_id = mysql_real_escape_string($_POST['provincia_id']);
  $localidad_id = mysql_real_escape_string($_POST['localidad_id']);
  $informacion_relevante = mysql_real_escape_string($_POST['informacion_relevante']);
  $cantidad_barritas = mysql_real_escape_string($_POST['cantidad_barritas']);
  $lote = mysql_real_escape_string($_POST['lote']);
  $fecha_vencimiento = mysql_real_escape_string($_POST['fecha_vencimiento']);
  $consumidor_final = $_POST['consumidor_final'];
  $direccion = mysql_real_escape_string($_POST['direccion']);
  $barrita = $_POST['barrita'];

  $anioVencimiento = date('Y', strtotime('-6 months', strtotime($fecha_vencimiento))); 
  $lote = $codigos[$anioVencimiento].'-'.$lote;

  if ($_POST['codigo_lote']!='') {
    $lote = $_POST['mes'].$_POST['anio']."L".$_POST['codigo_lote'].$_POST['turno'];
  }

  if ($_POST['x']!='') {
    $lote = $_POST['x']."L".$_POST['abc'].$_POST['vto'].$_POST['dia-lote-3'].$_POST['mes-lote-3'].$_POST['anio-lote-3'];
  }


  $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $repetido = 1;
  while($repetido>0){
    $codigo = substr(str_shuffle($permitted_chars), 0, 4);
    $consulta = "SELECT * FROM reclamos WHERE codigo='$codigo'";
    $resultado = mysql_query($consulta,$conexion);
    $repetido = mysql_num_rows($resultado);
  }

  $sql = "INSERT INTO reclamos (nombre, email, telefono, provincia_id, localidad_id, informacion_relevante, cantidad_barritas, lote, fecha_vencimiento, fecha, direccion, estatus, barrita, tipo_cliente, codigo) VALUES ('$nombre', '$email', '$telefono', '$provincia_id', '$localidad_id', '$informacion_relevante', '$cantidad_barritas', '$lote', '$fecha_vencimiento', NOW(), '$direccion', 'Abierto', '$barrita', '$tipo_cliente', '$codigo')";
  $rsql = mysql_query($sql,$conexion);
  $last_id = mysql_insert_id();

  //FOTO1
  if($_FILES["foto1"]["error"] == 0){
    $tmpFilePath = $_FILES['foto1']['tmp_name'];
    $archivo = $last_id.'_'.mt_rand();
    $extension = pathinfo($_FILES['foto1']['name'], PATHINFO_EXTENSION);
    if ($tmpFilePath != ""){
      $newFilePath = "fotos/".$producto_id."/".$archivo.".".$extension;
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
      $newFilePath = "fotos/".$producto_id."/".$archivo.".".$extension;
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
      $newFilePath = "fotos/".$producto_id."/".$archivo.".".$extension;
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
    
  $ruta='../PHPMailer/class.phpmailer.php';
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
}
?>
        <h2 class="">Gracias.</h2>
        <h3 class="texto-amarillo my-3">¡Tu formulario fue enviado!</h3>
        <h4 class="my-3">A la brevedad vamos a estar trabajando en tu caso.</h3>
        <h5 class="mt-3 mb-5 texto-amarillo">Tu código de seguimiento es: <span class="texto-negro">[<?php echo $codigo;?>]</span>.</h5>
        <img src="../images/share2.jpg">

        <div class="mb-2 text-center mt-4">
  <form action="./atencionalcliente/" method="get">
    <button type="submit" class="btn btn-negro px-5 btn-lg">Generar otro reclamo</button>
  </form>
</div>