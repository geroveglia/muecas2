<?php
$http = "http";
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'){
  $http = "https";
}
$base = $http."://$_SERVER[HTTP_HOST]".dirname($_SERVER['PHP_SELF']);
$base = rtrim($base, '/');
$base = $base.'/';
?>