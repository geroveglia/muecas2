<?php
$confirmar = $_GET['confirmar'];
$id = $_GET['id'];
$consulta = "SELECT * FROM reclamos WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
if($confirmar == 'si'){
  $texto_informe = $_POST['texto_informe'];
  $sql = "UPDATE reclamos SET texto_informe='$texto_informe' WHERE Id='$id'";
  $rsql = mysql_query($sql,$conexion);
}
?>
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Reclamos > enviar informe
      </h2>
    </div>
  </div>
</div>
<div class="content animate-panel">
  <div class="row">
    <div class="col-lg-8">
      <div class="hpanel">
        <div class="panel-body">
        <?php
          
          if($confirmar == 'si'){
            $consulta = "SELECT * FROM reclamos WHERE Id='$id'";
            $resultado = mysql_query($consulta,$conexion);
            $rArray = mysql_fetch_array($resultado);
            $nombre = $rArray['nombre'];
            $email = $rArray['email'];
            $codigo = $rArray['codigo'];
            $ext = $rArray['informe_calidad'];

            $sql = "UPDATE reclamos SET informe_enviado='1', estatus='Cerrado', fecha_cierre=NOW() WHERE Id='$id'";
            $rsql = mysql_query($sql,$conexion);
            
            $CuerpoEmail = '
            <div style="background: #FFF; text-align: center; padding: 20px; width: 90%; border: solid 3px #0C0C0C">
            <h2 style="color: #0C0C0C;">Código de seguimiento "'.$codigo.'"</h2><br>
            <h4>Hola '.$nombre.'.</h4>
            Te enviamos el informe sobre tu caso:<br><br>
            <div style="margin-bottom: 20px;"><i>'.nl2br($rArray['texto_informe']).'</i></div>
            
            <a href="https://www.muecas.com.ar/atencionalcliente/informe_calidad/'.$id.'.'.$ext.'" style="color: #FFF; background-color: #0C0C0C; border-color: #0C0C0C; border-radius: 3px; line-height: 22px; display: inline-block; font-weight: normal; text-align: center; vertical-align: middle; font-size: 14px; font-family: sans-serif; padding: 8px 19px; text-decoration:none">Descargar informe</a><br><br><br>
            
            <img src="https://www.muecas.com.ar/atencionalcliente/img/logo.png" style="max-width: 250px;">
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
            $mail->Send();

            echo '
            <div class="alert alert-info">Se envió el informe.</div>
            <div class="pull-right m-t">
              <a href="?seccion=reclamos&nc='.$rand.'" class="btn btn-info">Aceptar</a>
            </div>
            ';
          }
          else{
            echo '
            <div class="alert alert-warning">
              &iquest;Confirma enviar el informe por mail?.
            </div>
            <form class="form-horizontal m-t" action="./?seccion='.$seccion.'&id='.$id.'&confirmar=si&nc='.$rand.'" method="POST" enctype="multipart/form-data" id="formulario">
              <div class="form-group">
                <label class="col-sm-2 control-label">Texto aclarativo</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="texto_informe">'.$rArray['texto_informe'].'</textarea>
                </div>
              </div>
            </form>
            <div class="pull-right m-t">
              <button type="submit" class="btn btn-info" form="formulario">Enviar</button>
              <a href="?seccion=reclamos&nc='.$rand.'" class="btn btn-danger">Cancelar</a>
            </div>';
          }
        ?>
        </div>
      </div>
    </div>
  </div>
</div>