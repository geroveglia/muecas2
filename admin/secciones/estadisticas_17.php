<div class="col-lg-6 col-md-6 col-sm-6 matchHeight" id="estadisticas16">
    <div class="hpanel">
        <div class="panel-body text-center h-200">
            <button class="btn btn-xs btn-default exportar-imagen" data-target="estadisticas16"><i class="fa fa-picture-o"></i></button>
            <h4 class="font-extra-bold m-t">
                Cantidad de reclamos por tipo de cliente
            </h4>
            <div class="m-b font-bold">Anual</div>
            <div id="chart16" class="text-left"></div>
            <?php
            $fecha = date('Y-m-d', strtotime('-365 days'));

            $consulta = "SELECT count(*) as cantidad, tipo_cliente FROM reclamos WHERE tipo_cliente != '' AND tipo_cliente IS NOT NULL AND fecha >= '$fecha' GROUP BY tipo_cliente ORDER BY cantidad DESC";
            $resultado = mysql_query($consulta, $conexion);
            $cant = mysql_num_rows($resultado);

            $tipo_cliente = array();
            while ($rArray = mysql_fetch_array($resultado)) {
                $tipo_cliente[$rArray['tipo_cliente']] = $rArray['cantidad'];
            }

            if ($cant > 0) {
                ?>
                <script>
                    var options = {
                        chart: {
                            animations: {
                                enabled: false
                            },
                            foreColor: "#333",
                            id: "r1Sjs",
                            toolbar: {
                                show: false
                            },
                            type: "pie"
                        },
                        colors: [
                            <?php
                            $colores = array("#FF5733", "#33FF57", "#3357FF"); // Define your colors here
                            $keys = array_keys($tipo_cliente);
                            foreach ($keys as $key) {
                                echo '"' . $colores[array_search($key, $keys)] . '",';
                            }
                            ?>
                        ],
                        fill: {
                            opacity: 1
                        },
                        labels: [
                            <?php
                            foreach ($tipo_cliente as $key => $value) {
                                echo '"' . $key . '",';
                            }
                            ?>
                        ],
                        legend: {
                            position: "right",
                            fontSize: 14,
                            offsetY: 0,
                            itemMargin: {
                                vertical: 0
                            }
                        },
                        dataLabels: {
                            style: {
                                fontSize: 16
                            },
                            background: {
                                padding: 3,
                                borderWidth: 2
                            }
                        },
                        series: [
                            <?php
                            foreach ($tipo_cliente as $key => $value) {
                                echo $value . ',';
                            }
                            ?>
                        ]
                    }

                    var chart16 = new ApexCharts(document.querySelector("#chart16"), options);

                    chart16.render();
                </script>
            <?php
            } else {
                echo '<h4>No hay datos.</h4>';
            }
            ?>
        </div>
    </div>
</div>
