      <div class="col-lg-6 col-md-6 col-sm-6 matchHeight" id="estadisticas1">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <button class="btn btn-xs btn-default exportar-imagen" data-target="estadisticas1"><i class="fa fa-picture-o"></i></button>
            <h4 class="font-extra-bold text-black m-t">
              Cantidad de reclamos por nombre
            </h4>
            <div>Top 5 últimos 30 días</div>
            <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
              <thead>
                <tr role="row">
                  <th>Cant</th>
                  <th>Cliente</th>
                </tr>
              </thead>
              <tbody>
<?php
$consulta = "SELECT *, count(*) as cantidad FROM reclamos WHERE fecha BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND email IS NOT NULL GROUP BY email LIMIT 5";
$resultado = mysql_query($consulta,$conexion);
while($rArray = mysql_fetch_array($resultado)) {
  $monto = $rArray['monto']-($rArray['monto']*$rArray['descuento_aplicado']/100);
  echo '
                <tr>
                  <td>'.$rArray['cantidad'].'</td>
                  <td>'.$rArray['nombre'].'</td>
                </tr>
  ';
}
?>
              </tbody>
            </table>
          </div>
          <div class="panel-footer text-center">
            <a href="./?seccion=dashboard_reclamos_pornombre&nc=<?php echo $rand;?>" class="btn btn-warning btn-lg">Ver todos</a>
          </div>
        </div>
      </div>