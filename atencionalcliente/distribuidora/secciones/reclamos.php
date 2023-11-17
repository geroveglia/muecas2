<?php
$distribuidor_id = $_SESSION["user_id"];
?>
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Reclamos <a href="./?seccion=reclamos_new&nc=<?php echo $rand;?>" class="btn btn-info btn-xs"><i class="fa fa-plus"></i></a>
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
            <th>Código</th>
            <th>Estatus</th>
            <th>Producto</th>
            <th>Lote</th>
            <th>Tipo no conformidad</th>
            <th>Fecha de recepción</th>
            <th>Fecha de cierre</th>
            <th>Tipo cliente</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $consulta = "SELECT * FROM reclamos WHERE distribuidor_id='$distribuidor_id' AND LOWER(estatus) NOT LIKE '%cerrado%'";
            $resultado = mysql_query($consulta,$conexion);
            while($rArray = mysql_fetch_array($resultado)) {
            echo '
              <tr>
                <td>NC'.str_pad($rArray['Id'], 5, '0', STR_PAD_LEFT).'</td>
                <td>'.$rArray['codigo'].'</td>
                <td class="'.$estatusLista[$rArray['estatus']].' font-bold">'.$rArray['estatus'].'</td>
                <td>'.$rArray['barrita'].'</td>
                <td>'.$rArray['lote'].'</td>
                <td>'.$rArray['tipo_noconformidad'].'</td>
                <td>'.strftime('%d-%m-%Y', strtotime($rArray['fecha'])).'</td>
                <td>'.(($rArray['fecha_cierre']!='')?strftime('%d-%m-%Y', strtotime($rArray['fecha_cierre'])):'').'</td>
                <td>'.$rArray['tipo_cliente'].'</td>
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