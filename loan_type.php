<?php 
include('db_connect.php');
?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-loan-type">
				<div class="card">
					<div class="card-header">
						   Formulario de tipo de préstamo
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Tipo</label>
								<textarea name="type_name" id="" cols="30" rows="2" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label class="control-label">Descripción</label>
								<textarea name="description" id="" cols="30" rows="2" class="form-control"></textarea>
							</div>
							
							
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-success col-sm-3 offset-md-3"> Salvar</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()">Cancela</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Tipo de préstamo</th>
									<th class="text-center">Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$types = $conn->query("SELECT * FROM loan_types order by id asc");
								while($row=$types->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									
									<td class="">
										 <p>Tipo de nombre: <b><?php echo $row['type_name'] ?></b></p>
										 <p><small>Descripcion <b><?php echo $row['description'] ?></b></small></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-success edit_ltype" type="button" data-id="<?php echo $row['id'] ?>" data-type_name="<?php echo $row['type_name'] ?>" data-description="<?php echo $row['description'] ?>" >Editar</button>
										<?php if($_SESSION['login_type'] == "admin"):?>
											<button class="btn btn-sm btn-danger delete_ltype" type="button" data-id="<?php echo $row['id'] ?>">Eliminar</button>
										<?php endif?>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: 150px;
	}
</style>
<script>
	function _reset(){
		$('[name="id"]').val('');
		$('#manage-loan-type').get(0).reset();
	}
	
	$('#manage-loan-type').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_loan_type',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Datos agregados correctamente",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Datos actualizados con éxito",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.edit_ltype').click(function(){
		start_load()
		var cat = $('#manage-loan-type')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='type_name']").val($(this).attr('data-type_name'))
		cat.find("[name='description']").val($(this).attr('data-description'))
		end_load()
	})
	$('.delete_ltype').click(function(){
		_conf("¿Estás seguro de eliminar este tipo de préstamo?","delete_ltype",[$(this).attr('data-id')])
	})
	function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        	$('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
	function delete_ltype($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_loan-type',
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