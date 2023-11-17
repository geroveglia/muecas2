<?php
$desde13 = $_GET['desde13'];
$hasta13 = $_GET['hasta13'];
if($_GET['desde13']==''){
  $desde13 = date("Y-m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-5 month" ) );
}
if($_GET['hasta13']==''){
  $hasta13 = date('Y-m');
}

$start    = (new DateTime($desde13.'-01'))->modify('first day of this month');
$end      = (new DateTime($hasta13.'-01'))->modify('last day of this month');
$interval = DateInterval::createFromDateString('1 month');
$period   = new DatePeriod($start, $interval, $end);

foreach($period as $dt){
  $mesesEstadistica13[] = $dt->format("n");
  $mesQuery = $dt->format("m");
  $anioQuery = $dt->format("Y");
  $consulta = "SELECT count(*) as cantidad,  MONTH(fecha) as mes FROM reclamos WHERE MONTH(fecha)='$mesQuery' AND YEAR(fecha)='$anioQuery' AND tipo_noconformidad='Material Extraño en Barra'";
  $resultado = mysql_query($consulta,$conexion);
  while($rArray = mysql_fetch_array($resultado)) {
    $valoresEstadistica13[$dt->format("n")] = $rArray['cantidad'];
  }
}
//var_dump($valoresEstadistica13);
$start = $start->format('Y-m-d');
$end = $end->format('Y-m-d');
?>
      <div class="col-lg-6 col-md-6 col-sm-6 matchHeight" id="estadisticas13">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <button class="btn btn-xs btn-default exportar-imagen" data-target="estadisticas13"><i class="fa fa-picture-o"></i></button>
            <h4 class="font-extra-bold m-t">
              Presencia de Material Extraño
            </h4>
            <div class="m-b font-bold">Mensual</div>
            <div id="chart13" class="text-left"></div>

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
foreach($valoresEstadistica13 as $value){
  echo '
                {
                    "x": "'.$meses[$mesesEstadistica13[$x]].'",
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

var chart13 = new ApexCharts(document.querySelector("#chart13"), options);

chart13.render();
</script>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-sm-1 text-right">
                Desde
              </div>
              <div class="col-sm-4">
                <input type="month" class="form-control input-sm" name="desde13" value="<?php echo $desde13;?>" required form="formulario">
              </div>
              <div class="col-sm-1 text-right">
                Hasta
              </div>
              <div class="col-sm-4">
                <input type="month" class="form-control input-sm" name="hasta13" value="<?php echo $hasta13;?>" required form="formulario">
              </div>
              <div class="col-sm-2 text-right">
                <input type="submit" class="btn btn-danger btn-sm" value="Filtrar" form="formulario">
              </div>
            </div>
          </div>
        </div>
      </div>