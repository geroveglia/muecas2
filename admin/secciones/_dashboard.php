<?php
$consulta = "SELECT COUNT(Id) AS total FROM clientes WHERE tipo='minorista'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$clientes_minoristas = $rArray['total'];
$consulta = "SELECT COUNT(Id) AS total FROM clientes WHERE tipo='comercio'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$clientes_comercios = $rArray['total'];
$consulta = "SELECT COUNT(Id) AS total FROM clientes WHERE tipo='distribuidor'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$clientes_distribuidor = $rArray['total'];
$consulta = "SELECT COUNT(Id) AS total FROM clientes WHERE telefonico='1'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$clientes_telefonicos = $rArray['total'];

$consulta = "SELECT COUNT(Id) AS total, SUM(monto-(monto*descuento_aplicado/100)) AS monto FROM pedidos WHERE fecha_entrega BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND estado='Entregado'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$entregados = $rArray['total'];
$entregados_monto = $rArray['monto'];

$consulta = "SELECT * FROM franjas WHERE Id='1'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$franja1 = $rArray['franja'];
$consulta = "SELECT * FROM franjas WHERE Id='2'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$franja2 = $rArray['franja'];
$consulta = "SELECT * FROM franjas WHERE Id='3'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$franja3 = $rArray['franja'];
$consulta = "SELECT COUNT(Id) AS total FROM pedidos WHERE franja_id='1' AND fecha_entrega BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND estado='Entregado'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$franja1_total = $rArray['total'];
$consulta = "SELECT COUNT(Id) AS total FROM pedidos WHERE franja_id='2' AND fecha_entrega BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND estado='Entregado'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$franja2_total = $rArray['total'];
$consulta = "SELECT COUNT(Id) AS total FROM pedidos WHERE franja_id='3' AND fecha_entrega BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND estado='Entregado'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$franja3_total = $rArray['total'];

$consulta = "SELECT SUM(monto-(monto*descuento_aplicado/100)) AS monto FROM pedidos LEFT JOIN clientes ON clientes.Id=pedidos.cliente_id WHERE fecha_entrega BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND estado='Entregado' AND tipo='minorista'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$minorista_entregados = $rArray['total'];
$minorista_total = $rArray['monto'];
$consulta = "SELECT SUM(monto-(monto*descuento_aplicado/100)) AS monto FROM pedidos LEFT JOIN clientes ON clientes.Id=pedidos.cliente_id WHERE fecha_entrega BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND estado='Entregado' AND tipo='comercio'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$comercio_entregados = $rArray['total'];
$comercio_total = $rArray['monto'];

$consulta = "SELECT COUNT(Id) AS total FROM pedidos WHERE fecha_entrega BETWEEN CURDATE() AND CURDATE() + INTERVAL 1 DAY AND (estado='En preparación' OR estado='Recibido')";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$cant_proximos = $rArray['total'];
?>
<!-- Main Wrapper -->
<div id="wrapper">
  <div class="content animate-panel">
    <div class="row m-b-lg">
      <div class="col-lg-12 text-center m-t-md">
        <h2>Bienvenido, <?php echo $_SESSION["usuario"];?></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 matchHeight">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <i class="fa fa-users fa-4x" aria-hidden="true"></i>
            <h4 class="font-extra-bold text-warning m-t">
              Clientes minoristas: <span class="text-gray large"><?php echo $clientes_minoristas;?></span><br>
              Comercios: <span class="text-gray large"><?php echo $clientes_comercios;?></span><br>
              Distribuidores: <span class="text-gray large"><?php echo $clientes_distribuidor;?></span><br>
              Clientes telef&oacute;nicos: <span class="text-gray large"><?php echo $clientes_telefonicos;?></span>
            </h4>
          </div>
          <div class="panel-footer">
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 matchHeight">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <i class="fa fa-arrow-right fa-4x" aria-hidden="true"></i>
            <h1 class="m-xs"><?php echo $entregados;?> ($<?php echo $entregados_monto;?>)</h1>
            <h3 class="font-extra-bold no-margins text-warning">
              Pedidos entregados 
            </h3>
          </div>
          <div class="panel-footer">
            &Uacute;ltimos 30 d&iacute;as
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 matchHeight">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <i class="fa fa-money fa-4x" aria-hidden="true"></i>
            <h4 class="font-extra-bold text-warning m-t">
              Minorista: <span class="text-gray large">$<?php echo $minorista_total;?></span><br>
              Comercios: <span class="text-gray large">$<?php echo $comercio_total;?></span>
            </h4>
            <h3 class="font-extra-bold no-margins text-warning">
              Ventas por tipo de cliente
            </h3>
          </div>
          <div class="panel-footer">
            &Uacute;ltimos 30 d&iacute;as
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 matchHeight">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <i class="fa fa-clock-o fa-4x" aria-hidden="true"></i>
            <h4 class="font-extra-bold text-warning m-t">
              <?php echo $franja1;?>: <span class="text-gray large"><?php echo $franja1_total;?></span><br>
              <?php echo $franja2;?>: <span class="text-gray large"><?php echo $franja2_total;?></span><br>
              <?php echo $franja3;?>: <span class="text-gray large"><?php echo $franja3_total;?></span>
            </h4>
            <h3 class="font-extra-bold no-margins text-warning">
              Pedidos por franja horaria 
            </h3>
          </div>
          <div class="panel-footer">
            &Uacute;ltimos 30 d&iacute;as
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <h3 class="font-extra-bold no-margins text-warning">
              Pedidos pr&oacute;ximos a entregar <span class="text-gray large">(<?php echo $cant_proximos;?>)</span>
            </h3>
            <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
            <thead>
            <tr role="row">
              <th>Nº</th>
              <th>Fecha de entrega</th>
              <th>Monto</th>
              <th>Estado</th>
              <th>Cliente</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
<?php
$consulta = "SELECT * FROM pedidos WHERE fecha_entrega BETWEEN CURDATE() AND CURDATE() + INTERVAL 1 DAY AND (estado='En preparación' OR estado='Recibido')";
$resultado = mysql_query($consulta,$conexion);
while($rArray = mysql_fetch_array($resultado)) {
  $monto = $rArray['monto']-($rArray['monto']*$rArray['descuento_aplicado']/100);
  echo '
    <tr>
      <td><a href="./?seccion=pedidos_view&id='.$rArray['Id'].'&nc='.$rand.'">'.$rArray['Id'].'</a></td>
      <td>'.strftime('%d-%m-%Y', strtotime($rArray['fecha_entrega'])).'</td>
      <td>$'.$monto.'</td>
      <td>'.$rArray['estado'].'</td>
      <td>'.$rArray['estado'].'</td>
      <td><a href="./?seccion=pedidos_view&id='.$rArray['Id'].'&nc='.$rand.'" class="btn btn-lili btn-xs"><i class="fa fa-eye"></i></a></td>
    </tr>
  ';
}
?>
            </tbody>
            </table>
          </div>
          <div class="panel-footer">
            Hoy y ma&ntilde;ana
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <h3 class="font-extra-bold no-margins text-warning">
              Productos m&aacute;s vendidos
            </h3>
            <table class="table table-striped table-bordered table-hover dataTables-example2 dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
            <thead>
            <tr role="row">
              <th>Cantidad</th>
              <th>C&oacute;digo</th>
              <th>Nombre</th>
            </tr>
            </thead>
            <tbody>
<?php
$consulta = "SELECT *, SUM(cantidad) AS cantidad FROM pedidos_detalle LEFT JOIN pedidos ON pedidos.Id=pedidos_detalle.pedido_id LEFT JOIN productos ON productos.Id=pedidos_detalle.producto_id WHERE fecha_entrega BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND estado='Entregado' GROUP BY pedidos_detalle.producto_id ORDER BY cantidad DESC";
$resultado = mysql_query($consulta,$conexion);
while($rArray = mysql_fetch_array($resultado)) {
  $monto = $rArray['monto']-($rArray['monto']*$rArray['descuento_aplicado']/100);
  echo '
    <tr>
      <td>'.$rArray['cantidad'].'</td>
      <td>'.$rArray['codigo'].'</td>
      <td>'.$rArray['nombre'].'</td>
    </tr>
  ';
}
?>
            </tbody>
            </table>
          </div>
          <div class="panel-footer">
            &Uacute;ltimos 30 d&iacute;as
          </div>
        </div>
      </div>
    </div>
  </div>
  
<!-- Page-Level Scripts -->
<script>
$(document).ready(function(){
    $('.dataTables-example').DataTable({
        columnDefs: [
           { type: 'date-eu', targets: 1 }
         ],
        "iDisplayLength": 100,
        "aLengthMenu": [[10, 25, 50, 100, 1000], [10, 25, 50, 100, 1000]],
        "order": [[ 0, "desc" ]],
        dom: '<"html5buttons"B>',
        buttons: [
        ],
        "language": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ning&uacute;n dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "&Uacute;ltimo",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
  }

    });

    /* Init DataTables */
    var oTable = $('#editable').DataTable();

});
$(document).ready(function(){
    $('.dataTables-example2').DataTable({
        "iDisplayLength": 100,
        "aLengthMenu": [[10, 25, 50, 100, 1000], [10, 25, 50, 100, 1000]],
        "order": [[ 0, "desc" ]],
        dom: '<"html5buttons"B>',
        buttons: [
        ],
        "language": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ning&uacute;n dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "&Uacute;ltimo",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
  }

    });

    /* Init DataTables */
    var oTable = $('#editable').DataTable();

});
jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "date-eu-pre": function ( date ) {
        date = date.replace(" ", "");
         
        if ( ! date ) {
            return 0;
        }
 
        var year;
        var eu_date = date.split(/[\.\-\/]/);
 
        /*year (optional)*/
        if ( eu_date[2] ) {
            year = eu_date[2];
        }
        else {
            year = 0;
        }
 
        /*month*/
        var month = eu_date[1];
        if ( month.length == 1 ) {
            month = 0+month;
        }
 
        /*day*/
        var day = eu_date[0];
        if ( day.length == 1 ) {
            day = 0+day;
        }
 
        return (year + month + day) * 1;
    },
 
    "date-eu-asc": function ( a, b ) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },
 
    "date-eu-desc": function ( a, b ) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }
} );
</script>