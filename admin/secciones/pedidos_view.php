<?php
$id = $_GET['id'];
$consulta = "SELECT * FROM pedidos WHERE Id='$id'";
$resultado = mysql_query($consulta,$conexion);
$rArray = mysql_fetch_array($resultado);
$cliente_id = $rArray['cliente_id'];
$estado = $rArray['estado'];
$fecha = strftime('%d-%m-%Y', strtotime($rArray['fecha']));
$fecha_entrega = strftime('%d-%m-%Y', strtotime($rArray['fecha_entrega']));
$franja_id = $rArray['franja_id'];
$telefonico = $rArray['telefonico'];
$cantidad_total = $rArray['cantidad_total'];

$descuento_aplicado = $rArray['descuento_aplicado'];
$total = $rArray['monto'];
$iva = $rArray['iva'];
$subtotal = $rArray['subtotal'];
$descuento_monto = ($total-$iva-$subtotal)*-1;
$montoMenosDescuento = $rArray['monto']-($rArray['monto']*$descuento_aplicado/100);
$telefonico = $rArray['telefonico'];
$tipo_factura = $rArray['tipo_factura'];

$subtotal = number_format((float)$subtotal, 2, '.', '');
$descuento_monto = number_format((float)$descuento_monto, 2, '.', '');
$iva = number_format((float)$iva, 2, '.', '');
$total = number_format((float)$total, 2, '.', '');
$subtotal = str_replace(".00","",$subtotal);
$descuento_monto = str_replace(".00","",$descuento_monto);
$iva = str_replace(".00","",$iva);
$total = str_replace(".00","",$total);

$consultaC = "SELECT clientes.*, barrios.barrio AS barrio, barrios.Id AS barrio_id FROM clientes LEFT JOIN barrios ON barrios.Id=clientes.barrio WHERE clientes.Id='$cliente_id'";
$resultadoC = mysql_query($consultaC,$conexion);
$rArrayC = mysql_fetch_array($resultadoC);
$cliente = $rArrayC['nombre'].' '.$rArrayC['apellido'];
$cliente_tipo = $rArrayC['tipo'];
$direccion = $rArrayC['direccion'].(($rArrayC['piso']!='')?', piso '.$rArrayC['piso']:'').(($rArrayC['departamento']!='')?', departamento '.$rArrayC['departamento']:'').(($rArrayC['cp']!='')?', (CP '.$rArrayC['cp'].')':'');
$telefono = $rArrayC['telefono'];
$celular = $rArrayC['celular'];
$barrio = $rArrayC['barrio'];
$barrio_id = $rArrayC['barrio_id'];
$nombre_contacto = (($rArrayC['nombre_contacto']!='')?' <b>Nombre del contacto:</b> '.$rArrayC['nombre_contacto'].'<br>':'');
$horario_apertura = (($rArrayC['horario_apertura']!='')?' <b>Horario de apertura:</b> '.$rArrayC['horario_apertura'].'<br>':'');

$consultaF = "SELECT * FROM franjas WHERE Id='$franja_id'";
$resultadoF = mysql_query($consultaF,$conexion);
$rArrayF = mysql_fetch_array($resultadoF);
$franja = $rArrayF['franja'];

$consultaZ = "SELECT * FROM zonas_barrios LEFT JOIN barrios ON barrios.Id=zonas_barrios.barrio_id LEFT JOIN zonas ON zonas.Id=zonas_barrios.zona_id WHERE barrio_id='$barrio_id'";
$resultadoZ = mysql_query($consultaZ,$conexion);
$rArrayZ = mysql_fetch_array($resultadoZ);
$zona = $rArrayZ['zona'];

//Actualizo si se cambia el estado
if($_POST['estado_nuevo']!=''){
  $estado_nuevo = $_POST['estado_nuevo'];
  $estado = $estado_nuevo;
  $sql = "UPDATE pedidos SET estado='$estado_nuevo' WHERE Id='$id'";
  $rsql = mysql_query($sql,$conexion);
  $mensaje = '<div class="alert alert-info m-b">Se cambi&oacute; el estado del pedido a "'.$estado.'".</div>';
}

?>
<!-- Main Wrapper -->
<div id="wrapper">
<div class="normalheader transition animated fadeIn small-header">
  <div class="hpanel">
    <div class="panel-body">
      <h2>
        Pedido Nº <?php echo $id;?> <?php if($telefonico=='1'){echo '(Telef&oacute;nico)';};?>
      </h2>
      <div class="m-t">
        <b>Tipo de cliente:</b> <?php echo $cliente_tipo;?><br>
        <b>Cliente:</b> <?php echo $cliente;?><br>
        <?php echo $nombre_contacto;?>
        <b>Direcci&oacute;n de entrega:</b> <?php echo $direccion;?><br>
        <b>Barrio:</b> <?php echo $barrio;?><br>
        <b>Zona:</b> <?php echo $zona;?><br>
        <b>Tel&eacute;fono:</b> <?php echo $telefono;?><br>
        <b>Celular:</b> <?php echo $celular;?><br>
        <?php echo $horario_apertura;?>
        <b>Fecha de entrega:</b> <?php echo $fecha_entrega;?><br>
        <b>Franja horaria:</b> <?php echo $franja;?><br>
        <b>Estado del pedido:</b> <?php echo $estado;?><br>
        <b>Factura:</b> <?php echo $tipo_factura;?>
      </div>
    </div>
  </div>
</div>
<div class="content animate-panel">
  <div class="row">
    <div class="col-md-12 col-lg-12">
      <div class="hpanel">
        <div class="panel-body">
          <?php echo $mensaje;?>
          <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
          <thead>
          <tr role="row">
            <th>C&oacute;digo</th>
            <th>Nombre</th>
            <th>Precio unitario</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $consulta = "SELECT *, pedidos_detalle.id AS Id FROM pedidos_detalle LEFT JOIN productos ON productos.Id=pedidos_detalle.producto_id WHERE pedido_id='$id'";
            $resultado = mysql_query($consulta,$conexion);
            while($rArray = mysql_fetch_array($resultado)){
            echo '
              <tr>
                <td>'.$rArray['codigo'].'</td>
                <td>'.$rArray['nombre'].'</td>
                <td>$'.$rArray['precio_abonado'].''.(($rArray['promoaplicada']!='')?' ('.$rArray['promoaplicada'].')':'').'</td>
                <td>'.$rArray['cantidad'].'</td>
                <td>$'.$rArray['precio_abonado']*$rArray['cantidad'].'</td>
              </tr>
            ';
            }
            ?>
<?php if($tipo_factura=='A' || $tipo_factura=='B'){?>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td class="text-right"><b>Subtotal:</b></td>
              <td><b>$<?php echo $subtotal;?></b></td>
            </tr>
<?php }?>
<?php if($descuento_aplicado>0){?>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td class="text-right"><b>Descuento (<?php echo $descuento_aplicado;?>%):</b></td>
              <td><b>-$<?php echo $descuento_monto;?></b></td>
            </tr>
<?php }?>
<?php if($tipo_factura=='A'){?>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td class="text-right"><b>IVA:</b></td>
              <td><b>$<?php echo $iva;?></b></td>
            </tr>
<?php }?>
            <tr>
              <td></td>
              <td></td>
              <td class="text-right"><b>Total:</b></td>
              <td class="bold"><b><?php echo $cantidad_total;?></b></td>
              <td class="bold"><b>$<?php echo $total;?></b></td>
            </tr>
          </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-lg-12">
      <form action="./?seccion=pedidos_view&id=<?php echo $id;?>&nc=<?php echo $rand;?>" method="POST">
      Cambiar estado del pedido: 
      <select name="estado_nuevo" required>
        <option <?php if($estado=='Recibido'){echo 'selected';};?>>Recibido</option>
        <option <?php if($estado=='En preparación'){echo 'selected';};?>>En preparación</option>
        <option <?php if($estado=='Despachado'){echo 'selected';};?>>Despachado</option>
        <option <?php if($estado=='Recoordinar'){echo 'selected';};?>>Recoordinar</option>
        <option <?php if($estado=='Entregado'){echo 'selected';};?>>Entregado</option>
        <option <?php if($estado=='Llamar a la vendedora'){echo 'selected';};?>>Llamar a la vendedora</option>
        <option <?php if($estado=='Anulado'){echo 'selected';};?>>Anulado</option>
      </select>
      <input type="submit" value="cambiar" class="btn btn-warning btn-sm">
      </form>
      <div class="pull-right">
        <a href="./?seccion=pedidos&nc=<?php echo $rand; ?>" class="btn btn-warning">Volver</a>
      </div>
    </div>
  </div>
</div>

<div class="content animate-panel">
  <div class="row m-b-lg">
    <div class="col-md-12" style="">
      <div class="hpanel ">
        <div class="panel-heading hbuilt">
          Mensajes
        </div>
        <div class="panel-body no-padding">
          <div class="row">
            <div class="col-md-12" style="">
              <div class="chat-discussion mensajes-cuerpo">
<?php
$consultaChat = "SELECT * FROM pedidos_mensajes WHERE pedido_id='$id' ORDER BY Id DESC";
$resultadoChat = mysql_query($consultaChat,$conexion);
while($rArrayChat = mysql_fetch_array($resultadoChat)){
  echo '
                <div class="chat-message '.(($rArrayChat['del_cliente']=='1')?'right':'left').'">
                  <img class="message-avatar" src="images/'.(($rArrayChat['del_cliente']=='1')?'avatar':'logo').'.svg" alt="">
                  <div class="message">
                    <a class="message-author" href="#"> '.(($rArrayChat['del_cliente']=='1')?'Cliente':'Muecas').' </a>
                    <span class="message-date"> '.strftime('%H-%M', strtotime($rArrayChat['fecha'])).' hs - '.strftime('%d-%m-%Y', strtotime($rArrayChat['fecha'])).' </span>
                    <span class="message-content">
                      '.$rArrayChat['mensaje'].'
                    </span>
                  </div>
                </div>
  ';
}
?>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Escribir mensaje al cliente." id="chatText">
            <span class="input-group-btn">
              <button class="btn btn-warning" id="AddComentario">Enviar</button>
            </span>
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
            "iDisplayLength": 100,
            "aLengthMenu": [[10, 25, 50, 100, 1000], [10, 25, 50, 100, 1000]],
            "order": [[ 0, "desc" ]],
            dom: '<"html5buttons"B>lTgtp',
            "bPaginate": false,
            "bSort" : false,
            buttons: [
                {extend: 'excel', title: 'Pedido Nro <?php echo $id;?><?php if($telefonico=='1'){echo ' (Telefónico)';};?>'},
                {extend: 'pdf',
                 title: 'Pedido Nro <?php echo $id;?><?php if($telefonico=='1'){echo ' (Telefónico)';};?>',
                 message: 'Pedido Nro <?php echo $id;?><?php if($telefonico=='1'){echo ' (Telefónico)';};?>\n Tipo de cliente: <?php echo $cliente_tipo;?>\n Cliente: <?php echo $cliente;?>\n <?php echo $nombre_contacto;?> Dirección de entrega: <?php echo $direccion;?>\n Barrio: <?php echo $barrio;?>\n Teléfono: <?php echo $telefono;?>\n Celular: <?php echo $celular;?>\n <?php echo $horario_apertura;?> Fecha de entrega: <?php echo $fecha_entrega;?>\n Franja horaria: <?php echo $franja;?>\n Estado del pedido: <?php echo $estado;?>\n Factura: <?php echo $tipo_factura;?>',
                },
                {extend: 'print',
                 text: 'IMPRIMIR',
                 messageTop: '',
                 title: '',
                 customize: function (win){
                        $(win.document.body).prepend(
                          '<div style="font-size: 25px">Pedido Nro <?php echo $id;?><?php if($telefonico=='1'){echo ' (Telefónico)';};?></div> <div class="m-t" style="font-size: 14px"> <b>Tipo de cliente:</b> <?php echo $cliente_tipo;?><br> <b>Cliente:</b> <?php echo $cliente;?><br> <?php echo $nombre_contacto;?> <b>Direcci&oacute;n de entrega:</b> <?php echo $direccion;?><br> <b>Barrio:</b> <?php echo $barrio;?><br> <b>Tel&eacute;fono:</b> <?php echo $telefono;?><br> <b>Celular:</b> <?php echo $celular;?><br> <?php echo $horario_apertura;?> <b>Fecha de entrega:</b> <?php echo $fecha_entrega;?><br> <b>Franja horaria:</b> <?php echo $franja;?><br> <b>Estado del pedido:</b> <?php echo $estado;?><br> <b>Factura:</b> <?php echo $tipo_factura;?> </div>'
                        );
                        $(win.document.body).prepend(
                          '<img src="https://www.muecas.com.ar/images/logo_naranja.png" style="float:right;max-height: 40px;" />'
                        );
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('th:last-child')
                                .append('<?php echo $append;?>');
                        $(win.document.body).find('td')
                                .css('font-size', '10px');
                        $(win.document.body).find('tr:last-child td')
                                .css('font-size', '20px');
                        $(win.document.body).find('td:first-child')
                                .css('font-weight', 'bold');
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

    });

</script>

<script type="text/javascript">
$("#AddComentario").click(function(){
  texto = $("#chatText").val();
  if(texto != ''){
    if (window.XMLHttpRequest){
      xmlhttp=new XMLHttpRequest();
    }
    else{
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
        $("#chatText").val('');
        $(".mensajes-cuerpo").prepend(xmlhttp.responseText);
      }
    }
    xmlhttp.open("POST","secciones/comentarios_ajax.php?comentario="+texto+"&pedidoid=<?php echo $id;?>&clienteid=<?php echo $cliente_id;?>",true);
    xmlhttp.send();
    
  }
  else{
  }
});
</script>