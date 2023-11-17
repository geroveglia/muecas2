<?php
$franja = $_GET['franja'];
$zona = $_GET['zona'];
$estado = $_GET['estado'];
if($franja!=''){$franjaAgregado = "AND franja_id='$franja'";}
if($zona!=''){
  $zonaAgregado = "AND (clientes.barrio='123456789'";
  $consulta = "SELECT * FROM zonas_barrios WHERE zona_id='$zona'";
  $resultado = mysql_query($consulta,$conexion);
  while($rArray = mysql_fetch_array($resultado)){
    $barrio = $rArray['barrio_id'];
    $zonaAgregado = $zonaAgregado." OR clientes.barrio='$barrio'";
  }
  $zonaAgregado = $zonaAgregado.")";
}
if($estado!=''){
  $estadoAgregado = "WHERE estado='$estado'";
  $titulo = ' > Estado: '.$estado;
}
else{
  $estadoAgregado = "WHERE estado!='Entregado' AND estado!='Anulado'";
}
?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Pedidos
        <span class="pull-right">
          <a href="./?seccion=pedidos&nc=<?php echo $rand;?>" class="btn btn-default btn-xs">Todos</a>
<?php
$consultaF = "SELECT * FROM franjas";
$resultadoF = mysql_query($consultaF,$conexion);
while($rArrayF = mysql_fetch_array($resultadoF)) {
  echo '
          <a href="./?seccion=pedidos&franja='.$rArrayF['Id'].'&nc='.$rand.'" class="btn btn-warning btn-xs">'.$rArrayF['franja'].'</a>
  ';
  if($franja==$rArrayF['Id']){$titulo = ' > Franja: '.$rArrayF['franja'];}
}
?>
<?php
$consultaZ = "SELECT * FROM zonas ORDER BY zona";
$resultadoZ = mysql_query($consultaZ,$conexion);
while($rArrayZ = mysql_fetch_array($resultadoZ)) {
  echo '
          <a href="./?seccion=pedidos&zona='.$rArrayZ['Id'].'&nc='.$rand.'" class="btn btn-info btn-xs">Zona '.$rArrayZ['zona'].'</a>
  ';
  if($zona==$rArrayZ['Id']){$titulo = ' > Zona: '.$rArrayZ['zona'];}
}
?>
          <a href="./?seccion=pedidos&estado=Entregado&nc=<?php echo $rand;?>" class="btn btn-success btn-xs">Entregados</a>
          <a href="./?seccion=pedidos&estado=Anulado&nc=<?php echo $rand;?>" class="btn btn-danger btn-xs">Anulados</a>
        </span>
        <?php echo $titulo;?>
      </h2>
    </div>
  </div>
</div>
<div class="content animate-panel">
  <div class="row">
    <div class="col-lg-12">
      <div class="hpanel">
        <div class="panel-body">
          <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_warning" role="grid">
          <thead>
          <tr role="row">
            <th>Nº</th>
            <th>Fecha de entrega</th>
            <th>Cliente</th>
            <th>Direcci&oacute;n</th>
            <th>Barrio</th>
            <th>Zona</th>
            <th>Franja</th>
            <th>Monto</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
            <?php
            $consulta = "SELECT *, pedidos.id AS Id, clientes.Id AS clienteId, pedidos.telefonico AS telefonico, barrios.Id AS barrio_id FROM pedidos LEFT JOIN clientes ON clientes.Id=pedidos.cliente_id LEFT JOIN franjas ON franjas.Id=pedidos.franja_id LEFT JOIN barrios ON barrios.Id=clientes.barrio $estadoAgregado $zonaAgregado $franjaAgregado";
            $resultado = mysql_query($consulta,$conexion);
            while($rArray = mysql_fetch_array($resultado)) {
            $monto = number_format((float)$rArray['monto'], 2, '.', '');
            $monto = str_replace(".00","",$monto);
            
            $consultaZ = "SELECT * FROM zonas_barrios LEFT JOIN barrios ON barrios.Id=zonas_barrios.barrio_id LEFT JOIN zonas ON zonas.Id=zonas_barrios.zona_id WHERE barrio_id=".$rArray['barrio_id'];
            $resultadoZ = mysql_query($consultaZ,$conexion);
            $rArrayZ = mysql_fetch_array($resultadoZ);
            
            echo '
              <tr>
                <td><a href="./?seccion=pedidos_view&id='.$rArray['Id'].'&nc='.$rand.'">'.$rArray['Id'].'</a></td>
                <td>'.strftime('%d-%m-%Y', strtotime($rArray['fecha_entrega'])).'</td>
                <td>'.$rArray['nombre'].' '.$rArray['apellido'].'</td>
                <td>'.$rArray['direccion'].'</td>
                <td>'.$rArray['barrio'].'</td>
                <td>'.$rArrayZ['zona'].'</td>
                <td>'.$rArray['franja'].'</td>
                <td>$'.$monto.'</td>
                <td>
                <a href="./?seccion=pedidos_view&id='.$rArray['Id'].'&nc='.$rand.'" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                <a href="./?seccion=pedidos_edit&id='.$rArray['Id'].'&cid='.$rArray['clienteId'].'&nc='.$rand.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                <a href="./?seccion=pedidos_delete&id='.$rArray['Id'].'&nc='.$rand.'" class="btn btn-warning btn-xs"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
            ';
            }
            ?>
          </tbody>
          </table>
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
           { type: 'date-eu', targets: [1] }
         ],
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 100,
        "aLengthMenu": [[10, 25, 50, 100, 1000], [10, 25, 50, 100, 1000]],
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'excel', title: 'pedidos'},
            {extend: 'pdf', title: 'pedidos'},
            {extend: 'print',
             text: 'IMPRIMIR',
             customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
            }
            }
        ],
        "language": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ning&uacute;n dato disponible en esta tabla",
      "swarning":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "swarningEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "swarningFiltered":   "(filtrado de un total de _MAX_ registros)",
      "swarningPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "swarningThousands":  ",",
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