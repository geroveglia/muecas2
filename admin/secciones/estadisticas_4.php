<?php
$mes = $_GET['mes'];
$mesArray = explode("-",$mes);
$mesQuery = $mesArray[1];
$anioQuery = $mesArray[0];
if($_GET['mes']==''){
  $mes = date('Y-m');
  $mesQuery = date('m');
  $anioQuery = date('Y');
}
?>
      <div class="col-lg-6 col-md-6 col-sm-6 matchHeight" id="estadisticas4">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <button class="btn btn-xs btn-default exportar-imagen" data-target="estadisticas4"><i class="fa fa-picture-o"></i></button>
            <h4 class="font-extra-bold m-t">
              Cantidad de reclamos por causa
            </h4>
            <div class="m-b font-bold">Mensual</div>
            <div id="chart4" class="text-left"></div>
<?php
$tipo_noconformidad = '';
$consulta = "SELECT count(*) as cantidad, tipo_noconformidad FROM reclamos WHERE tipo_noconformidad!='' AND tipo_noconformidad IS NOT NULL AND MONTH(fecha)='$mesQuery' AND YEAR(fecha)='$anioQuery' GROUP BY tipo_noconformidad ORDER BY cantidad DESC";
$resultado = mysql_query($consulta,$conexion);
$cant = mysql_num_rows($resultado);
while($rArray = mysql_fetch_array($resultado)) {
  $tipo_noconformidad[$rArray['tipo_noconformidad']] = $rArray['cantidad'];
}
?>
<?php
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

var chart4 = new ApexCharts(document.querySelector("#chart4"), options);

chart4.render();
</script>
<?php
}
else{
  echo '<h4>No hay datos.</h4>';
}
?>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-sm-4 text-right">
                Mes
              </div>
              <div class="col-sm-6">
                <input type="month" class="form-control input-sm" name="mes" value="<?php echo $mes;?>" required form="formulario">
              </div>
              <div class="col-sm-2 text-right">
                <input type="submit" class="btn btn-danger btn-sm" value="Filtrar" form="formulario">
              </div>
            </div>
          </div>
        </div>
      </div>