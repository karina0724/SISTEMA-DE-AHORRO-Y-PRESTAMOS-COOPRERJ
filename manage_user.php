<?php 
session_start();
include('db_connect.php');
if(isset($_GET['id'])){
	$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
	foreach($user->fetch_array() as $k =>$v) $meta[$k] = $v;
}
?> 
<div class="container-fluid">
	<form id="manage-user">
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="name">Nombre</label>
			<input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="last_name">Apellido</label>
			<input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo isset($meta['last_name']) ? $meta['last_name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="membership_number">Número de Socio</label>
			<input type="text" name="membership_number" id="membership_number" class="form-control" value="<?php echo isset($meta['membership_number']) ? $meta['membership_number']: '' ?>" required>
		</div>	
		<div class="form-group">
			<label for="contact">Teléfono</label>
			<input type="text" name="contact" id="contact" class="form-control" value="<?php echo isset($meta['contact']) ? $meta['contact']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="email">Correo Electrónico</label>
			<input type="text" name="email" id="email" class="form-control" value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="username">Nombre de Usuario</label>
			<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="password">Contraseña</label>
			<input type="password" name="password" id="password" class="form-control" value="<?php echo isset($meta['password']) ? $meta['password']: '' ?>" required>
		</div>
		<?php if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == "admin"): ?>
		<div class="form-group">
			<label for="type">Tipo De Usuario</label>
			<select name="type" id="type" class="custom-select">
				<option value="admin" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Administrador</option>
				<option value="staff" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>Staff</option>
			</select>
		</div>
		<?php endif; ?>
		<button type="submit" class="btn btn-success">Registrarse</button>
	</form>
</div>
<script>
	$('#manage-user').submit(function(e){
		e.preventDefault();
		
			start_load()

			$.ajax({
			url:'ajax.php?action=save_user',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp){
					alert_toast("Datos guardados con éxito",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
                  if (jqXHR.status == 500) {
                      alert('Error interno:' + jqXHR.responseText);
                  } else {
                      alert('Error inesperado.');
                  }
            }	
		})
		
	})
</script>
