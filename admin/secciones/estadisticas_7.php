<?php
$mes = $_GET['mes7'];
$mesArray = explode("-",$mes);
$mesQuery = $mesArray[1];
$anioQuery = $mesArray[0];
if($_GET['mes7']==''){
  $mes = date('Y-m');
  $mesQuery = date('m');
  $anioQuery = date('Y');
}

$consulta = "SELECT count(*) as cantidad, tipo_noconformidad, lote FROM reclamos WHERE MONTH(fecha)='$mesQuery' AND YEAR(fecha)='$anioQuery' AND tipo_noconformidad='Contaminación con Polilla (Huevo, Tela de Capullo, Gusano-Larva, Polilla Adulta)' GROUP BY lote ORDER BY cantidad DESC LIMIT 3 ";
$resultado = mysql_query($consulta,$conexion);
$cant = mysql_num_rows($resultado);
while($rArray = mysql_fetch_array($resultado)) {
  $valoresEstadistica7[$rArray['lote']] = $rArray['cantidad'];
}
//var_dump($valoresEstadistica7);
?>
      <div class="col-lg-6 col-md-6 col-sm-6 matchHeight" id="estadisticas7">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <button class="btn btn-xs btn-default exportar-imagen" data-target="estadisticas7"><i class="fa fa-picture-o"></i></button>
            <h4 class="font-extra-bold m-t">
              Contaminación con Polilla por Lote (mensual)
            </h4>
            <div class="m-b font-bold">TOP 3</div>
            <div id="chart7" class="text-left"></div>
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
foreach($valoresEstadistica7 as $key => $value){
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
        "tickPlacement": "between",
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

var chart7 = new ApexCharts(document.querySelector("#chart7"), options);

chart7.render();
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
                <input type="month" class="form-control input-sm" name="mes7" value="<?php echo $mes;?>" required form="formulario">
              </div>
              <div class="col-sm-2 text-right">
                <input type="submit" class="btn btn-danger btn-sm" value="Filtrar" form="formulario">
              </div>
            </div>
          </div>
        </div>
      </div>