      <!-- section_02_contacto_consulta -->
      <section class="section_02_contacto_consulta bg-info">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <div>
            <h1 class="secondary_font gs_reveal">
              Dejanos tu<br />
              consulta
            </h1>
          </div>
        </div>
      </section>
      <!-- article_03_contacto_consulta -->
      <article class="article_03_contacto_consulta pt-5 pb-5">
        <div class="container pt-5 pb-5 ps-3 pe-3">
          <div class="d-flex justify-content-center gs_reveal">
            <form action="./gracias/" method="post" id="article_03_contacto_consulta" class="custom_font_color_negro col-12 col-lg-6 col-xl-5">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control border border-dark rounded-0" id="nombre" placeholder="Ej: Tu nombre completo" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control border-dark rounded-0" id="email" placeholder="Ej: email@muecas.com.ar" required>
              </div>
              <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" name="telefono" class="form-control border border-dark rounded-0" id="telefono" placeholder="Ej: +54 11 68900900" required>
              </div>
              <div class="mb-3">
                <label for="provincia" class="form-label">Provincia</label>
                <select name="provincia" class="form-select border border-dark rounded-0 shadow-none" id="provincia" required>
                  <option value="">Seleccionar</option>
<?php
$consultaB = "SELECT * FROM provincias_reclamos";
$resultadoB = mysql_query($consultaB,$conexion);
while($rArrayB = mysql_fetch_array($resultadoB)) {
  echo '
                  <option>'.$rArrayB['provincia'].'</option>
  ';
}
?>
                </select>
              </div>
              <div class="mb-3">
                <label for="consulta" class="form-label">Tu Consulta</label>
                <textarea name="consulta" class="form-control border border-dark rounded-0" id="consulta" placeholder="¡Hola muecas! Quería consultarles..." rows="4" required></textarea>
              </div>
              <div class="d-flex justify-content-end align-items-center">
                <div>
                  <button type="submit" class="btn btn_custom_outline_dark_fill ps-3 pe-3">Enviar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </article>