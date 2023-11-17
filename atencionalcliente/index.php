<?php
include('base.php');
include("../inc/db.php");
include('../inc/log_accesos.php');
$seccion = $_GET['seccion'];
if($seccion==''){$seccion='home';}
?>
<!doctype html>
<html lang="es">
  <head>
<?php
echo '<base href="'.$base.'">';
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Muecas</title>
    <link rel="shortcut icon" href="img/favicon.png">
    
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    
    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Custom styles for this template -->
    <link href="css/loader.css" rel="stylesheet" />
    <link href="css/estilos.css" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  </head>
  <body>
    <div class="loader-container"><div><span class="loader"></span></div></div>
    <div class="col-lg-8 mx-auto p-3 py-md-5">
      <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
        <a href="../" class="d-flex align-items-center text-dark text-decoration-none">
          <img src="img/logo.svg" class="logo">
        </a>
      </header>
      <main>
<?php
include('secciones/'.$seccion.'.php');
?>
      </main>
    </div>
    <script>
      $('form').submit(function(e){
        $('.loader-container').show();
      });
    </script>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>