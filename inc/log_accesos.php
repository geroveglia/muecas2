<?php
if(strpos($_SERVER['HTTP_USER_AGENT'],'SemrushBot') !== false){
    exit();
}

$seccion = $_GET['seccion'];
if($seccion==''){$seccion='home';}

$ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$referer = $_SERVER['HTTP_REFERER'];
$idioma = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$sql = "INSERT INTO accesos (ip, user_agent, fecha, referer, idioma, url) VALUES ('$ip', '$user_agent', NOW(), '$referer', '$idioma', '$url')";
$rsql = mysql_query($sql, $conexion);
?>