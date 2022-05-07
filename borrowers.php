<?php 
include 'db_connect.php' ?>

<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					<b>Lista de socios</b>
				</large>
				<button class="btn btn-success btn-block col-md-2 float-right" type="button" id="new_borrower"><i class="fa fa-plus"></i> Nuevo socio</button>
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="borrower-list">
					<colgroup>
						<col width="10%">
						<col width="35%">
						<col width="30%">
						<col width="15%">
						<col width="10%">
					</colgroup>
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Afiliado</th>
							<th class="text-center">Prestamo actual</th>
							<th class="text-center">Proximo pago</th>
							<th class="text-center">Accion</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
							$qry = $conn->query("SELECT * FROM borrowers order by id desc");
							while($row = $qry->fetch_assoc()):

						 ?>
						 <tr>
						 	
						 	<td class="text-center"><?php echo $i++ ?></td>
						 	<td>
						 		<p>Nombre :<b><?php echo ucwords($row['lastname'].", ".$row['firstname'].' '.$row['middlename']) ?></b></p>
						 		<p><small>Direccion :<b><?php echo $row['address'] ?></small></b></p>
						 		<p><small>Contacto # :<b><?php echo $row['contact_no'] ?></small></b></p>
						 		<p><small>Email :<b><?php echo $row['email'] ?></small></b></p>
						 		<p><small>ID :<b><?php echo $row['tax_id'] ?></small></b></p>
						 	</td>
						 	<td class="">Ninguna</td>
						 	<td class="">N/A</td>
						 	<td class="text-center">
						 			<button class="btn btn-outline-primary btn-sm edit_borrower" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></button>
						 			<button class="btn btn-outline-danger btn-sm delete_borrower" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
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
	
	$('#borrower-list').dataTable({

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



	
	$('#new_borrower').click(function(){
		uni_modal("Prestatario","manage_borrower.php",'mid-large')
	})
	$('.edit_borrower').click(function(){
		uni_modal("Editar prestatario","manage_borrower.php?id="+$(this).attr('data-id'),'mid-large')
	})
	$('.delete_borrower').click(function(){
		_conf("Seguro que quieres eliminar este afiliado?","delete_borrower",[$(this).attr('data-id')])
	})
function delete_borrower($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_borrower',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Afiliado eliminado correctamente",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>