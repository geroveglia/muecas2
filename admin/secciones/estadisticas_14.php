<?php
$mes = $_GET['mes14'];
$mesArray = explode("-",$mes);
$mesQuery = $mesArray[1];
$anioQuery = $mesArray[0];
if($_GET['mes14']==''){
  $mes = date('Y-m');
  $mesQuery = date('m');
  $anioQuery = date('Y');
}
?>
      <div class="col-lg-6 col-md-6 col-sm-6 matchHeight" id="estadisticas14">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <button class="btn btn-xs btn-default exportar-imagen" data-target="estadisticas14"><i class="fa fa-picture-o"></i></button>
            <h4 class="font-extra-bold m-t">
              Presencia de Material Extraño por sabor
            </h4>
            <div class="m-b font-bold">Mensual</div>
            <div id="chart14" class="text-left"></div>
<?php
$tipo_noconformidad = '';
$coloresEstadistica3 = array('#e5a200', '#ffb400', '#ffcf5e');
$consulta = "SELECT count(*) as cantidad, tipo_noconformidad, barrita FROM reclamos WHERE tipo_noconformidad='Material Extraño en Barra' AND MONTH(fecha)='$mesQuery' AND YEAR(fecha)='$anioQuery' GROUP BY barrita ORDER BY cantidad DESC";
$resultado = mysql_query($consulta,$conexion);
$cant = mysql_num_rows($resultado);
while($rArray = mysql_fetch_array($resultado)) {
  $tipo_noconformidad[$rArray['barrita']] = $rArray['cantidad'];
}
//var_dump($tipo_noconformidad);
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
    "fill": {
        "opacity": 1
    },
    "labels": [
<?php
foreach($tipo_noconformidad as $key => $value){
  echo '"'.$key.'",';
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

var chart14 = new ApexCharts(document.querySelector("#chart14"), options);

chart14.render();
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
                <input type="month" class="form-control input-sm" name="mes14" value="<?php echo $mes;?>" required form="formulario">
              </div>
              <div class="col-sm-2 text-right">
                <input type="submit" class="btn btn-danger btn-sm" value="Filtrar" form="formulario">
              </div>
            </div>
          </div>
        </div>
      </div>