<?php
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

$desdeInput = strftime('%Y-%m-%d', strtotime($desde));
$hastaInput = strftime('%Y-%m-%d', strtotime($hasta));
if(!isset($_POST['desde'])){
  $desdeInput = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
  $desde = $desdeInput;
}
if(!isset($_POST['hasta'])){
  $hastaInput = date('Y-m-d');
  $hasta = $hastaInput;
}
?>
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Cantidad de reclamos por nombre <a href="./?seccion=dashboard&nc=<?php echo $rand;?>" class="btn btn-warning btn-xs">Volver</a>
      </h2>
    </div>
  </div>
</div>
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <div class="row">
        <form class="form-horizontal" action="./?seccion=<?php echo $seccion;?>&nc=<?php echo $rand;?>" method="POST">
          <div class="col-sm-2">
            <h5>
              Filtrar por fecha
            </h5>
          </div>
          <div class="col-sm-1 text-right">
            Desde
          </div>
          <div class="col-sm-3">
            <input type="date" class="form-control input-sm" name="desde" value="<?php echo $desdeInput;?>" required>
          </div>
          <div class="col-sm-1 text-right">
            Hasta
          </div>
          <div class="col-sm-3">
            <input type="date" class="form-control input-sm" name="hasta" value="<?php echo $hastaInput;?>" required>
          </div>
          <div class="col-sm-2 text-right">
            <input type="submit" class="btn btn-danger btn-sm" name="filtrar" value="Filtrar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="content animate-panel">
  <div class="row">
    <div class="col-lg-12">
      <div class="hpanel">
        <div class="panel-body">
          <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
            <thead>
              <tr role="row">
                <th>Cant</th>
                <th>Cliente</th>
              </tr>
            </thead>
            <tbody>
<?php
$consulta = "SELECT *, count(*) as cantidad FROM reclamos WHERE DATE(fecha) BETWEEN '$desde' AND '$hasta' AND email IS NOT NULL GROUP BY email";
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
      </div>
    </div>
  </div>
</div>

<!-- Page-Level Scripts -->
<script>
$(document).ready(function(){
    $('.dataTables-example').DataTable({
        columnDefs: [
           { type: 'date-eu', targets: [7,8] }
         ],
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 100,
        "aLengthMenu": [[10, 25, 50, 100, 1000], [10, 25, 50, 100, 1000]],
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'excel', title: 'reclamos'},
            {extend: 'pdf', title: 'reclamos'},
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