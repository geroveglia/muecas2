      <div class="col-lg-6 col-md-6 col-sm-6 matchHeight" id="estadisticas3">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <button class="btn btn-xs btn-default exportar-imagen" data-target="estadisticas3"><i class="fa fa-picture-o"></i></button>
            <h4 class="font-extra-bold m-t">
              Cantidad de reclamos por causa
            </h4>
            <div class="m-b font-bold">Acumulado</div>
            <div id="chart3" class="text-left"></div>
<?php
$consulta = "SELECT count(*) as cantidad, tipo_noconformidad FROM reclamos WHERE tipo_noconformidad!='' AND tipo_noconformidad IS NOT NULL GROUP BY tipo_noconformidad ORDER BY cantidad DESC";
$resultado = mysql_query($consulta,$conexion);
$cant = mysql_num_rows($resultado);
while($rArray = mysql_fetch_array($resultado)) {
  $tipo_noconformidad[$rArray['tipo_noconformidad']] = $rArray['cantidad'];
}

$cant = mysql_num_rows($resultado);
if($cant>0){
?>
<script>
var options = {
    "chart": {
        "animations": {
            "enabled": false
        },
        "foreColor": "#333",
        "id": "r1Sjs",
        "toolbar": {
            "show": false
        },
        "type": "pie"
    },
    "colors": [
<?php
foreach($tipo_noconformidad as $key => $value){
  echo '"'.$colores[$key].'",';
}
?>
      ],
    "fill": {
        "opacity": 1
    },
    "labels": [
<?php
foreach($tipo_noconformidad as $key => $value){
  echo '"'.$cortos[$key].'",';
}
?>
    ],
    "legend": {
        "position": "right",
        "fontSize": 14,
        "offsetY": 0,
        "itemMargin": {
            "vertical": 0
        }
    },
    "dataLabels": {
        "style": {
            "fontSize": 16
        },
        "background": {
            "padding": 3,
            "borderWidth": 2
        }
    },
    "series": [
<?php
foreach($tipo_noconformidad as $key => $value){
  echo ''.$value.',';
}
?>
    ]
}

var chart3 = new ApexCharts(document.querySelector("#chart3"), options);

chart3.render();
</script>
<?php
}
else{
  echo '<h4>No hay datos.</h4>';
}
?>
          </div>
        </div>
      </div>