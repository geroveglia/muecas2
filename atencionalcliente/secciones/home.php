<h2 class="mb-2">Formulario de atención al cliente.</h2>
<h5 class="mb-4">Completá el siguiente formulario y te responderemos a la brevedad.</h5>
<form action="./gracias/" method="post" enctype="multipart/form-data">
  <div>
    <h4 class="texto-amarillo"><span class="texto-negro">PASO 1 | </span>Datos personales</h4>
    <div class="mb-2">
      <select class="form-select" name="tipo_cliente" required>
        <option value="">Tipo de cliente</option>
        <?php
        $tipo_cliente = array('Consumidor Final', 'Distribuidora' ,'Punto de Venta');
        foreach($tipo_cliente as $value){
          echo '
          <option value="'.$value.'">'.$value.'</option>
          ';
        }
        ?>
      </select>
    </div>


   <script>
document.addEventListener("DOMContentLoaded", function() {
  var selectTipoCliente = document.querySelector("[name='tipo_cliente']");
  
  selectTipoCliente.addEventListener("change", function() {
    var selectedOption = this.value;
    
    if (selectedOption === "Distribuidora") {
      // Redirigir a login.php si se selecciona "Distribuidora"
      window.location.href = "./distribuidora/"; // Cambia la ruta según tu estructura de archivos
    }
  });
});
</script>


    <div class="form-floating mb-2">
      <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Tu nombre" required>
      <label for="nombre">Tu nombre</label>
    </div>
    <div class="form-floating mb-2">
      <input type="email" class="form-control" name="email" id="email" placeholder="Tu Email" required>
      <label for="email">Tu Email</label>
    </div>
    <div class="form-floating mb-5">
      <input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Teléfono (cód de área) + (número de WA)" required>
      <label for="telefono">Teléfono (cód de área) + (número de WA)</label>
    </div>
    <h4 class="texto-amarillo"><span class="texto-negro">PASO 2 | </span>Datos del Lugar donde fue realizada la compra</h4>
    <div class="form-floating mb-2">
      <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" required>
      <label for="direccion">Dirección</label>
    </div>
    <div class="mb-2">
      <select class="form-select select2" id="provincia_id" name="provincia_id" required>
        <option value="">Provincia</option>
        <?php
        $consulta = "SELECT * FROM provincias_reclamos";
        $resultado = mysql_query($consulta,$conexion);
        while($rArray = mysql_fetch_array($resultado)){
          echo '
          <option value="'.$rArray['Id'].'">'.$rArray['provincia'].'</option>
          ';
        }
        ?>
      </select>
    </div>
    <div class="mb-5">
      <select class="form-select select2" id="localidad_id" name="localidad_id" required>
        <option value="">Localidad</option>
      </select>
    </div>
    <h4 class="texto-amarillo"><span class="texto-negro">PASO 3 | </span>Datos del producto</h4>
    <div class="mb-2">
      <select class="form-select" name="barrita" id="producto_id" required>
        <option value="">Seleccioná el producto por el que estás reclamando</option>
        <?php
        $consulta = "SELECT *, productos.Id AS Id FROM productos LEFT JOIN reclamos_lotes ON reclamos_lotes.Id=productos.lote_id ORDER BY orden";
        $resultado = mysql_query($consulta,$conexion);
        while($rArray = mysql_fetch_array($resultado)){
          echo '
          <option value="'.$rArray['Id'].'" data-loteid="'.$rArray['lote_id'].'">'.$rArray['nombre'].'</option>
          ';
        }
        ?>
      </select>
    </div>
    <div class="form-floating mb-2">
      <input type="number" min="1" class="form-control" name="cantidad_barritas" id="cantidad_barritas" placeholder="Cantidad de unidades afectadas" required>
      <label for="cantidad_barritas">Cantidad de unidades afectadas</label>
    </div>
    <div class="mb-1"><i>Agrega toda la información relevante para que podamos asesorarte y llevar adelante el análisis de la manera más eficiente</i></div>
    <div class="form-floating mb-2">
      <textarea class="form-control" name="informacion_relevante" id="informacion_relevante" placeholder="Información relevante" required></textarea>
      <label for="informacion_relevante">Información relevante</label>
    </div>
    <div id="contenedor-lote-1"  class="contenedor-lote" style="display: none;">
      <div class="mb-2">
        <select class="form-select select2" id="lote" name="lote">
          <option value="">Lote</option>
          <?php
          $x = 1;
          while ($x <= 366) {
            echo '
            <option value="L' . sprintf('%03d', $x) . '">L' . sprintf('%03d', $x) . '</option>
            ';
            $x++;
          }
          ?>
        </select>
      </div>
    </div>
    <style >
      .oculto{
  display: none;
}
    </style>

  <div id="contenedor-lote-2" class="contenedor-lote mt-3 mb-3 oculto">
    <img src="img/lote2.jpg" class="mb-2 col-2 mt-1"></img>
    <p style="padding-right: 10px;" class="mb-2">Lote</p>
    <div class="d-flex">
      <div class="form-group mb-2 me-3">
        <select class="form-control h-100" name="mes" id="mes">
          <option value=""></option>
          <option value="ENE">ENE</option>
          <option value="FEB">FEB</option>
          <option value="MAR">MAR</option>
          <option value="ABR">ABR</option>
          <option value="MAY">MAY</option>
          <option value="JUN">JUN</option>
          <option value="JUL">JUL</option>
          <option value="AGO">AGO</option>
          <option value="SEP">SEP</option>
          <option value="OCT">OCT</option>
          <option value="NOV">NOV</option>
          <option value="DIC">DIC</option>
        </select>
      </div>
      <div class="form-group mb-2 me-3">
        <select class="form-control h-100" name="anio" id="anio">
          <option value=""></option>
        </select>
      </div>
      <script>
        const selectElement = document.getElementById('anio');
        const currentYear = new Date().getFullYear();
        for (let i = currentYear - 3; i <= currentYear + 3; i++) {
          const option = document.createElement('option');
          option.value = i;
          option.text = i;
          selectElement.appendChild(option);
        }
      </script>
      <div class="form-group mb-2 me-3 col-1">
        <input type="text" class="form-control" name="L" readonly placeholder="L">
      </div>
      <div class="form-group mb-2 me-3">
        <input type="number" class="form-control h-100" name="codigo_lote" min="100000" max="999999" placeholder="6 digitos">
      </div>
      <div class="form-group mb-2">
        <select class="form-control h-100" name="turno" id="textbox1">
          <option value=""></option>
          <option value="M">M</option>
          <option value="T">T</option>
          <option value="N">N</option>
        </select>
      </div>
    </div>
  </div>


  <div id="contenedor-lote-3" class="contenedor-lote mt-3 mb-2 oculto" class="mt-5">
    <img src="img/lote3.jpg" class="mb-2 col-2 mt-1"></img>
    <p style="padding-right: 10px;" class="mb-2">Lote</p>
    <div class="d-flex">
      <div class="form-group mb-3 me-3">
        <select class="form-control h-100" name="x" id="x">
          <option value=""></option>
          <option value="X">X</option>
          <option value="Y">2</option>
        </select>
      </div>
      <div class="form-group mb-3 me-3">
        <input type="text" class="form-control" name="L" readonly placeholder="L" max="366">
      </div>
      <div class="form-group mb-3 me-3 col-2">
        <input type="number" class="form-control h-100" name="abc" min="100" max="999" placeholder="3 digitos">
      </div>
      <div class="form-group mb-3 me-3">
        <input type="text" class="form-control" name="vto" readonly placeholder="VTO">
      </div>
      <div class="form-group mb-3 me-3">
        <select class="form-control h-100" name="dia-lote-3" id="dia-lote-3">
          <option value=""></option>
          <?php for ($i = 1; $i <= 31; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php } ?>
        </select>
      </div>
      <span class="form-group mb-3 me-3 a-spacing mt-2">/</span>
      <div class="form-group mb-3 me-3">
        <select class="form-control h-100" name="mes-lote-3" id="mes-lote-3">
          <option value=""></option>
          <?php for ($i = 1; $i <= 12; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php } ?>
        </select>
      </div>
      <span class="form-group mb-3 me-3 a-spacing mt-2">/</span>
      <div class="form-group mb-3 me-3">
        <select class="form-control h-100" name="anio-lote-3" id="anio-lote-3">
          <option value=""></option>
        </select>
      </div>
    <script>
      const selectElement1 = document.getElementById('anio-lote-3');
      const currentYear1 = new Date().getFullYear();
      for (let x = currentYear1 - 3; x <= currentYear1 + 3; x++) {
        const option1 = document.createElement('option');
        option1.value = x;
        option1.text = x;
        selectElement1.appendChild(option1);
      }
    </script>

  
      <?php  $rArray['l']  ?>
              <script>
                  $(document).ready(function () {
                    $('#producto_id').on('change', function () {
                      var loteid = $(this).find('option:selected').data('loteid');
                      $('.contenedor-lote').hide(); // Oculta todos los contenedores de lote
                      if (loteid === 1) {
                        $('#contenedor-lote-1, #contenedor-lote-4').show(); // Muestra ambos contenedores
                        // Establece la propiedad 'required' para los elementos dentro de ambos contenedores
                        $('#contenedor-lote-1 select, #contenedor-lote-1 input, #contenedor-lote-4 select, #contenedor-lote-4 input').prop('required', true);
                      } else {
                        $('#contenedor-lote-' + loteid).show(); // Muestra el contenedor correspondiente
                        // Establece la propiedad 'required' para los elementos dentro del contenedor seleccionado
                        $('#contenedor-lote-' + loteid + ' select, #contenedor-lote-' + loteid + ' input').prop('required', true);
                      }
                    });
                  });
                </script>
    </div>
  </div>
  <div id="contenedor-lote-4" class="contenedor-lote" style="display: none;">  
  <div class="form-floating mb-3">
      <input type="date" class="form-control" name="fecha_vencimiento" id="fecha_vencimiento" placeholder="Fecha de vencimiento">
    <label for="fecha_vencimiento">Fecha de vencimiento</label>
  </div>
</div>
  <div class="mb-1"><i>Foto Fecha vencimiento y/o número del lote (obligatoria)</i></div>
            <div class="mb-3">
              <input class="form-control" type="file" id="foto1" name="foto1" accept="image/*" required>
            </div>
            <div class="mb-1"><i>Foto del motivo del reclamo (obligatoria)</i></div>
            <div class="mb-3">
              <input class="form-control" type="file" id="foto2" name="foto2" accept="image/*" required>
            </div>
            <div class="mb-1"><i>Si lo necesitás, podés subir más fotos acá</i></div>
            <div class="mb-2">
              <input class="form-control" type="file" id="fotos" name="fotos[]" accept="image/*" multiple>
            </div>
            <div class="mb-3">
              <i class="small text-danger"><i class="far fa-exclamation-triangle"></i> Aclaración: "Sólo recibimos fotos, de tener videos o querer enviarnos más fotos, por favor hacerlo a <a class="texto-negro" href="mailto:contacto@muecas.com.ar">contacto@muecas.com.ar</a>, es importante que en el asunto y/o cuerpo del correo se indique el número de seguimiento del caso para poder identificarlo. Sin esta información no será tenido en cuenta el registro audiovisual."
            </div>
            <div class="mb-2 text-center">
              <button type="submit" class="btn btn-negro px-5 btn-lg">Enviar</button>
            </div>
          </div>
</form>
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
        $("#localidad_id").html(xmlhttp.responseText);
      }
    }
    xmlhttp.open("POST","secciones/ajax_localidades.php?provincia_id="+provincia_id,true);
    xmlhttp.send();
  }
  else{
    
  }
});

$(document).ready(function() {
  $('.select2').select2();
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




