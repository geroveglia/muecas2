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
<?php
include("estadisticas_1.php");
include("estadisticas_2.php");
?>
    </div>
    <div class="row">
<?php
include("estadisticas_3.php");
include("estadisticas_4.php");
?>
    </div>
    <div class="row">
<?php
include("estadisticas_5.php");
include("estadisticas_6.php");
?>
    </div>
    <div class="row">
<?php
include("estadisticas_7.php");
include("estadisticas_8.php");
?>
    </div>
    <div class="row">
<?php
include("estadisticas_9.php");
include("estadisticas_10.php");
?>
    </div>
    <div class="row">
<?php
include("estadisticas_11.php");
include("estadisticas_12.php");
?>
    </div>
    <div class="row">
<?php
include("estadisticas_13.php");
include("estadisticas_14.php");
?>
    </div>
    <div class="row">
<?php
include("estadisticas_15.php");
include("estadisticas_16.php");
?>
    </div>
  </div>

<form class="form-horizontal" action="" method="GET" id="formulario">
  <input type="hidden" name="seccion" value="dashboard">
  <input type="hidden" name="nc" value="<?php echo $rand;?>">
</form>
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

<script>
$(".exportar-imagen").click(function(){
  target = $(this).data('target');
  ancho = $("#"+target).width();
  alto = $("#"+target).height();
  $("#"+target).css("width", ancho);
  $("#"+target).css("height", alto);
  options = {
  };
  html2canvas(document.querySelector("#"+target), options).then(function(canvas) {
    //document.body.appendChild(canvas)
    saveAs(canvas.toDataURL(), target+'.png');
  });
});

function saveAs(uri, filename) {
  var link = document.createElement('a');
  if (typeof link.download === 'string') {
    link.href = uri;
    link.download = filename;
    //Firefox requires the link to be in the body
    document.body.appendChild(link);
    //simulate click
    link.click();
    //remove the link when done
    document.body.removeChild(link);
  } else {
    window.open(uri);
  }
}
</script>