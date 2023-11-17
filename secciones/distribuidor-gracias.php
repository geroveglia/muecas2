<?php
if($_POST['nombre']!='' && $_POST['email']!='' && $_POST['telefono']!=''){
  $email = mysql_real_escape_string($_POST['email']);
  $nombre = mysql_real_escape_string($_POST['nombre']);
  $telefono = mysql_real_escape_string($_POST['telefono']);
  $distribuidora = mysql_real_escape_string($_POST['distribuidora']);
  $provincia_id = mysql_real_escape_string($_POST['provincia_id']);
  $localidad = mysql_real_escape_string($_POST['localidad']);
  $comercios = mysql_real_escape_string($_POST['comercios']);
  foreach($comercios as $value){
    $lista_comercios = $lista_comercios.$value.'<br>';
  }
  $manera = mysql_real_escape_string($_POST['manera']);
  foreach($manera as $value){
    $lista_maneras = $lista_maneras.$value.'<br>';
  }
  $web = mysql_real_escape_string($_POST['web']);
  $actualmente = mysql_real_escape_string($_POST['actualmente']);
  $marcas = mysql_real_escape_string($_POST['marcas']);
  $como = mysql_real_escape_string($_POST['como']);
  

  $comercios = json_encode($_POST['comercios'], JSON_UNESCAPED_UNICODE);
  $manera = json_encode($_POST['manera'], JSON_UNESCAPED_UNICODE);
  $consultaB = "SELECT * FROM provincias_reclamos WHERE Id='$provincia_id'";
  $resultadoB = mysql_query($consultaB,$conexion);
  $rArrayB = mysql_fetch_array($resultadoB);
  $provincia = $rArrayB['provincia'];

  $sql = "INSERT INTO contacto_distribuidores (email, nombre, telefono, distribuidora, provincia, localidad, comercios, manera, web, actualmente, marcas, como, fecha) VALUES ('$email', '$nombre', '$telefono', '$distribuidora', '$provincia', '$localidad', '$comercios', '$manera', '$web', '$actualmente', '$marcas', '$como', NOW())";
  $rsql = mysql_query($sql,$conexion);
  $last_id = mysql_insert_id();

  $CuerpoEmail = '
  <div style="background: #FFF; text-align: left; padding: 20px; width: 90%; border: solid 3px #efab41; border-radius: 2px;">
  <h2 style="color: #efab41;">Quiero ser distribuidor Muecas</h2><br>
  
  <b>Email:</b> '.$email.'<br>
  <b>Nombre de contacto:</b> '.$nombre.'<br>
  <b>Teléfono:</b> '.$telefono.'<br>
  <b>Nombre de la distribuidora:</b> '.$distribuidora.'<br>
  <b>Provincia donde está ubicada:</b> '.$provincia_id.'<br>
  <b>Localidad donde distribuye:</b> '.$localidad.'<br>
  <b>¿A qué comercios distribuye actualmente?:</b> '.$lista_comercios.'<br>
  <b>¿De qué manera comercializan los productos?:</b> '.$lista_maneras.'<br>
  <b>Web / redes sociales de la distribuidora:</b> '.$web.'<br>
  <b>¿Actualmente vende Muecas?:</b> '.$actualmente.'<br>
  <b>Marcas que más vende actualmente:</b> '.$marcas.'<br>
  <b>¿Cómo llegaste al formulario?:</b> '.$como.'<br><br><br>
  
  <img src="https://www.muecas.com.ar/images/logo_naranja.png" style="max-width: 250px;">
  </div>
  ';
  
  $ruta='PHPMailer/class.phpmailer.php'; 
  require($ruta);
  $mail = new PHPMailer();
  $mail->IsHTML(true);
  $mail->FromName = "Muecas";
  $mail->From = "web@muecas.com.ar";
  $mail->AddAddress("info@muecas.com.ar");
  //$mail->AddAddress("mardix@gmail.com");
  $mail->AddReplyTo($email);
  $mail->CharSet = 'UTF-8';
  $mail->WordWrap = 50;
  $mail->Mailer = "smtp";
  $mail->SMTPAuth = true;
  $mail->Port = 25;
  $mail->Host = "mail.muecas.com.ar";  
  $mail->Username = "web@muecas.com.ar";
  $mail->Password = "trOd786wZ4";
  $mail->Subject = 'Quiero ser distribuidor Muecas - '.$nombre;
  $mail->Body = $CuerpoEmail;
  $mail->Send();

}
?>
      <section class="section_02_quiero_ser_distribuidor">
        <div class="d-flex flex-column justify-content-center">
          <div>
            <h1 class="text-center secondary_font gs_reveal">
              <span class="animated-text">
                ¡Muchas<br />
                gracias por<br />
                tu contacto!
              </span>
            </h1>
            <div class="section_02_contacto_gracias_analizaremos p-2 ps-4 pe-4 gs_reveal gs_reveal_fromBottom3">
              <p class="custom_font_color_negro p-0 m-0 text-center">
                Analizaremos tu solicitud y te <br />
                responderemos a la brevedad
              </p>
            </div>
          </div>
        </div>
      </section>