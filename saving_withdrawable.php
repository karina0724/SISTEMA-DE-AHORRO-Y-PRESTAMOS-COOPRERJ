<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
<?php if($_SESSION['login_type'] == "admin"): ?>

				<div class="card-header">
					<large class="card-title">
						<b>Lista de usuarios</b>
						<button class="btn btn-success float-right btn-sm p-2" id="new_user"><i class="fa fa-plus"></i> Nuevo Usuario</button>
					</large>
					
				</div>
				
					<div class="card-body">
						<table class="table-striped table-bordered col-md-12 text-center">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Nombre</th>
									<th class="text-center">Nombre De Usuario</th>
									<th class="text-center">Accion</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include 'db_connect.php';
									$users = $conn->query("SELECT * FROM users order by name asc");
									$i = 1;
									while($row= $users->fetch_assoc()):
								?>
								<tr>
									<td>
										<?php echo $i++ ?>
									</td>
									<td>
										<?php echo $row['name'] ?>
									</td>
									<td>
										<?php echo $row['username'] ?>
									</td>
									<td class="p-2">
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Accion</button>
											<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="sr-only">Alternar menú desplegable</span>
											</button>
											<div class="dropdown-menu">
												<a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Editar</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Eliminar</a>
											</div>
										</div>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				
	<script>
	$('#new_user').click(function(){
		uni_modal('Nuevo usuario','manage_user.php')
	})
	$('.edit_user').click(function(){
		uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
	})
	$('.delete_user').click(function(){
			_conf("¿Estás seguro de eliminar a este usuario?","delete_user",[$(this).attr('data-id')])
		})
		function delete_user($id){
			start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Datos eliminados correctamente",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>
<?php 
else :
	echo '<div class="container-fluid"><h3>Usted no tiene acceso a esta página.</h3></div>';
endif
?>
		</div>
	</div>		
</div>