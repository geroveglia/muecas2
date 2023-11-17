<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 3600)); 
header('Clear-Site-Data: "cache"');
date_default_timezone_set('America/Argentina/Buenos_Aires');

include('inc/base.php');
$rand = mt_rand();

session_set_cookie_params(0, '/');
session_name ("muecas"); 
session_cache_limiter ("private");
session_start();
//session_destroy();

$seccion = $_GET['seccion'];
if($seccion==''){$seccion='home';}

include("inc/db.php");
$titulos = array(
'home' => 'Real y simple',
'conocenos' => 'Nuestra historia',
'contactanos' => 'Contacto',
'contacto' => 'Contacto',
'distribuidor-gracias' => 'Quiero distribuir',
'gracias' => 'Contacto',
'newsletter' => 'Newsletter',
'productos' => 'Productos',
'quiero-ser-distribuidor' => 'Quiero distribuir',
'producto-alfajor' => 'Ingredientes naturales, sin vueltas, con nada más que lo que te hace bien.',
'producto-barrita-amarilla' => 'Ingredientes naturales, sin vueltas, con nada más que lo que te hace bien.',
'producto-barrita-negra' => 'Ingredientes naturales, sin vueltas, con nada más que lo que te hace bien.',
'producto-barrita-roja' => 'Ingredientes naturales, sin vueltas, con nada más que lo que te hace bien.',
'producto-barrita-rosa' => 'Ingredientes naturales, sin vueltas, con nada más que lo que te hace bien.',
'producto-barrita-violeta' => 'Ingredientes naturales, sin vueltas, con nada más que lo que te hace bien.',
'producto-chocolate' => 'Ingredientes naturales, sin vueltas, con nada más que lo que te hace bien.'
);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
<?php
echo '<base href="'.$base.'">';
?>
    <!-- Title -->
    <title>Müecas | <?php echo $titulos[$seccion];?></title>

    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Ingredientes naturales, sin vueltas, con nada más que lo que te hace bien." />
    <meta name="author" content="somoslumba.com" />

    <!-- Favicons -->
    <link rel="shortcut icon" href="./assets/favicons/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="57x57" href="./assets/favicons/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="./assets/favicons/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="./assets/favicons/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/favicons/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="./assets/favicons/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="./assets/favicons/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="./assets/favicons/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="./assets/favicons/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicons/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="./assets/favicons/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="./assets/favicons/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicons/favicon-16x16.png" />
    <link rel="manifest" href="./assets/favicons/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="./assets/favicons/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />

    <!-- Google Analytics -->

    <!-- Google fonts (https://www.google.com/fonts) - Work Sans / Lexend / Caprasimo -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Caprasimo&family=Crimson+Text:wght@700&family=Lexend:wght@100;200;300;400;500;600;700;800;900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />

    <!-- // Libs and Plugins CSS // -->

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

    <!-- Master CSS-->
    <link rel="stylesheet" href="./css/style.css" />

    <!-- Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- Gsap CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.css" />

    <!-- Owl Carousel -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet" />

    <!-- // Libs and Plugins JS // -->

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Meta Pixel Code Start -->
    <script>
      !(function (f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function () {
          n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments);
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s);
      })(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '1283568865850968');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display: none" src="https://www.facebook.com/tr?id=1283568865850968&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->

    <!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=G-9P7Y9NHB9N"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-9P7Y9NHB9N'); </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TTR356RL');</script>
    <!-- End Google Tag Manager -->
  </head>

  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TTR356RL"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- header -->
    <header id="site-header">
      <div class="container">
        <!--  header_navbar -->
        <nav class="navbar navbar-expand-lg pt-4 pb-4 pt-lg-4 d-flex">
          <div class="col-auto">
            <button id="navbar-toggler" class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="toggler-icon top-bar"></span>
              <span class="toggler-icon middle-bar"></span>
              <span class="toggler-icon bottom-bar"></span>
            </button>
          </div>
          <div class="header-logo d-flex justify-content-center align-items-center pt-1">
            <div class="header-logo-hover">
              <a href="./">
                <img class="navbar-brand img-fluid m-0" src="./assets/images/index_header_logo.svg" alt="logo navbar desk" />
              </a>
            </div>
          </div>
          <div class="collapse navbar-collapse ps-md-0" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
              <div class="d-flex flex-column flex-lg-row text-center mb-5 mb-lg-5 align-items-center justify-content-center">
                <div class="d-lg-none mb-5 nav_logo">
                  <a href="./">
                    <img src="./assets/images/index_header_nav_logo.svg" alt="logo navbar mobile" />
                  </a>
                </div>
                <div class="d-flex flex-column flex-lg-row header-logo-centrado-izq">
                  <li class="nav-item">
                    <a class="nav-link header-nav-link ps-lg-4 pe-lg-4 pt-2 pt-lg-0" href="./conocenos/">Conocenos!</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link header-nav-link ps-lg-4 pe-lg-4 pt-2 pt-lg-0" href="./productos/">Productos</a>
                  </li>
                </div>
                <div class="d-flex flex-column flex-lg-row header-logo-centrado-der">
                  <li class="nav-item d-lg-none">
                    <a class="nav-link header-nav-link ps-lg-4 pe-lg-4 pt-2 pt-lg-0 text-nowrap" href="https://muecascaba.com.ar/" target="_blank">Tienda Online</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link header-nav-link ps-lg-4 pe-lg-4 pt-2 pt-lg-0" href="./contactanos/">Contacto</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link header-nav-link ps-lg-4 pe-lg-4 pt-2 pt-lg-0 text-nowrap" href="./quiero-ser-distribuidor/">Quiero distribuir!</a>
                  </li>
                  <!--
                  <li class="nav-item d-lg-none">
                    <a class="nav-link header-nav-link ps-lg-4 pe-lg-4 pt-2 pt-lg-0 text-nowrap" href="#">Atención al cliente</a>
                  </li>
                  -->
                  <div class="d-flex align-items-center justify-content-center">
                    <li class="nav-item">
                      <a class="nav-link pt-1 pt-lg-0 ms-1 m-lg-0 d-none d-lg-block" href="https://muecascaba.com.ar/" target="_blank">
                        <img src="./assets/images/index_header_nav_tienda.svg" alt="tienda" />
                      </a>
                    </li>
                  </div>
                </div>
              </div>
              <div class="d-flex mx-auto mt-lg-0 ms-lg-4 d-lg-none">
                <li class="nav-item">
                  <a class="nav-link pt-1 pt-lg-0 me-1 m-lg-0" href="https://www.instagram.com/muecas.ok/" target="_blank">Instagram</a>
                </li>
                <span><img class="header-span pb-lg-1 ps-2 pe-2 ps-lg-0 pe-lg-0 mt-1 mt-lg-0" src="./assets/images/index_header_nav_separador1-social.svg" alt="separador red social 1" /></span>
                <li class="nav-item">
                  <a class="nav-link pt-1 pt-lg-0 ms-1 me-1 m-lg-0" href="https://www.facebook.com/muecas.ok/ " target="_blank">Facebook</a>
                </li>
                <span><img class="header-span pb-lg-1 ps-2 pe-2 ps-lg-0 pe-lg-0 mt-1 mt-lg-0" src="./assets/images/index_header_nav_separador2-social.svg" alt="separador red social 2" /></span>
                <li class="nav-item">
                  <a class="nav-link pt-1 pt-lg-0 ms-1 m-lg-0" href="https://www.linkedin.com/company/muecas/" target="_blank">Linkedin</a>
                </li>
              </div>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <main>
<?php
include('secciones/'.$seccion.'.php');
?>
      <!-- Módulo seguinos en @muecas.ok -->
      <section id="scroll-container_seguinos">
        <div id="content-wrap">
          <div class="tt-section_seguinos">
            <div class="tt-section-inner_seguinos">
              <div class="tt-scrolling-text_seguinos" data-scroll-speed="50">
                <div class="tt-scrolling-text-inner_seguinos custom_font_color_negro pb-2" data-text=" Seguinos en @muecas.ok | Seguinos en @muecas.ok | Seguinos en @muecas.ok |">Seguinos en @muecas.ok | Seguinos en @muecas.ok | Seguinos en @muecas.ok |</div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- footer -->
    <footer class="footer pt-5 cInnerContent">
      <div class="container footer_container ps-3 pe-3 ps-0 pe-0">
        <div class="d-flex flex-column flex-xl-row align-items-md-start justify-content-md-between">
          <div class="d-flex flex-md-column justify-content-center align-items-center justify-content-md-start align-items-md-start featured-image-container ipsGrid_span5 gs_reveal gs_reveal_fromLeft">
            <div class="mb-md-3">
              <img class="img-fluid" src="./assets/images/index_footer_09_logo.svg" alt="logo" />
            </div>
            <div class="ms-5 ms-md-0 col-5 col-md-auto mb-md-4">
              <img class="img-fluid" src="./assets/images/index_footer_09_real+simple.svg" alt="texto real+simple" />
            </div>
          </div>
          <div class="d-flex col-12 col-xl-6 justify-content-between justify-content-md-around">
            <div class="mt-4 mt-md-0 featured-image-container ipsGrid_span5 gs_reveal gs_reveal_fromBottom1">
              <ul class="ps-0 ms-0">
                <li>
                  <b>Mapa de sitio</b>
                  <ul class="ps-0 ms-0 mt-2">
                    <li><a href="./conocenos/">Nuestra historia</a></li>
                    <li><a href="./productos/">Productos</a></li>
                    <li><a href="https://muecascaba.com.ar/" target="_blank">Tienda Online</a></li>
                    <li><a href="./contactanos/">Contacto</a></li>
                    <li><a href="./quiero-ser-distribuidor/">Quiero distribuir!</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="d-flex flex-md-fill flex-column flex-md-row justify-content-md-evenly">
              <div class="mt-4 mt-md-0 ipsGrid_span5 gs_reveal gs_reveal_fromBottom2">
                <ul class="ps-0 ms-0 mb-0">
                  <li>
                    <b>Info de contacto</b>
                    <ul class="ps-0 ms-0 mt-2">
                      <li><a href="mailto:contacto@muecas.com.ar">contacto@muecas.com.ar</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="mt-4 mt-md-0 ipsGrid_span5 gs_reveal gs_reveal_fromBottom3">
                <ul class="ps-0 ms-0">
                  <li>
                    <b>Nuestras redes</b>
                    <ul class="ps-0 ms-0 mt-2">
                      <li><a href="https://www.instagram.com/muecas.ok/" target="_blank">Instagram</a></li>
                      <li><a href="https://www.facebook.com/muecas.ok/" target="_blank">Facebook</a></li>
                      <li><a href="https://www.linkedin.com/company/muecas/" target="_blank">Linkedin</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="mt-5 mt-md-0 d-none d-xl-block featured-image-container ipsGrid_span5 gs_reveal gs_reveal_fromRight">
            <div>
              <p>¿Querés saber las novedades de Müecas?</p>
            </div>
            <form action="./newsletter/" class="newsletter form-horizontal" method="post">
              <div class="input-group mb-3">
                <input id="footer_form" type="email" class="form-control rounded-0" name="email" placeholder="Ingresá tu E-mail" aria-label="Recipient's username" aria-describedby="button-addon2" required>
                <button type="submit" class="btn btn_custom_outline_dark_fill ps-3 pe-3">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- footer desk -->
      <div class="gs_reveal gs_reveal_fromRightFooter d-md-none">
        <img class="img-fluid w-100" src="assets/images/index_footer_09_bg-gsap.svg" alt="rectangulos colores" />
      </div>
      <!-- footer mobile -->
      <div class="gs_reveal gs_reveal_fromRightFooter d-none d-md-block">
        <img class="img-fluid w-100" src="assets/images/index_footer_09_bg-gsap.svg" alt="rectangulos colores" />
      </div>
      <div class="footer_bottom pt-2 pb-2">
        <div class="container featured-image-container ipsGrid_span5 gs_reveal gs_reveal_fromLeft">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <p class="m-0 p-0">
                Copyright Müecas - 2023.<br class="d-xl-none" />
                Todos los derechos reservados. Defensa de consumidores. Para reclamos ingrese
                <a class="footer_bottom_aqui" href="https://autogestion.produccion.gob.ar/consumidores" target="_blank">aqui</a>
              </p>
            </div>
            <div class="d-flex align-items-center d-none d-xl-block">
              <p class="m-0 p-0">
                <a href="#"> Somos Lumba </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- // Scripts // Libs and Plugins // -->

    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

    <!-- Gsap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>
    <script src="js/gsap_main.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
  </body>
</html>