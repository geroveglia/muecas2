      <!-- section_02_quiero_ser_distribuidor -->
      <section class="section_02_quiero_ser_distribuidor">
        <div class="d-flex flex-column justify-content-center">
          <div>
            <h1 class="text-center secondary_font gs_reveal">
              <span class="animated-text">Quiero ser <br />distribuidor</span>
            </h1>
          </div>
        </div>
      </section>
      <!-- article_03_quiero_ser_distribuidor -->
      <article class="article_03_quiero_ser_distribuidor pt-5 pb-5 gs_reveal">
        <div class="container pt-5 pb-5 ps-3 pe-3">
          <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="custom_font_color_negro col-12 col-lg-8 col-xxl-6">
              <h2 class="secondary_font custom_font_color_negro pb-3">Red de distribuidores</h2>
            </div>
            <div class="custom_font_color_negro col-12 col-lg-8 col-xxl-6 mb-2">
              <p>Te recordamos que la categoría DISTRIBUIDOR es aquella que compran cantidades mayoristas, para luego distribuir por los canales de benta que cada quien se genere.Actualmente contamos con cinco sabores de barras de cereal. por favor, indicanos en que zona distribuyen (si es que lo hacen) y qué cartera de cliente manejan apra poder ubicarnos. ¡Te invitamos a completar el formulario y dejarnos tu contacto!.</p>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <form action="./distribuidor-gracias/" class="custom_font_color_negro col-12 col-lg-8 col-xxl-6" method="post">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control border border-dark rounded-0" id="email" placeholder="Ej: email@muecas.com.ar" />
              </div>
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de contacto</label>
                <input type="text" name="nombre" class="form-control border border-dark rounded-0" id="nombre" placeholder="Ej: Tu nombre completo" />
              </div>
              <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" name="telefono" class="form-control border border-dark rounded-0" id="telefono" placeholder="Ej: +54 11 68900900" />
              </div>
              <div class="mb-3">
                <label for="distribuidora" class="form-label">Nombre de la distribuidora</label>
                <input type="text" name="distribuidora" class="form-control border border-dark rounded-0" id="distribuidora" placeholder="Ej: Nombre de la distribuidora" />
              </div>
              <div class="mb-4">
                <label for="provincia_id" class="form-label">Provincia donde está ubicada</label>
                <select name="provincia_id" class="form-select border border-dark rounded-0 shadow-none" id="provincia_id">
                  <option value="">Seleccionar</option>
<?php
$consultaB = "SELECT * FROM provincias_reclamos";
$resultadoB = mysql_query($consultaB,$conexion);
while($rArrayB = mysql_fetch_array($resultadoB)) {
  echo '
                  <option value="'.$rArrayB['Id'].'">'.$rArrayB['provincia'].'</option>
  ';
}
?>
                </select>
              </div>
              <div class="mb-4">
                <label for="localidad" class="form-label">Localidad donde distribuye</label>
                <select name="localidad" class="form-select border border-dark rounded-0 shadow-none" id="localidad">
                  <option value="">Seleccionar</option>
                </select>
              </div>
              <div>
                <p>¿A qué comercios distribuye actualmente?</p>
              </div>
              <div class="form-check mb-3">
                <input name="comercios[]" class="form-check-input" type="checkbox" id="comercios1" value="Dietéticas / Tiendas naturales">
                <label class="form-check-label" for="comercios1">Dietéticas / Tiendas naturales</label>
              </div>
              <div class="form-check mb-3">
                <input name="comercios[]" class="form-check-input" type="checkbox" id="comercios2" value="Almacenes">
                <label class="form-check-label" for="comercios2">Almacenes</label>
              </div>
              <div class="form-check mb-3">
                <input name="comercios[]" class="form-check-input" type="checkbox" id="comercios3" value="Kioscos">
                <label class="form-check-label" for="comercios3">Kioscos</label>
              </div>
              <div class="form-check mb-3">
                <input name="comercios[]" class="form-check-input" type="checkbox" id="comercios4" value="Autoservicios / Supermercados">
                <label class="form-check-label" for="comercios4">Autoservicios / Supermercados</label>
              </div>
              <div class="form-check mb-3 d-flex">
                <div class="d-flex align-items-center">
                  <div>
                    <input name="" class="form-check-input mb-1" type="checkbox" id="comercios5" onchange="toggleInputState1()">
                  </div>
                  <div class="me-3">
                    <label class="form-check-label" for="comercios5">Otros</label>
                  </div>
                </div>
                <input type="text" name="comercios[]" class="form-control border border-dark rounded-0" id="otros_input1" placeholder="Especificar otros" disabled value="">
              </div>
              <div>
                <p>¿De qué manera comercializan los productos?</p>
              </div>
              <div class="form-check mb-3">
                <input name="manera[]" class="form-check-input" type="checkbox" id="manera1" value="Venta directa a los comercios mediante equipo de vendedores">
                <label class="form-check-label" for="manera1">Venta directa a los comercios mediante equipo de vendedores</label>
              </div>
              <div class="form-check mb-3">
                <input name="manera[]" class="form-check-input" type="checkbox" id="manera2" value="Venta telefónica o por catálogo">
                <label class="form-check-label" for="manera2">Venta telefónica o por catálogo</label>
              </div>
              <div class="form-check mb-3">
                <input name="manera[]" class="form-check-input" type="checkbox" id="manera3" value="Comercio electrónico (venta a través de redes sociales o páginas web)">
                <label class="form-check-label" for="manera3">Comercio electrónico (venta a través de redes sociales o páginas web)</label>
              </div>
              <div class="form-check mb-3 d-flex">
                <div class="d-flex align-items-center">
                  <div>
                    <input name="" class="form-check-input mb-1" type="checkbox" id="manera4" onchange="toggleInputState2()" />
                  </div>
                  <div class="me-3">
                    <label class="form-check-label" for="manera4">Otros</label>
                  </div>
                </div>
                <input name="manera[]" type="text" class="form-control border border-dark rounded-0" id="otros_input2" placeholder="Especificar otros" disabled />
              </div>
              <!--///////////////////////////////////////// -->
              <div class="mb-3">
                <label for="web_redes_sociales" class="form-label">Web / redes sociales de la distribuidora</label>
                <input name="web" type="text" class="form-control border border-dark rounded-0" id="web_redes_sociales" placeholder="Tu respuesta" />
              </div>
              <div class="mb-3">
                <label for="vende_muecas" class="form-label">¿Actualmente vende Muecas?</label>
                <select name="actualmente" class="form-select border border-dark rounded-0 shadow-none" id="vende_muecas" required>
                  <option value="">Seleccionar</option>
                  <option>Sí</option>
                  <option>No</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="marcas" class="form-label">Marcas que más vende actualmente</label>
                <input name="marcas" type="text" class="form-control border border-dark rounded-0" id="marcas" placeholder="Marcas o productos" />
              </div>
              <div class="mb-3">
                <label for="como" class="form-label">¿Cómo llegaste al formulario?</label>
                <textarea name="como" class="form-control border border-dark rounded-0" id="como" rows="4"></textarea>
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

<script>
$('#provincia_id').on('change', function(){
  provincia_id = this.value;
  
  if(provincia_id!=''){
    if (window.XMLHttpRequest){
      xmlhttp=new XMLHttpRequest();
    }
    else{
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
        $("#localidad").html(xmlhttp.responseText);
      }
    }
    xmlhttp.open("POST","secciones/ajax_localidades.php?provincia_id="+provincia_id,true);
    xmlhttp.send();
  }
  else{
    
  }
});
</script>