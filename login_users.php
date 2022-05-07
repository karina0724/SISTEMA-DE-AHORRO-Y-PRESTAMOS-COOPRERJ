<?php 
include('db_connect.php');
if(isset($_GET['id'])) {
	$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
	foreach($user->fetch_array() as $k =>$v){
		$meta[$k] = $v;
	}
}

?>
<div class="container-fluid">
	<form id="login-form">
		<input type="hidden" name="type" value="<?php echo $_GET["type"] ?>">
		<div class="form-group">
			<label for="username" class="control-label">Usuario</label>
			<input type="text" id="username" name="username" class="form-control">
		</div>
		<div class="form-group">
			<label for="password" class="control-label">Contraseña</label>
			<input type="password" id="password" name="password" class="form-control">
		</div>
		<button class="btn btn-success">Iniciar Sesión</button>
	</form>
</div>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
				$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{ 
					$('#login-form').prepend('<div class="alert alert-danger">Credenciales Incorrectas</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>