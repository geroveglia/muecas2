<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_set_cookie_params(0, '/');
session_name ("muecas-admin"); 
session_cache_limiter ("private");
session_start();

if($_SESSION["login"] != 'si'){
  if($_GET['seccion']!=''){
    $_SESSION["redir"] = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  }
  header ("location: ./login.php");
}

$rand = mt_rand();
include("../inc/db.php");
include('../inc/log_accesos.php');

if($_GET['nc']=='' && $_GET['seccion']==''){
  header ("location: ./?nc=".$rand);
}
$seccion = $_GET['seccion'];

if(!isset($seccion)) {
  if($_SESSION["tipo"]=='Administrador'){
    $seccion = 'dashboard';
  }
  elseif($_SESSION["tipo"]=='Visualizador'){
    $seccion = 'dashboard';
  }
  else{
    $seccion = 'reclamos';
  }
}

function number_of_working_days($from, $to) {
  $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
  $holidayDays = ['*-12-25', '*-12-31', '*-01-01', '*-05-01']; # variable and fixed holidays

  $from = new DateTime($from);
  $to = new DateTime($to);
  $to->modify('+1 day');
  $interval = new DateInterval('P1D');
  $periods = new DatePeriod($from, $interval, $to);

  $days = 0;
  foreach ($periods as $period) {
    if (!in_array($period->format('N'), $workingDays)) continue;
    if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
    if (in_array($period->format('*-m-d'), $holidayDays)) continue;
    $days++;
  }
  return $days-1;
}

$consulta = "SELECT * FROM reclamos_noconformidad";
$resultado = mysql_query($consulta,$conexion);
while($rArray = mysql_fetch_array($resultado)) {
  $colores[$rArray['noconformidad']] = $rArray['color'];
  $cortos[$rArray['noconformidad']] = $rArray['corto'];
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
    <link href="vendor/datatables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/static_custom.css?v=1.1">
    <link rel="stylesheet" href="styles/style.css?v=1.2">
    
    <script src="vendor/jquery/dist/jquery.min.js"></script>
    <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="vendor/datatables/datatables.min.js"></script>
    <script src="vendor/chartjs/Chart.min.js"></script>
    <script src="vendor/jquery-flot/jquery.flot.js"></script>
    <script src="vendor/jquery-flot/jquery.flot.resize.js"></script>
    <script src="vendor/jquery-flot/jquery.flot.pie.js"></script>
    <script src="vendor/flot.curvedlines/curvedLines.js"></script>
    <script src="vendor/jquery.flot.spline/index.js"></script>
    <script src="vendor/jquery-flot/jquery.flot.tooltip.min.js"></script>
    <script src="vendor/html2canvas/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
  </head>
  <body class="fixed-navbar fixed-sidebar">
    <!-- Simple splash screen-->
    <div class="splash">
      <div class="color-line"></div>
      <div class="splash-title">
        <h1>Muecas - Administrador</h1>
        <div class="spinner">
          <div class="rect1"></div>
          <div class="rect2"></div>
          <div class="rect3"></div>
          <div class="rect4"></div>
          <div class="rect5"></div>
        </div>
      </div>
    </div>
    <!-- Header -->
    <div id="header">
      <div class="color-line">
      </div>
      <div id="logo" class="light-version">
        <span>
          <?php echo $_SESSION["tipo"];?>
        </span>
      </div>
      <nav role="navigation">
        <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
        <div class="small-logo">
          <span class="text-primary">Muecas</span>
        </div>
        <div class="mobile-menu">
          <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
          <i class="fa fa-chevron-down"></i>
          </button>
            <div class="collapse mobile-navbar" id="mobile-collapse">
              <ul class="nav navbar-nav">
                <li>
                  <a class="" href="secciones/logout.php?nc=<?php echo $rand;?>">Salir</a>
                </li>
              </ul>
            </div>
        </div>
        <div class="navbar-right">
          <ul class="nav navbar-nav no-borders">
            <li class="dropdown">
              <a href="secciones/logout.php?nc=<?php echo $rand;?>">
              <i class="pe-7s-upload pe-rotate-90"></i>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <!-- Navigation -->
    <aside id="menu">
      <div id="navigation">
        <div class="profile-picture">
          <a href="./?nc=<?php echo $rand;?>">
          <img src="images/logo.svg" class="m-b" alt="logo">
          </a>
          </div>
        </div>
        <ul class="nav" id="side-menu">
          <?php if($_SESSION["tipo"]=='Administrador' || $_SESSION["tipo"]=='Visualizador'){;?>
          <li <?php if(strpos($seccion,'dashboard') !== false){echo 'class="active"';}?>>
            <a href="./?seccion=dashboard&nc=<?php echo $rand;?>"> <span class="nav-label">Dashboard</span></a>
          </li>
          <?php };?>
          <li <?php if(strpos($seccion,'reclamos') !== false && $seccion!='reclamos_textos'){echo 'class="active"';}?>>
            <a href="./?seccion=reclamos&nc=<?php echo $rand;?>"> <span class="nav-label">Reclamos</span></a>
          </li>
          <li>
            <a href="https://docs.google.com/spreadsheets/d/197_Ff3WbgcB1nniG9s_FEI0fXt5fL9v0/edit#gid=1491985659" target="_blank"> <span class="nav-label">CA: Envíos</span></a>
          </li>
          <?php if($_SESSION["tipo"]=='Administrador'){;?>
          <li <?php if(strpos($seccion,'noconformidad') !== false){echo 'class="active"';}?>>
            <a href="./?seccion=noconformidad&nc=<?php echo $rand;?>"> <span class="nav-label">Tipos de no conformidad</span></a>
          </li>
          <li <?php if(strpos($seccion,'reclamos_textos') !== false){echo 'class="active"';}?>>
            <a href="./?seccion=reclamos_textos&nc=<?php echo $rand;?>"> <span class="nav-label">Reclamos > Textos</span></a>
          </li>
          <li <?php if(strpos($seccion,'contacto') !== false && strpos($seccion,'distribuidor') === false){echo 'class="active"';}?>>
            <a href="./?seccion=contacto&nc=<?php echo $rand;?>"> <span class="nav-label">Contacto</span></a>
          </li>
          <li <?php if(strpos($seccion,'contacto-distribuidor') !== false){echo 'class="active"';}?>>
            <a href="./?seccion=contacto-distribuidor&nc=<?php echo $rand;?>"> <span class="nav-label">Contacto distribuidor</span></a>
          </li>
          <li <?php if(strpos($seccion,'categorias') !== false){echo 'class="active"';}?>>
            <a href="./?seccion=categorias&nc=<?php echo $rand;?>"> <span class="nav-label">Categorias</span></a>
          </li>
          <li <?php if(strpos($seccion,'productos') !== false){echo 'class="active"';}?>>
            <a href="./?seccion=productos&nc=<?php echo $rand;?>"> <span class="nav-label">Productos</span></a>
          </li>
          <li <?php if(strpos($seccion,'sellos') !== false){echo 'class="active"';}?>>
            <a href="./?seccion=sellos&nc=<?php echo $rand;?>"> <span class="nav-label">Sellos</span></a>
          </li>
          <li <?php if(strpos($seccion,'novedades') !== false){echo 'class="active"';}?>>
            <a href="./?seccion=novedades&nc=<?php echo $rand;?>"> <span class="nav-label">Novedades</span></a>
          </li>
          <li <?php if(strpos($seccion,'clientes') !== false){echo 'class="active"';}?>>
            <a href="#" aria-expanded="false"><span class="nav-label">Clientes</span><span class="fa arrow"></span> </a>
            <ul class="nav nav-second-level collapse" aria-expanded="false">
              <li <?php if(strpos($seccion,'clientes_minoristas') !== false){echo 'class="active"';}?>>
                <a href="./?seccion=clientes_minoristas&nc=<?php echo $rand;?>"> <span class="nav-label">Particulares</span></a>
              </li>
              <li <?php if(strpos($seccion,'clientes_comercios') !== false){echo 'class="active"';}?>>
                <a href="./?seccion=clientes_comercios&nc=<?php echo $rand;?>"> <span class="nav-label">Comercios</span></a>
              </li>
              <li <?php if(strpos($seccion,'clientes_distribuidores') !== false){echo 'class="active"';}?>>
                <a href="./?seccion=clientes_distribuidores&nc=<?php echo $rand;?>"> <span class="nav-label">Distribuidores</span></a>
              </li>
              <li <?php if(strpos($seccion,'clientes_fueracaba') !== false){echo 'class="active"';}?>>
                <a href="./?seccion=clientes_fueracaba&nc=<?php echo $rand;?>"> <span class="nav-label">Fuera de CABA</span></a>
              </li>
            </ul>
          </li>
          <li <?php if(strpos($seccion,'slider') !== false){echo 'class="active"';}?>>
            <a href="./?seccion=slider&nc=<?php echo $rand;?>"> <span class="nav-label">Slider home</span></a>
          </li>
          <li <?php if(strpos($seccion,'usuarios') !== false){echo 'class="active"';}?>>
            <a href="./?seccion=usuarios&nc=<?php echo $rand;?>"> <span class="nav-label">Usuarios</span></a>
          </li>
          <?php };?>
        </ul>
      </div>
    </aside>
<?php
include 'secciones/'.$seccion.'.php';
?>
      <!-- Footer-->
      <footer class="footer">
        <span class="pull-right">
        Powered by Lumba
        </span>
        Muecas
      </footer>
    </div>
    <!-- Vendor scripts -->
    <script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
    <script src="vendor/iCheck/icheck.min.js"></script>
    <script src="vendor/peity/jquery.peity.min.js"></script>
    <script src="vendor/sparkline/index.js"></script>
    <script src="vendor/matchheight/jquery.matchHeight.js" type="text/javascript"></script>
    <script>
      $('.matchHeight').matchHeight();
      $('.matchHeight2').matchHeight();
      $('.matchHeight3').matchHeight();
    </script>
    
    <!-- App scripts -->
    <script src="scripts/homer.js"></script>
    <script src="scripts/charts.js"></script>
    <script>
    $('textarea').keyup(function(){
      while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
          $(this).height($(this).height()+1);
      };
    });
    jQuery(document).ready(function($){
      $('textarea').each(function(){
        while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
            $(this).height($(this).height()+1);
        };
      });
    }); // ready
    </script>
  </body>
</html>