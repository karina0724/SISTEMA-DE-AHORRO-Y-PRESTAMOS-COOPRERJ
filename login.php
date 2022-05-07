<?php 
include('./header.php'); 
include('./db_connect.php'); 
include('admin_class.php');
 
if($_POST){
	if(isset($_SESSION['login_id'])) 
		header("location:index.php?page=home");
}
$url = "";
// $action = new Action();
// $users = $action->get_users();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SISTEMA DE AHORRO Y PRESTAMOS COOPRERJ</title>
  <link type="image/x-icon" href="COOPERATIVA.png" rel="shortcut icon"/>
  <style>
	  @import url('https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap');

	  body{
		  background-image: url("assets/img/casaverde.jpg") ;
	  }

	  a{
		background: rgba(255, 255, 255, 0.76);
		cursor: pointer;
		display: inline-block;
		font-weight: 500;
	  }

	  a:hover{
		  background:#fff;
		  transition: ease;
	  }
	 
	  main .btn-register{
		padding: 15px 40px; 
		margin: 45px 30px 150px 30px;
		border-radius: 100px;
		box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
	  }

	  main .content-2{
		  width: 50%;
		  float: right;
		  text-align: center;
	  }

	  main .content-2 h1 {
		font-family: 'Fjalla One', sans-serif;
	  	font-weight: 700;
	  	font-size: 55px;
	  	line-height: 100px; 
		letter-spacing: 2px;
	  	color: #fff;
		margin-bottom: 55px;
	  } 

	  main .content-2 .btns-login a {
		  width: 200px;
		  margin-right: 20px;
		  color: #000;
		  padding: 25px;
	  }
  </style>
</head>
<body>
	<main class="d-flex flex-column align-items-end">
		<a id="btn-register" class="btn-register">Registrarse</a>
		<div class="content-2">
			<h1>SISTEMA DE AHORRO Y PRESTAMOS COOPRERJ</h1> 
			<div class="btns-login">
				<a id="login-staff">Usuario</a>
				<a id="login-admin">EmpresaCOOPRERJ</a>
			</div> 
		</div>
	</main>

	<div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="toast-body text-white">
		</div>
  	</div>

	<div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

	<div class="modal fade" id="confirm_modal" role='dialog'>
		<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title">Confirmacion</h5>
		</div>
		<div class="modal-body">
			<div id="delete_content"></div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" id='confirm' onclick="">Continuar</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		</div>
		</div>
		</div>
	</div>
	<div class="modal fade" id="uni_modal" role='dialog'>
		<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title"></h5>
		</div>
		<div class="modal-body">
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-success" id='submit' onclick="$('#uni_modal form').submit()">Salvar</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		</div>
		</div>
		</div>
	</div>
</body>
<script>
	$("#submit").css("visibility", "hidden");
	
	$('#btn-register').click(function(){
		uni_modal("SISTEMA DE AHORRO Y PRESTAMOS COOPRERJ","manage_user.php");
	})

	$('#login-staff').click(function(){
		 uni_modal("SISTEMA DE AHORRO Y PRESTAMOS COOPRERJ", "login_users.php", "", $data_login = {type: "staff"});
	})

	$('#login-admin').click(function(){
		uni_modal("SISTEMA DE AHORRO Y PRESTAMOS COOPRERJ", "login_users.php", "", $data_login = {type: "admin"});
	})
</script>	
</html>