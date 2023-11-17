<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Unidades de venta <a href="./?seccion=unidades_new&nc=<?php echo $rand;?>" class="btn btn-warning btn-xs"><i class="fa fa-plus"></i></a>
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
            <th>Unidad</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
            <?php
            $consulta = "SELECT * FROM unidad_venta";
            $resultado = mysql_query($consulta,$conexion);
            while($rArray = mysql_fetch_array($resultado)) {
            echo '
              <tr>
                <td>'.$rArray['unidad'].'</td>
                <td>
                <a href="./?seccion=unidades_edit&id='.$rArray['Id'].'&nc='.$rand.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                <a href="./?seccion=unidades_delete&id='.$rArray['Id'].'&nc='.$rand.'" class="btn btn-warning btn-xs"><i class="fa fa-trash-o"></i></a>
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
                "iDisplayLength": 100,
                "aLengthMenu": [[10, 25, 50, 100, 1000], [10, 25, 50, 100, 1000]],
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'excel', title: 'Unidades de venta'},
                    {extend: 'pdf', title: 'Unidades de venta'},
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

    </script>