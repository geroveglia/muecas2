<?php
$email = $_POST['email'];
$consulta = "SELECT * FROM newsletter WHERE email='$email'";
$resultado = mysql_query($consulta,$conexion);
$cant = mysql_num_rows($resultado);
if($cant==0 && $_POST['email']!=''){
  $sql = "INSERT INTO newsletter (email) VALUES ('$email')";
  $rsql = mysql_query($sql,$conexion);
}
?>
      <section class="section_02_contacto_gracias">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <div>
            <div class="mb-4">
              <h1 class="secondary_font gs_reveal">
                ¡Muchas<br />
                gracias por<br />
                suscribirte!
              </h1>
            </div>
            <div class="section_02_contacto_gracias_analizaremos p-2 ps-4 pe-4 gs_reveal gs_reveal_fromBottom3">
              <p class="custom_font_color_negro p-0 m-0 text-center">
                En breve te estaremos <br />
                enviando novedades.
              </p>
            </div>
          </div>
        </div>
      </section>
      <!-- Scrolling text -->
      <!-- Módulo real + simple -->
      <section id="scroll-container">
        <div id="content-wrap">
          <div class="tt-section">
            <div class="tt-section-inner">
              <div class="tt-scrolling-text" data-scroll-speed="40">
                <div class="tt-scrolling-text-inner custom_font_color_negro pb-2" data-text=" real + simple | real + simple | real + simple | real + simple | ">real + simple | real + simple | real + simple | real + simple |</div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Módulo Nuestros Productos -->
      <section class="modulo_nuestros_productos pt-5 pb-5 features">
        <div class="container ps-md-0 pe-md-0">
          <div class="d-flex flex-column">
            <div class="mt-5 mb-3 mb-md-3 featured-image-container ipsGrid_span5 gs_reveal gs_reveal_fromLeft">
              <h2 class="secondary_font">Nuestros <br />Productos</h2>
            </div>
            <div class="owl-carousel owl-theme owl-productos align-items-center gs_reveal">
              <div class="owl-item-productos">
                <div class="mb-1 col-6">
                  <div class="section_04-image-container d-none d-lg-block">
                    <a href="./producto/barrita-roja/">
                      <img class="img-fluid section_04-img" src="./assets/images/index_section_05_color-rojo.svg" alt="rectangulo rojo" />
                      <img class="img-fluid section_04-hover-img" src="./assets/images/index_section_05_color-rojo-hover.webp" alt="barrita roja" />
                    </a>
                  </div>
                  <div class="d-lg-none">
                    <a href="./producto/barrita-roja/">
                      <img src="./assets/images/index_section_05_color-rojo-hover.webp" alt="barrita roja" />
                    </a>
                  </div>
                </div>
              </div>
              <div class="owl-item-productos">
                <div class="mb-1 col-6">
                  <div class="section_04-image-container d-none d-lg-block">
                    <a href="./producto/barrita-violeta/">
                      <img class="img-fluid section_04-img" src="./assets/images/index_section_05_color-violeta.svg" alt="rectangulo violeta" />
                      <img class="img-fluid section_04-hover-img" src="./assets/images/index_section_05_color-violeta-hover.webp" alt="barrita violeta" />
                    </a>
                  </div>
                  <div class="d-lg-none">
                    <a href="./producto/barrita-violeta/">
                      <img src="./assets/images/index_section_05_color-violeta-hover.webp" alt="barrita violeta" />
                    </a>
                  </div>
                </div>
              </div>
              <div class="owl-item-productos">
                <div class="mb-1 col-6">
                  <div class="section_04-image-container d-none d-lg-block">
                    <a href="./producto/barrita-rosa/">
                      <img class="img-fluid section_04-img" src="./assets/images/index_section_05_color-rosa.svg" alt="rectangulo rosa" />
                      <img class="img-fluid section_04-hover-img" src="./assets/images/index_section_05_color-rosa-hover.webp" alt="barrita rosa" />
                    </a>
                  </div>
                  <div class="d-lg-none">
                    <a href="./producto/barrita-rosa/">
                      <img src="./assets/images/index_section_05_color-rosa-hover.webp" alt="barrita rosa" />
                    </a>
                  </div>
                </div>
              </div>
              <div class="owl-item-productos">
                <div class="mb-1 col-6">
                  <div class="section_04-image-container d-none d-lg-block">
                    <a href="./producto/barrita-amarilla/">
                      <img class="img-fluid section_04-img" src="./assets/images/index_section_05_color-amarillo.svg" alt="rectangulo amarillo" />
                      <img class="img-fluid section_04-hover-img" src="./assets/images/index_section_05_color-amarillo-hover.webp" alt="barrita amarilla" />
                    </a>
                  </div>
                  <div class="d-lg-none">
                    <a href="./producto/barrita-amarilla/">
                      <img src="./assets/images/index_section_05_color-amarillo-hover.webp" alt="barrita amarilla" />
                    </a>
                  </div>
                </div>
              </div>
              <div class="owl-item-productos">
                <div class="mb-1 col-6">
                  <div class="section_04-image-container d-none d-lg-block">
                    <a href="./producto/barrita-negra/">
                      <img class="img-fluid section_04-img" src="./assets/images/index_section_05_color-negro.svg" alt="rectangulo negro" />
                      <img class="img-fluid section_04-hover-img" src="./assets/images/index_section_05_color-negro-hover.webp" alt="barrita negra" />
                    </a>
                  </div>
                  <div class="d-lg-none">
                    <a href="./producto/barrita-negra/">
                      <img src="./assets/images/index_section_05_color-negro-hover.webp" alt="barrita negra" />
                    </a>
                  </div>
                </div>
              </div>
              <div class="owl-item-productos">
                <div class="mb-1 col-12">
                  <div class="section_04-image-container d-none d-lg-block">
                    <a href="./producto/alfajor/">
                      <img class="img-fluid section_04-img" src="./assets/images/index_section_05_color-alfajor.svg" alt="circulo verde" />
                      <img class="img-fluid section_04-hover-img" src="./assets/images/index_section_05_color-alfajor-hover.webp" alt="alfajor" />
                    </a>
                  </div>
                  <div class="d-lg-none">
                    <a href="./producto/alfajor/">
                      <img src="./assets/images/index_section_05_color-alfajor-hover.webp" alt="alfajor" />
                    </a>
                  </div>
                </div>
              </div>
              <div class="owl-item-productos">
                <div class="mb-1 col-10">
                  <div class="section_04-image-container d-none d-lg-block">
                    <a href="./producto/chocolate/">
                      <img class="img-fluid section_04-img" src="./assets/images/index_section_05_color-chocolate.svg" alt="rectangulo verde grande" />
                      <img class="img-fluid section_04-hover-img" src="./assets/images/index_section_05_color-chocolate-hover.webp" alt="chocolate" />
                    </a>
                  </div>
                  <div class="d-lg-none">
                    <a href="./producto/chocolate/">
                      <img src="./assets/images/index_section_05_color-chocolate-hover.webp" alt="chocolate" />
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-center mt-4 pb-5">
              <div class="gs_reveal">
                <a href="./productos/" class="btn btn_custom_outline_dark ps-3 pe-3 fw-bold">Ver productos</a>
              </div>
            </div>
          </div>
        </div>
      </section>