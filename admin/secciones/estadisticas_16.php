<?php
$desde1 = $_GET['desde1'];
$hasta1 = $_GET['hasta1'];
if ($_GET['desde'] == '') {
    $desde1 = date("Y-m", strtotime(date("Y", strtotime(date("Y"))) . "-2 years"));
}
if ($_GET['hasta'] == '') {
    $hasta1 = date('Y');
}

$start = (new DateTime($desde1 . '-01'))->modify('first day of this month');
$end = (new DateTime($hasta1 . '-01'))->modify('last day of this month');
$interval = DateInterval::createFromDateString('1 month');
$period = new DatePeriod($start, $interval, $end);

$cant = 0;
$tipoClienteData = [];
$aniosEstadistica = []; // Array para almacenar años

foreach ($period as $dt) {
    $anioQuery = $dt->format("Y");

    // Verifica si el año ya está en el array antes de agregarlo
    if (!in_array($anioQuery, $aniosEstadistica)) {
        $aniosEstadistica[] = $anioQuery;
    }
}

foreach ($aniosEstadistica as $anio) {
    $consulta = "SELECT tipo_cliente, COUNT(*) AS cantidad FROM reclamos WHERE YEAR(fecha)='$anio' AND tipo_cliente <> 'distribuidor' GROUP BY tipo_cliente";
    $resultado = mysql_query($consulta, $conexion);

    while ($rArray = mysql_fetch_array($resultado)) {
        $tipoClienteData[$rArray['tipo_cliente']][$anio] = $rArray['cantidad'];
        $cant = $cant + $rArray['cantidad'];
    }
}

$start = $start->format('Y-m-d');
$end = $end->format('Y-m-d');
?>
      <div class="col-lg-6 col-md-6 col-sm-6 matchHeight" id="estadisticas16">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <button class="btn btn-xs btn-default exportar-imagen" data-target="estadisticas16"><i class="fa fa-picture-o"></i></button>
            <h4 class="font-extra-bold m-t">
              Cantidad de reclamos Anuales por Cliente(Total: <?php echo $cant;?>)
            </h4>
            <div id="chart16" class="text-left"></div>

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
                        $colores = ["#3498DB", "#8E44AD", "#FFA500"];; // Define colores correspondientes a cada tipo de cliente
                        $indexColor = 0;

                        foreach ($tipoClienteData as $tipoCliente => $data) {
                            echo '{
                                "name": "' . $tipoCliente . '",
                                "data": [';
                            $x = 0;
                            foreach ($aniosEstadistica as $anio) {
                                echo '{
                                    "x": "' . $anio . '",
                                    "y": ' . (isset($data[$anio]) ? $data[$anio] : 0) . ',
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

var chart16 = new ApexCharts(document.querySelector("#chart16"), options);

chart16.render();
</script>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-sm-1 text-right">
                Desde
              </div>
              <div class="col-sm-4">
                <input type="year" class="form-control input-sm" name="desde1" value="<?php echo $desde1;?>" required form="formulario">
              </div>
              <div class="col-sm-1 text-right">
                Hasta
              </div>
              <div class="col-sm-4">
                <input type="year" class="form-control input-sm" name="hasta1" value="<?php echo $hasta1;?>" required form="formulario">
              </div>
              <div class="col-sm-2 text-right">
                <input type="submit" class="btn btn-danger btn-sm" value="Filtrar" form="formulario">
              </div>
            </div>
          </div>
        </div>
      </div>