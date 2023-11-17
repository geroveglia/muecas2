<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_set_cookie_params(0, '/');
session_name ("muecas-admin"); 
session_cache_limiter ("private");
session_start();
include("../inc/db.php");
include('../inc/log_accesos.php');
$rand = mt_rand();

if($_POST['usuario']!='' && $_POST['contrasenia']!=''){
  $usuario = $_POST['usuario'];
  $contrasenia = $_POST['contrasenia'];
  $consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasenia='$contrasenia' AND activo='1'";
  $resultado = mysql_query($consulta,$conexion);
  $cant = mysql_num_rows($resultado);
  $rArray = mysql_fetch_array($resultado);
  if($cant>0){
    $_SESSION["login"] = 'si';
    $_SESSION["tipo"] = $rArray['tipo'];
    $_SESSION["user_id"] = $rArray['Id'];
    $_SESSION["usuario"] = $rArray['usuario'];
    $_SESSION["contrasenia"] = $rArray['contrasenia'];
  }
  else{
    $mensaje = '<div class="alert alert-danger">Usuario o contrase&ntilde;a incorrectos</div>';
  }
}
if($_SESSION["login"] == 'si'){
  if($_SESSION["redir"]!=''){
    $redir = $_SESSION["redir"];
    $_SESSION["redir"] = '';
    header ("location: ".$redir.'&nc='.$rand);
  }
  else{
    header ("location: ./?nc=".$rand);
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Page title -->
    <title>Muecas - Admin</title>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->
    <link rel="shortcut icon" href="images/favicon.png">
    <!-- Vendor styles -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
    <!-- App styles -->
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="styles/style.css">
  </head>
  <body class="blank">
    <!-- Simple splash screen-->
    <div class="splash">
      <div class="color-line"></div>
      <div class="splash-title">
        <h1>Muecas - Administrador</h1>
        <p>Special Admin Theme for small and medium webapp with very clean and aesthetic style and feel. </p>
        <div class="spinner">
          <div class="rect1"></div>
          <div class="rect2"></div>
          <div class="rect3"></div>
          <div class="rect4"></div>
          <div class="rect5"></div>
        </div>
      </div>
    </div>
    <!--[if lt IE 7]>
    <p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div class="color-line"></div>
    <div class="login-container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-center m-b-md">
            <img src="../atencionalcliente/img/logo.png" alt="Logo" width="100">
          </div>
          <div class="hpanel">
            <div class="panel-body">
              <?php echo $mensaje; ?>
              <form action="" method="post" id="loginForm">
                <div class="form-group">
                  <h5><span>Usuario </span></h5>
                  <input type="text" name="usuario" class="form-control" required>
                </div>
                <div class="form-group">
                  <h5 ><span>Password </span></h5>
                  <input type="password" name="contrasenia" class="form-control" required>
                </div>
                <button class="btn btn-success btn-block">Ingresar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          Desarrollado por <strong>Lumba</strong>
        </div>
      </div>
    </div>
    <!-- Vendor scripts -->
    <script src="vendor/jquery/dist/jquery.min.js"></script>
    <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
    <script src="vendor/iCheck/icheck.min.js"></script>
    <script src="vendor/sparkline/index.js"></script>
    <!-- App scripts -->
    <script src="scripts/homer.js"></script>
  </body>
</html>