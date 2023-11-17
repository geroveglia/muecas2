<?php
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
if ($_GET['desde'] == '') {
    $desde = date("Y-m", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "-5 month"));
}
if ($_GET['hasta'] == '') {
    $hasta = date('Y-m');
}

$start = (new DateTime($desde . '-01'))->modify('first day of this month');
$end = (new DateTime($hasta . '-01'))->modify('last day of this month');
$interval = DateInterval::createFromDateString('1 month');
$period = new DatePeriod($start, $interval, $end);

$cant = 0;
$tipoClienteData = [];
$mesesEstadistica15 = []; // Corrección: inicializar el array de meses

foreach ($period as $dt) {
    $mesesEstadistica15[] = $dt->format("n");
    $mesQuery = $dt->format("m");
    $anioQuery = $dt->format("Y");
    $consulta = "SELECT tipo_cliente, COUNT(*) AS cantidad FROM reclamos WHERE MONTH(fecha)='$mesQuery' AND YEAR(fecha)='$anioQuery' AND tipo_cliente <> 'distribuidor' GROUP BY tipo_cliente";
    $resultado = mysql_query($consulta, $conexion);

    while ($rArray = mysql_fetch_array($resultado)) {
        $tipoClienteData[$rArray['tipo_cliente']][$dt->format("n")] = $rArray['cantidad'];
        $cant = $cant + $rArray['cantidad'];
    }
}
//var_dump($mesesEstadistica2);
//var_dump($valoresEstadistica2);
$start = $start->format('Y-m-d');
$end = $end->format('Y-m-d');
?>
      <div class="col-lg-6 col-md-6 col-sm-6 matchHeight" id="estadisticas15">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <button class="btn btn-xs btn-default exportar-imagen" data-target="estadisticas15"><i class="fa fa-picture-o"></i></button>
            <h4 class="font-extra-bold m-t">
              Cantidad de reclamos Mensuales (Total: <?php echo $cant;?>)
            </h4>
            <div id="chart15" class="text-left"></div>

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
    "#8E44AD", // Violeta
    "#3498DB", // Azul
    "#FFA500"  // Naranja
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
    <?php
    $colores = ["#FF5733", "#3498DB", "#27AE60", "#F39C12", "#E74C3C"]; // Define colores correspondientes a cada tipo de cliente
    $indexColor = 0;

    foreach ($tipoClienteData as $tipoCliente => $data) {
        echo '{
            "name": "' . $tipoCliente . '",
            "data": [';
        $x = 0;
        foreach ($mesesEstadistica15 as $mes) {
            echo '{
                "x": "' . $meses[$mesesEstadistica2[$x]] . '",
                "y": ' . (isset($data[$mes]) ? $data[$mes] : 0) . ',
                "color": "' . $colores[$indexColor] . '" // Asigna el color correspondiente
            },';
            $x++;
        }
        echo ']
        },';

        $indexColor++;
    }
    ?>
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

var chart15 = new ApexCharts(document.querySelector("#chart15"), options);

chart15.render();
</script>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-sm-1 text-right">
                Desde
              </div>
              <div class="col-sm-4">
                <input type="month" class="form-control input-sm" name="desde" value="<?php echo $desde;?>" required form="formulario">
              </div>
              <div class="col-sm-1 text-right">
                Hasta
              </div>
              <div class="col-sm-4">
                <input type="month" class="form-control input-sm" name="hasta" value="<?php echo $hasta;?>" required form="formulario">
              </div>
              <div class="col-sm-2 text-right">
                <input type="submit" class="btn btn-danger btn-sm" value="Filtrar" form="formulario">
              </div>
            </div>
          </div>
        </div>
      </div>