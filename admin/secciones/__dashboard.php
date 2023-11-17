<?php
$meses = array("1" => "Enero", "2" => "Febrero", "3" => "Marzo", "4" => "Abril", "5" => "Mayo", "6" => "Junio", "7" => "Julio", "8" => "Agosto", "9" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");
?>
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
            <h4 class="font-extra-bold text-warning m-t">
              Cantidad de reclamos por Nombre y Apellido
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
$consulta = "SELECT *, count(*) as cantidad FROM reclamos WHERE fecha BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() GROUP BY email";
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
<?php
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

$desdeInput = strftime('%Y-%m', strtotime($desde));
$hastaInput = strftime('%Y-%m', strtotime($hasta));
$desdeQuery = strftime('%Y-%m', strtotime($desde)).'-01';
$hastaQuery = strftime('%Y-%m', strtotime($hasta)).'-'.date("t", strtotime($hasta));
if(!isset($_POST['desde'])){
  $desdeInput = date("Y-m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-6 month" ) );
  $desde = $desdeInput;
}
if(!isset($_POST['hasta'])){
  $hastaInput = date('Y-m');
  $hasta = $hastaInput;
}
$consulta = "SELECT count(*) as cantidad,  MONTH(fecha) as mes FROM reclamos WHERE fecha BETWEEN '$desdeQuery' AND '$hastaQuery' GROUP BY MONTH(fecha)";echo $consulta;
$resultado = mysql_query($consulta,$conexion);
while($rArray = mysql_fetch_array($resultado)) {
  echo $rArray['mes'].': ';
  echo $rArray['cantidad'].'<br>';
  $meses_2 = $meses_2.'"'.$meses[$rArray['mes']].'",';
}
var_dump($meses_2);
?>
      <div class="col-lg-6 col-md-6 col-sm-6 matchHeight">
        <div class="hpanel">
          <div class="panel-body text-center h-200">
            <h4 class="font-extra-bold text-warning m-t">
              Cantidad de reclamos Mensuales
            </h4>
            <canvas id="singleBarOptions1" height="140"></canvas>
<script>
  var singleBarOptions1 = {
      scaleBeginAtZero : true,
      scaleShowGridLines : true,
      scaleGridLineColor : "rgba(0,0,0,.05)",
      scaleGridLineWidth : 1,
      barShowStroke : true,
      barStrokeWidth : 1,
      barValueSpacing : 5,
      barDatasetSpacing : 1,
      responsive:true
  };
  
  /**
    * Data for Bar chart
    */
  var singleBarData1 = {
      labels: [
        "Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre",
      ],
      datasets: [
          {
              label: "My Second dataset",
              fillColor: "rgba(255,182,6,0.5)",
              strokeColor: "rgba(30,30,30,0.8)",
              highlightFill: "rgba(255,182,6,1)",
              highlightStroke: "rgba(0,0,0,1)",
              data: [149400,103000,108000,114000,126000,225000,160000,182000,304000,290000,20000,0,]
          }
      ]
  };
  
  var ctx = document.getElementById("singleBarOptions1").getContext("2d");
  var myNewChart = new Chart(ctx).Bar(singleBarData1, singleBarOptions1);
</script>
          </div>
          <div class="panel-footer">
            <div class="row">
              <form class="form-horizontal" action="./?seccion=dashboard&nc=<?php echo $rand;?>" method="POST">
                <div class="col-sm-1 text-right">
                  Desde
                </div>
                <div class="col-sm-4">
                  <input type="month" class="form-control input-sm" name="desde" value="<?php echo $desdeInput;?>" required>
                </div>
                <div class="col-sm-1 text-right">
                  Hasta
                </div>
                <div class="col-sm-4">
                  <input type="month" class="form-control input-sm" name="hasta" value="<?php echo $hastaInput;?>" required>
                </div>
                <div class="col-sm-2 text-right">
                  <input type="submit" class="btn btn-danger btn-sm" name="filtrar" value="Filtrar">
                </div>
              </form>
            </div>
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