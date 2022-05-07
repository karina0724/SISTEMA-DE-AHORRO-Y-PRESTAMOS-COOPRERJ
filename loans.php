<?php 
include('db_connect.php') ?>

<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					<b>Lista de préstamos</b>
					<button class="btn btn-success btn-sm btn-block col-md-2 float-right" type="button" id="new_application"><i class="fa fa-plus"></i> Nuevo prestamo</button>
				</large>
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="loan-list">
					<colgroup>
						<col width="10%">
						<col width="25%">
						<col width="25%">
						<col width="20%">
						<col width="10%">
						<col width="10%">
					</colgroup>
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Prestatario</th>
							<th class="text-center">Detalles del préstamo</th>
							<th class="text-center">Detalles del próximo pago</th>
							<th class="text-center">Estado</th>
							<th class="text-center">Acción</th>
						</tr>
					</thead>
					<tbody>
						<?php
							
							$i=1;
							$type = $conn->query("SELECT * FROM loan_types where id in (SELECT loan_type_id from loan_list) ");
							while($row=$type->fetch_assoc()){
								$type_arr[$row['id']] = $row['type_name'];
							}
							
							$plan = $conn->query("SELECT *,concat(months,' month/s [ ',interest_percentage,'%, ',penalty_rate,' ]') as plan FROM loan_plan where id in (SELECT plan_id from loan_list) ");
							while($row=$plan->fetch_assoc()){
								$plan_arr[$row['id']] = $row;
							}
							
							$qry = $conn->query("SELECT l.*,concat(b.lastname,', ',b.firstname,' ',b.middlename)as name, b.contact_no, b.address from loan_list l inner join borrowers b on b.id = l.borrower_id  order by id asc");
							while($row = $qry->fetch_assoc()):
								$monthly = ($row['amount'] + ($row['amount'] * ($plan_arr[$row['plan_id']]['interest_percentage']/100))) / $plan_arr[$row['plan_id']]['months'];
								$penalty = $monthly * ($plan_arr[$row['plan_id']]['penalty_rate']/100);
								$payments = $conn->query("SELECT * from payments where loan_id =".$row['id']);
								$paid = $payments->num_rows;
								$offset = $paid > 0 ? " offset $paid ": "";
								if($row['status'] == 2):
									$next = $conn->query("SELECT * FROM loan_schedules where loan_id = '".$row['id']."'  order by date(date_due) asc limit 1 $offset ")->fetch_assoc()['date_due'];
								endif;
								$sum_paid = 0;
								while($p = $payments->fetch_assoc()){
									$sum_paid += ($p['amount'] - $p['penalty_amount']);
								}

						 ?>
						 <tr>
						 	
						 	<td class="text-center"><?php echo $i++ ?></td>
						 	<td>
						 		<p>Nombre :<b><?php echo $row['name'] ?></b></p>
						 		<p><small>Contacto # :<b><?php echo $row['contact_no'] ?></small></b></p>
						 		<p><small>Direccion :<b><?php echo $row['address'] ?></small></b></p>
						 	</td>
						 	<td>
						 		<p>Referencia :<b><?php echo $row['ref_no'] ?></b></p>
						 		<p><small>Tipo de préstamo :<b><?php echo $type_arr[$row['loan_type_id']] ?></small></b></p>
						 		<p><small>Plan :<b><?php echo $plan_arr[$row['plan_id']]['plan'] ?></small></b></p>
						 		<p><small>Monto :<b><?php echo $row['amount'] ?></small></b></p>
						 		<p><small>Importe total a pagar :<b><?php echo number_format($monthly * $plan_arr[$row['plan_id']]['months'],2) ?></small></b></p>
						 		<p><small>Monto a pagar mensual: <b><?php echo number_format($monthly,2) ?></small></b></p>
						 		<p><small>Importe a pagar vencido: <b><?php echo number_format($penalty,2) ?></small></b></p>
						 		<?php if($row['status'] == 2 || $row['status'] == 3): ?>
						 		<p><small>Fecha de publicación: <b><?php echo date("M d, Y",strtotime($row['date_released'])) ?></small></b></p>
						 		<?php endif; ?>
						 	</td>
						 	<td>
						 		<?php if($row['status'] == 2 ): ?>
						 		<p>Datos: <b>
						 		<?php echo date('M d, Y',strtotime($next)); ?>
						 		</b></p>
						 		<p><small>Cantidad mensual:<b><?php echo number_format($monthly,2) ?></b></small></p>
						 		<p><small>Multa:<b><?php echo $add = (date('Ymd',strtotime($next)) < date("Ymd") ) ?  $penalty : 0; ?></b></small></p>
						 		<p><small>Cantidad a pagar :<b><?php echo number_format($monthly + $add,2) ?></b></small></p>
						 		<?php else: ?>
					 				N/a
						 		<?php endif; ?>
						 	</td>
						 	<td class="text-center">
						 		<?php if($row['status'] == 0): ?>
						 			<span class="badge badge-warning">Para su aprobación</span>
						 		<?php elseif($row['status'] == 1): ?>
						 			<span class="badge badge-info">Aprobado</span>
					 			<?php elseif($row['status'] == 2): ?>
						 			<span class="badge badge-primary">Liberado</span>
					 			<?php elseif($row['status'] == 3): ?>
						 			<span class="badge badge-success">Completado</span>
					 			<?php elseif($row['status'] == 4): ?>
						 			<span class="badge badge-danger">Denegado</span>
						 		<?php endif; ?>
						 	</td>
						 	<td class="text-center">
						 			<button class="btn btn-outline-primary btn-sm edit_loan" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></button>
						 			<button class="btn btn-outline-danger btn-sm delete_loan" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
						 	</td>

						 </tr>

						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<style>
	td p {
		margin:unset;
	}
	td img {
	    width: 8vw;
	    height: 12vh;
	}
	td{
		vertical-align: middle !important;
	}
</style>	
<script>
	$('#loan-list').dataTable({
		"language":{
				"processing": "Procesando...",
				"lengthMenu": "Mostrar _MENU_ registros",
				"zeroRecords": "No se encontraron resultados",
				"emptyTable": "Ningún dato disponible en esta tabla",
				"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				"infoFiltered": "(filtrado de un total de MAX registros)",
				"search": "Buscar:",
				"infoThousands": ",",
				"loadingRecords": "Cargando...",
				"paginate": {
				"first": "Primero",
				"last": "Último",
				"next": "Siguiente",
				"previous": "Anterior"
				},
				"aria": {
				"sortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sortDescending": ": Activar para ordenar la columna de manera descendente"
				},
				"buttons": {
				"copy": "Copiar",
				"colvis": "Visibilidad",
				"collection": "Colección",
				"colvisRestore": "Restaurar visibilidad",
				"copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
				"copySuccess": {
					"1": "Copiada 1 fila al portapapeles",
					"_": "Copiadas %d fila al portapapeles"
				},
				"copyTitle": "Copiar al portapapeles",
				"csv": "CSV",
				"excel": "Excel",
				"pageLength": {
					"-1": "Mostrar todas las filas",
					"1": "Mostrar 1 fila",
					"_": "Mostrar %d filas"
				},
				"pdf": "PDF",
				"print": "Imprimir"
				},
				"autoFill": {
				"cancel": "Cancelar",
				"fill": "Rellene todas las celdas con <i>%d<\/i>",
				"fillHorizontal": "Rellenar celdas horizontalmente",
				"fillVertical": "Rellenar celdas verticalmentemente"
				},
				"decimal": ",",
				"searchBuilder": {
				"add": "Añadir condición",
				"button": {
					"0": "Constructor de búsqueda",
					"_": "Constructor de búsqueda (%d)"
				},
				"clearAll": "Borrar todo",
				"condition": "Condición",
				"conditions": {
					"date": {
						"after": "Despues",
						"before": "Antes",
						"between": "Entre",
						"empty": "Vacío",
						"equals": "Igual a",
						"notBetween": "No entre",
						"notEmpty": "No Vacio",
						"not": "Diferente de"
					},
					"number": {
						"between": "Entre",
						"empty": "Vacio",
						"equals": "Igual a",
						"gt": "Mayor a",
						"gte": "Mayor o igual a",
						"lt": "Menor que",
						"lte": "Menor o igual que",
						"notBetween": "No entre",
						"notEmpty": "No vacío",
						"not": "Diferente de"
					},
					"string": {
						"contains": "Contiene",
						"empty": "Vacío",
						"endsWith": "Termina en",
						"equals": "Igual a",
						"notEmpty": "No Vacio",
						"startsWith": "Empieza con",
						"not": "Diferente de"
					},
					"array": {
						"not": "Diferente de",
						"equals": "Igual",
						"empty": "Vacío",
						"contains": "Contiene",
						"notEmpty": "No Vacío",
						"without": "Sin"
					}
				},
				"data": "Data",
				"deleteTitle": "Eliminar regla de filtrado",
				"leftTitle": "Criterios anulados",
				"logicAnd": "Y",
				"logicOr": "O",
				"rightTitle": "Criterios de sangría",
				"title": {
					"0": "Constructor de búsqueda",
					"_": "Constructor de búsqueda (%d)"
				},
				"value": "Valor"
				},
				"searchPanes": {
				"clearMessage": "Borrar todo",
				"collapse": {
					"0": "Paneles de búsqueda",
					"_": "Paneles de búsqueda (%d)"
				},
				"count": "{total}",
				"countFiltered": "{shown} ({total})",
				"emptyPanes": "Sin paneles de búsqueda",
				"loadMessage": "Cargando paneles de búsqueda",
				"title": "Filtros Activos - %d"
				},
				"select": {
				"1": "%d fila seleccionada",
				"_": "%d filas seleccionadas",
				"cells": {
					"1": "1 celda seleccionada",
					"_": "$d celdas seleccionadas"
				},
				"columns": {
					"1": "1 columna seleccionada",
					"_": "%d columnas seleccionadas"
				}
				},
				"thousands": ".",
				"datetime": {
				"previous": "Anterior",
				"next": "Proximo",
				"hours": "Horas",
				"minutes": "Minutos",
				"seconds": "Segundos",
				"unknown": "-",
				"amPm": [
					"am",
					"pm"
				]
				},
				"editor": {
				"close": "Cerrar",
				"create": {
					"button": "Nuevo",
					"title": "Crear Nuevo Registro",
					"submit": "Crear"
				},
				"edit": {
					"button": "Editar",
					"title": "Editar Registro",
					"submit": "Actualizar"
				},
				"remove": {
					"button": "Eliminar",
					"title": "Eliminar Registro",
					"submit": "Eliminar",
					"confirm": {
						"_": "¿Está seguro que desea eliminar %d filas?",
						"1": "¿Está seguro que desea eliminar 1 fila?"
					}
				},
				"error": {
					"system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
				},
				"multi": {
					"title": "Múltiples Valores",
					"info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
					"restore": "Deshacer Cambios",
					"noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
				}
		},
		"info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas"
		}
	})
	
	$('#new_application').click(function(){
		uni_modal("Nuevo prestamo","manage_loan.php",'mid-large')
	})

	$('.edit_loan').click(function(){
		uni_modal("Editar préstamo","manage_loan.php?id="+$(this).attr('data-id'),'mid-large')
	})
	$('.delete_loan').click(function(){
		_conf("¿Seguro que quieres borrar este dato?","delete_loan",[$(this).attr('data-id')])
	})

function delete_loan($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_loan',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Préstamo eliminado correctamente",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>