<?php
$id = $_GET['id'];
$consulta = "SELECT * FROM clientes WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$nombre = $rArray['nombre'];
$email = $rArray['email'];
$contrasenia = $rArray['contrasenia'];

$CuerpoEmail = '
  <div style="background: #FFF; text-align: center; padding: 20px; width: 90%; border: solid 3px #efab41; border-radius: 2px;">
  <h2 style="color: #efab41;">Datos de acceso Muecas Barritas</h2><br>
  <h4>Hola '.$nombre.'.</h4>
  Estos son tus datos para ingresar a nuestra web:<br><br>
  <b>Email:</b> '.$email.'<br>
  <b>Contrase&ntilde;a:</b> '.$contrasenia.'<br><br>
  Ingres&aacute; haciendo click en el siguiente enlace:<br><br>
  <a href="https://www.muecas.com.ar/ingresar/" style="color: #FFF; background-color: #efab41; border-color: #efab41; border-radius: 3px; line-height: 22px; display: inline-block; font-weight: normal; text-align: center; vertical-align: middle; font-size: 14px; font-family: sans-serif; padding: 8px 19px; text-decoration:none">INGRESAR</a><br><br><br>
  
  <img src="https://www.muecas.com.ar/images/logo_naranja.png" style="max-width: 250px;">
  </div>
';

$ruta='../PHPMailer/class.phpmailer.php'; 
require($ruta);
$mail = new PHPMailer();
$mail->IsHTML(true);
$mail->FromName = "Muecas";
$mail->From = "web@muecas.com.ar";
$mail->AddAddress($email);
$mail->AddReplyTo("info@muecas.com.ar");
$mail->CharSet = 'UTF-8';
$mail->WordWrap = 50;
$mail->Mailer = "smtp";
$mail->SMTPAuth = true;
$mail->Port = 25;
$mail->Host = "mail.muecas.com.ar";  
$mail->Username = "web@muecas.com.ar";
$mail->Password = "trOd786wZ4";
$mail->Subject = 'Datos de acceso Muecas';
$mail->Body = $CuerpoEmail;
$mail->Send();
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Clientes > enviar accesos
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
          <div class="alert alert-info">Datos de acceso enviados al cliente.</div>
          <div class="pull-right m-t">
            <a href="?seccion=<?php echo $_GET['volver'];?>&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>