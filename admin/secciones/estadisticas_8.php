<?php
$anio = $_GET['anio8'];
if($_GET['anio8']==''){
  $anio = date('Y');
}

$consulta = "SELECT count(*) as cantidad, reclamos.* FROM reclamos WHERE YEAR(fecha_fabricacion)='$anio' AND tipo_noconformidad='Contaminación con Polilla (Huevo, Tela de Capullo, Gusano-Larva, Polilla Adulta)' GROUP BY MONTH(fecha_fabricacion) ORDER BY fecha_fabricacion ASC";
$resultado = mysql_query($consulta,$conexion);
$cant = mysql_num_rows($resultado);
while($rArray = mysql_fetch_array($resultado)) {
  $mes = $meses[strftime('%m', strtotime($rArray['fecha_fabricacion']))*1];
  $valoresEstadistica8[$mes] = $rArray['cantidad'];
}
//var_dump($valoresEstadistica8);
?>
      <div class="col-lg-6 col-md-6 col-sm-6 matchHeight" id="estadisticas8">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <button class="btn btn-xs btn-default exportar-imagen" data-target="estadisticas8"><i class="fa fa-picture-o"></i></button>
            <h4 class="font-extra-bold m-t">
              Mes de Fabricación de mayor incidencia en Contaminación por polilla
            </h4>
            <div id="chart8" class="text-left"></div>
<?php
if($cant>0){
?>
<script>
var options = {
    "chart": {
        "animations": {
            "enabled": false,
            "easing": "swing"
        },
        "background": "#FFFFFF",
        "foreColor": "#000000",
        "id": "JzJ8c",
        "toolbar": {
            "show": false
        },
        "type": "bar"
    },
    "plotOptions": {
        "bar": {
            "distributed": false,
            "borderRadius": 0
        }
    },
    "colors": [
        "#000000"
    ],
    "dataLabels": {
        "enabled": true,
        "offsetY": 0,
        "style": {
            "fontWeight": 700
        }
    },
    "legend": {
        "fontSize": 14,
        "offsetY": 0,
        "markers": {
            "shape": "square",
            "size": 8
        },
        "itemMargin": {
            "vertical": 0
        }
    },
    "series": [
        {
            "name": "Cantidad",
            "data": [
<?php
$x = 0;
foreach($valoresEstadistica8 as $key => $value){
  echo '
                {
                    "x": "'.$key.'",
                    "y": '.$value.'
                },';
  $x++;
}
?>
            ]
        }
    ],
    "tooltip": {
        "shared": false,
        "intersect": true
    },
    "xaxis": {
        "type": "numeric",
        "labels": {
            "trim": true,
            "style": {}
        },
        "tickPlacement": "top",
        "title": {
            "style": {
                "fontWeight": 700
            }
        },
        "tooltip": {
            "enabled": false
        }
    },
    "yaxis": {
        "tickAmount": 5,
        "labels": {
            "style": {}
        },
        "title": {
            "style": {
                "fontWeight": 700
            }
        }
    }
}

var chart8 = new ApexCharts(document.querySelector("#chart8"), options);

chart8.render();
</script>
<?php
}
else{
  echo '<h4>No hay datos.</h4>';
}
?>
<?php
$anio_inicial = 2022;
$anio_final = date('Y');
while($anio_inicial<=$anio_final){
  $anios[] = $anio_inicial;
  $anio_inicial++;
}


?>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-sm-4 text-right">
                Año
              </div>
              <div class="col-sm-6">
                <select class="form-control input-sm" name="anio8" required form="formulario">
<?php
foreach($anios as $value){
  echo '
                  <option '.(($anio==$value)?'selected':'').'>'.$value.'</option>
  ';
}
?>
                </select>
              </div>
              <div class="col-sm-2 text-right">
                <input type="submit" class="btn btn-danger btn-sm" value="Filtrar" form="formulario">
              </div>
            </div>
          </div>
        </div>
      </div>