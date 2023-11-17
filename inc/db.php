<?php
$dbhost="localhost";
$dbusuario="root";
$dbpassword="";
$db="muecas";

$conexion = mysql_connect($dbhost, $dbusuario, $dbpassword);
mysql_select_db($db, $conexion);
//Normalizo BD para Caracteres UTF8
mysql_query("SET NAMES 'utf8'");
?>