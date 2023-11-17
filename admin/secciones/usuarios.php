<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Usuarios <a href="./?seccion=usuarios_new&nc=<?php echo $rand;?>" class="btn btn-warning btn-xs"><i class="fa fa-plus"></i></a>
      </h2>
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
            <th>Id</th>
            <th>Usuario</th>
            <th>Contrase&ntilde;a</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Activo</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
            <?php
            $consulta = "SELECT * FROM usuarios";
            $resultado = mysql_query($consulta,$conexion);
            while($rArray = mysql_fetch_array($resultado)) {
            echo '
              <tr>
                <td>'.$rArray['Id'].'</td>
                <td>'.$rArray['usuario'].'</td>
                <td>'.$rArray['contrasenia'].'</td>
                <td>'.$rArray['email'].'</td>
                <td>'.$rArray['tipo'].'</td>
                <td>'.(($rArray['activo']=='1')?'<i class="fa fa-check fa-2x"></i>':'').'</td>
                <td>
                <a href="./?seccion=usuarios_edit&id='.$rArray['Id'].'&nc='.$rand.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                '.(($rArray['Id']!='1')?'
                <a href="./?seccion=usuarios_delete&id='.$rArray['Id'].'&nc='.$rand.'" class="btn btn-warning btn-xs"><i class="fa fa-trash-o"></i></a>'
                :'').'
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
                    {extend: 'excel', title: 'usuarios'},
                    {extend: 'pdf', title: 'usuarios'},
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

    </script>