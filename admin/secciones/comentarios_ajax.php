<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_set_cookie_params(0, '/');
session_name ("muecas"); 
session_cache_limiter ("private");
session_start();

$rand = mt_rand();

include("../../inc/db.php");

$comentario = $_GET['comentario'];
$pedidoid = $_GET['pedidoid'];
$clienteid = $_GET['clienteid'];

$sql = "INSERT INTO pedidos_mensajes (mensaje, pedido_id, del_cliente, fecha) VALUES ('$comentario', '$pedidoid', '0', NOW())";
$rsql = mysql_query($sql,$conexion);
$comentario_id = mysql_insert_id();

$consultaChat = "SELECT * FROM pedidos_mensajes WHERE pedido_id='$pedidoid' ORDER BY Id DESC";

$resultadoChat = mysql_query($consultaChat,$conexion);
$rArrayChat = mysql_fetch_array($resultadoChat);

echo '
                <div class="chat-message '.(($rArrayChat['del_cliente']=='1')?'right':'left').'">
                  <img class="message-avatar" src="images/'.(($rArrayChat['del_cliente']=='1')?'avatar':'logo').'.svg" alt="">
                  <div class="message">
                    <a class="message-author" href="#"> '.(($rArrayChat['del_cliente']=='1')?'Cliente':'Muecas').' </a>
                    <span class="message-date"> '.strftime('%H-%M', strtotime($rArrayChat['fecha'])).' hs - '.strftime('%d-%m-%Y', strtotime($rArrayChat['fecha'])).' </span>
                    <span class="message-content">
                      '.$rArrayChat['mensaje'].'
                    </span>
                  </div>
                </div>
';

$consulta = "SELECT * FROM clientes WHERE Id='$clienteid'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$nombre = $rArray['nombre'];
$email = $rArray['email'];

$CuerpoEmail = '
<html>
  <head>
    <style>
      .tabla{
        width: 100%;
        background: #FFF;
      }
      .tabla tr td{
        padding: 10px;
        background: #FFF;
      }
      .tabla tr th{
        padding: 10px;
        background: #efaa42;
        color: #FFF;
      }
      .tabla tr th.nopadding{
        padding: 0;
      }
      .tabla tr th.nopadding{
        padding: 0;
      }
      .tabla tr th.nopadding{
        padding: 0;
      }
    </style>
  </head>
</html>
<div style="background: #FFF; text-align: center; padding: 20px; width: 90%; border: solid 3px #efab41; border-radius: 2px;">
<img src="https://www.muecas.com.ar/images/logo_naranja.png" style="max-width: 250px;"><br><br>
<h2 style="color: #efab41;">Muecas Barritas</h2><br>
<h4>Hola '.$nombre.'.</h4>
Ten&eacute;s un nuevo mensaje en tu pedido (Nº '.$pedidoid.') <br><br>
Para leer el mesaje ingresa en nuestra web con tu email y contrase&ntilde;a:<br><br>
<a href="https://www.muecas.com.ar/mi-cuenta/mis-pedidos/'.$pedidoid.'/" style="color: #FFF; background-color: #efab41; border-color: #efab41; border-radius: 3px; line-height: 22px; display: inline-block; font-weight: normal; text-align: center; vertical-align: middle; font-size: 14px; font-family: sans-serif; padding: 8px 19px; text-decoration:none">INGRESAR</a><br><br>
'.$tabla.'<br>
</div>
';

$ruta='../../PHPMailer/class.phpmailer.php'; 
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
$mail->Subject = 'Nuevo mensaje en Pedido Muecas Nº '.$pedidoid;
$mail->Body = $CuerpoEmail;
$mail->Send();
?>